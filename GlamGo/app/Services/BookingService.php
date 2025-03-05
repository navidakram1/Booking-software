namespace App\Services;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\ServiceAddon;
use App\Events\SlotAvailabilityChanged;
use App\Mail\BookingConfirmation;
use App\Mail\BookingStatusChanged;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BookingService
{
    public function getAvailableSlots(int $serviceId, int $specialistId, Carbon $date, string $timezone): array
    {
        $service = Service::findOrFail($serviceId);
        $specialist = Specialist::findOrFail($specialistId);
        
        // Convert date to specialist's timezone for working hours
        $localDate = $date->copy()->setTimezone($timezone);
        $dayOfWeek = strtolower($localDate->format('l'));
        
        // Get specialist's working hours for the day
        $workingHours = $specialist->working_hours()->where('day', $dayOfWeek)->first();
        if (!$workingHours) {
            return [];
        }

        // Get all bookings for the specialist on this date
        $bookings = Booking::where('specialist_id', $specialistId)
            ->whereDate('start_time', $date)
            ->get();

        // Get all temporary locks
        $locks = $this->getActiveLocks($specialistId, $date);

        // Generate time slots
        $slots = [];
        $startTime = Carbon::parse($workingHours->start_time, $timezone);
        $endTime = Carbon::parse($workingHours->end_time, $timezone);
        
        while ($startTime->copy()->addMinutes($service->duration) <= $endTime) {
            $slotEnd = $startTime->copy()->addMinutes($service->duration);
            
            // Check if slot is available
            if ($this->isSlotAvailable($startTime, $slotEnd, $bookings, $locks)) {
                $slots[] = [
                    'start_time' => $startTime->copy()->setTimezone('UTC')->format('Y-m-d H:i:s'),
                    'end_time' => $slotEnd->copy()->setTimezone('UTC')->format('Y-m-d H:i:s')
                ];
            }
            
            $startTime->addMinutes(15); // 15-minute intervals
        }

        return $slots;
    }

    public function lockTimeSlot(int $serviceId, int $specialistId, Carbon $startTime, Carbon $endTime): string
    {
        $lockId = Str::uuid()->toString();
        $key = "booking_lock:{$lockId}";
        
        Cache::put($key, [
            'service_id' => $serviceId,
            'specialist_id' => $specialistId,
            'start_time' => $startTime->format('Y-m-d H:i:s'),
            'end_time' => $endTime->format('Y-m-d H:i:s')
        ], now()->addMinutes(10));

        event(new SlotAvailabilityChanged($serviceId, $specialistId, $startTime, $endTime, false));
        
        return $lockId;
    }

    public function releaseLock(string $lockId): void
    {
        $key = "booking_lock:{$lockId}";
        $lock = Cache::get($key);
        
        if ($lock) {
            event(new SlotAvailabilityChanged(
                $lock['service_id'],
                $lock['specialist_id'],
                Carbon::parse($lock['start_time']),
                Carbon::parse($lock['end_time']),
                true
            ));
            
            Cache::forget($key);
        }
    }

    public function createBooking(
        int $serviceId,
        int $specialistId,
        Carbon $startTime,
        array $customerDetails,
        string $notes,
        array $addonIds,
        string $timezone
    ): Booking {
        $service = Service::findOrFail($serviceId);
        $endTime = $startTime->copy()->addMinutes($service->duration);
        
        // Calculate total duration including add-ons
        if (!empty($addonIds)) {
            $addons = ServiceAddon::whereIn('id', $addonIds)->get();
            foreach ($addons as $addon) {
                $endTime->addMinutes($addon->duration);
            }
        }

        // Create booking
        $booking = Booking::create([
            'service_id' => $serviceId,
            'specialist_id' => $specialistId,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'customer_details' => $customerDetails,
            'notes' => $notes,
            'status' => 'confirmed',
            'confirmation_code' => $this->generateConfirmationCode(),
            'timezone' => $timezone
        ]);

        // Attach add-ons
        if (!empty($addonIds)) {
            $booking->addons()->attach($addonIds);
        }

        // Send confirmation email
        $this->sendBookingConfirmation($booking);

        return $booking;
    }

    public function updateStatus(Booking $booking, string $status): void
    {
        $oldStatus = $booking->status;
        $booking->status = $status;
        $booking->save();

        if ($oldStatus !== $status) {
            $message = $this->getStatusChangeMessage($status);
            Mail::to($booking->customer_details['email'])
                ->send(new BookingStatusChanged($booking, $message));
        }
    }

    private function isSlotAvailable(Carbon $start, Carbon $end, $bookings, $locks): bool
    {
        // Check existing bookings
        foreach ($bookings as $booking) {
            if ($this->isOverlapping($start, $end, $booking->start_time, $booking->end_time)) {
                return false;
            }
        }

        // Check temporary locks
        foreach ($locks as $lock) {
            if ($this->isOverlapping(
                $start,
                $end,
                Carbon::parse($lock['start_time']),
                Carbon::parse($lock['end_time'])
            )) {
                return false;
            }
        }

        return true;
    }

    private function isOverlapping(Carbon $start1, Carbon $end1, Carbon $start2, Carbon $end2): bool
    {
        return $start1 < $end2 && $end1 > $start2;
    }

    private function getActiveLocks(int $specialistId, Carbon $date): array
    {
        $pattern = "booking_lock:*";
        $keys = Cache::get($pattern) ?? [];
        
        return collect($keys)
            ->map(fn($key) => Cache::get($key))
            ->filter(function ($lock) use ($specialistId, $date) {
                return $lock 
                    && $lock['specialist_id'] === $specialistId 
                    && Carbon::parse($lock['start_time'])->isSameDay($date);
            })
            ->all();
    }

    private function generateConfirmationCode(): string
    {
        return strtoupper(Str::random(8));
    }

    private function sendBookingConfirmation(Booking $booking): void
    {
        Mail::to($booking->customer_details['email'])
            ->send(new BookingConfirmation($booking));
    }

    private function getStatusChangeMessage(string $status): string
    {
        return match($status) {
            Booking::STATUS_CONFIRMED => 'Your booking has been confirmed.',
            Booking::STATUS_COMPLETED => 'Your appointment has been marked as completed.',
            Booking::STATUS_CANCELLED => 'Your booking has been cancelled.',
            Booking::STATUS_NO_SHOW => 'You were marked as no-show for this appointment.',
            default => 'Your booking status has been updated.'
        };
    }
} 