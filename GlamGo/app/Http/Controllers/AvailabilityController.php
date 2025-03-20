namespace App\Http\Controllers;

use App\Models\Specialist;
use App\Models\Service;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AvailabilityController extends Controller
{
    public function checkSpecialistAvailability(Request $request, Specialist $specialist)
    {
        $date = Carbon::parse($request->date);
        $cacheKey = "specialist_{$specialist->id}_availability_{$date->format('Y-m-d')}";

        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($specialist, $date) {
            $bookings = Booking::where('specialist_id', $specialist->id)
                ->whereDate('start_time', $date)
                ->get();

            $availableSlots = $this->getAvailableTimeSlots($specialist, $date, $bookings);

            return response()->json([
                'specialist' => $specialist->only(['id', 'name', 'image_url']),
                'date' => $date->format('Y-m-d'),
                'available_slots' => $availableSlots,
                'is_available' => count($availableSlots) > 0
            ]);
        });
    }

    public function checkServiceAvailability(Request $request, Service $service)
    {
        $date = Carbon::parse($request->date);
        $cacheKey = "service_{$service->id}_availability_{$date->format('Y-m-d')}";

        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($service, $date) {
            $specialists = $service->specialists()
                ->where('is_active', true)
                ->get();

            $availableSpecialists = [];
            foreach ($specialists as $specialist) {
                $bookings = Booking::where('specialist_id', $specialist->id)
                    ->whereDate('start_time', $date)
                    ->get();

                $availableSlots = $this->getAvailableTimeSlots($specialist, $date, $bookings);
                
                if (count($availableSlots) > 0) {
                    $availableSpecialists[] = [
                        'specialist' => $specialist->only(['id', 'name', 'image_url']),
                        'available_slots' => $availableSlots
                    ];
                }
            }

            return response()->json([
                'service' => $service->only(['id', 'name']),
                'date' => $date->format('Y-m-d'),
                'available_specialists' => $availableSpecialists,
                'is_available' => count($availableSpecialists) > 0
            ]);
        });
    }

    private function getAvailableTimeSlots($specialist, $date, $bookings)
    {
        // Get specialist's working hours for the given day
        $workingHours = $specialist->workingHours()
            ->where('day_of_week', $date->dayOfWeek)
            ->first();

        if (!$workingHours) {
            return [];
        }

        $startTime = Carbon::parse($workingHours->start_time);
        $endTime = Carbon::parse($workingHours->end_time);
        $interval = 30; // 30-minute slots

        $availableSlots = [];
        $currentSlot = $startTime->copy();

        while ($currentSlot < $endTime) {
            $slotEnd = $currentSlot->copy()->addMinutes($interval);
            
            // Check if slot conflicts with any existing bookings
            $isAvailable = true;
            foreach ($bookings as $booking) {
                $bookingStart = Carbon::parse($booking->start_time);
                $bookingEnd = Carbon::parse($booking->end_time);
                
                if ($currentSlot->between($bookingStart, $bookingEnd) || 
                    $slotEnd->between($bookingStart, $bookingEnd)) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {
                $availableSlots[] = $currentSlot->format('H:i');
            }

            $currentSlot->addMinutes($interval);
        }

        return $availableSlots;
    }

    public function getNextAvailableSlot(Request $request)
    {
        $serviceId = $request->service_id;
        $specialistId = $request->specialist_id;

        $date = Carbon::now();
        $daysToCheck = 7; // Look ahead 7 days
        
        for ($i = 0; $i < $daysToCheck; $i++) {
            if ($specialistId) {
                $availability = $this->checkSpecialistAvailability(
                    new Request(['date' => $date->format('Y-m-d')]),
                    Specialist::find($specialistId)
                )->original;
            } else {
                $availability = $this->checkServiceAvailability(
                    new Request(['date' => $date->format('Y-m-d')]),
                    Service::find($serviceId)
                )->original;
            }

            if ($availability['is_available']) {
                return response()->json([
                    'date' => $date->format('Y-m-d'),
                    'availability' => $availability
                ]);
            }

            $date->addDay();
        }

        return response()->json([
            'message' => 'No availability found in the next ' . $daysToCheck . ' days'
        ], 404);
    }
} 