<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\AdminBookingNotification;
use App\Events\SlotAvailabilityChanged;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Mail\BookingStatusChanged;
use App\Models\Specialist;
use App\Notifications\BookingConfirmation as BookingConfirmationNotification;
use App\Notifications\BookingReminder;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::where('is_active', true)->get();
        $timeSlots = $this->getTimeSlots();
        
        // Handle service pre-selection if passed
        $selectedService = null;
        if ($request->has('service')) {
            $selectedService = Service::find($request->service);
        }
        
        // Handle specialist pre-selection if passed
        $selectedSpecialist = null;
        if ($request->has('specialist')) {
            $selectedSpecialist = Specialist::find($request->specialist);
        }
        
        return view('booking.index', compact('services', 'timeSlots', 'selectedService', 'selectedSpecialist'));
    }

    public function getSpecialists($serviceId)
    {
        // Get specialists who can perform this service
        $specialists = collect($this->index()->getData()['specialists'])
            ->filter(function($specialist) use ($serviceId) {
                return in_array($serviceId, $specialist['services']);
            })
            ->values();

        return response()->json($specialists);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'specialist_id' => 'required|exists:specialists,id',
            'date' => 'required|date|after:today',
            'time_slot' => 'required|date_format:H:i',
            'payment_method_id' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            // Get the service and specialist
            $service = Service::findOrFail($validated['service_id']);
            $specialist = Specialist::findOrFail($validated['specialist_id']);

            // Check availability
            $availabilityController = new AvailabilityController();
            $availability = $availabilityController->checkSpecialistAvailability(
                new Request(['date' => $validated['date']]),
                $specialist
            )->original;

            if (!in_array($validated['time_slot'], $availability['available_slots'])) {
                throw new \Exception('Selected time slot is no longer available');
            }

            // Calculate booking duration and end time
            $startTime = Carbon::parse($validated['date'] . ' ' . $validated['time_slot']);
            $endTime = $startTime->copy()->addMinutes($service->duration);

            // Process payment
            Stripe::setApiKey(config('services.stripe.secret'));
            
            $paymentIntent = PaymentIntent::create([
                'amount' => $service->price * 100, // Convert to cents
                'currency' => 'usd',
                'payment_method' => $validated['payment_method_id'],
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            // Create booking
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'service_id' => $service->id,
                'specialist_id' => $specialist->id,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'status' => 'confirmed',
                'payment_intent_id' => $paymentIntent->id,
                'amount_paid' => $service->price
            ]);

            // Send notifications
            $user = User::find(auth()->id());
            $user->notify(new BookingConfirmationNotification($booking));
            
            // Schedule reminder notification
            $reminderTime = $startTime->copy()->subHours(24);
            $user->notify((new BookingReminder($booking))->delay($reminderTime));

            DB::commit();

            return response()->json([
                'message' => 'Booking confirmed successfully',
                'booking' => $booking->load(['service', 'specialist']),
                'payment' => [
                    'status' => $paymentIntent->status,
                    'client_secret' => $paymentIntent->client_secret
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Booking failed: ' . $e->getMessage()
            ], 422);
        }
    }

    public function getAvailableTimeSlots(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'specialist_id' => 'required|integer',
            'service_id' => 'required|integer'
        ]);

        // For development, return dummy time slots
        $timeSlots = [
            '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'
        ];

        return response()->json($timeSlots);
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);

        return response()->json([
            'booking' => $booking->load(['service', 'specialist', 'user'])
        ]);
    }

    public function adminIndex(Request $request)
    {
        $query = Booking::with(['service', 'specialist'])
            ->when($request->start_date, function($q) use ($request) {
                $q->whereDate('start_time', '>=', $request->start_date);
            })
            ->when($request->status, function($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->specialist_id, function($q) use ($request) {
                $q->where('specialist_id', $request->specialist_id);
            })
            ->latest('start_time');

        $bookings = $query->paginate(10);
        $specialists = User::where('role', 'specialist')->get();

        return view('admin.bookings.index', compact('bookings', 'specialists'));
    }

    public function adminShow(Booking $booking)
    {
        $booking->load(['service', 'specialist']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $oldStatus = $booking->status;
        $booking->status = $request->status;
        $booking->save();

        // Send notification based on status change
        if ($oldStatus !== $request->status) {
            if ($request->status === 'confirmed') {
                Mail::to($booking->customer_details['email'])
                    ->send(new BookingStatusChanged($booking, 'Your booking has been confirmed'));
            } elseif ($request->status === 'cancelled') {
                Mail::to($booking->customer_details['email'])
                    ->send(new BookingStatusChanged($booking, 'Your booking has been cancelled'));
            }
        }

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking status updated successfully');
    }

    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'service_id' => 'required|integer|exists:services,id',
            'specialist_id' => 'required|integer|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'timezone' => 'required|string'
        ]);

        $date = Carbon::parse($request->date);
        $specialist = User::find($request->specialist_id);
        $service = Service::find($request->service_id);

        // Get specialist's schedule for the day
        $schedule = $this->getSpecialistSchedule($specialist, $date);
        
        // Get existing bookings
        $bookings = Booking::where('specialist_id', $specialist->id)
            ->whereDate('start_time', $date)
            ->get();

        // Generate available time slots
        $slots = $this->generateTimeSlots($schedule, $bookings, $service->duration);

        return response()->json([
            'slots' => $slots
        ]);
    }

    public function lockSlot(Request $request)
    {
        $request->validate([
            'service_id' => 'required|integer',
            'specialist_id' => 'required|integer',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time'
        ]);

        // Check if slot is available
        if (!$this->isSlotAvailable($request->specialist_id, $request->start_time, $request->end_time)) {
            return response()->json([
                'message' => 'Selected time slot is not available'
            ], 422);
        }

        // Generate lock ID and store in cache
        $lockId = uniqid('lock_', true);
        $lockData = [
            'service_id' => $request->service_id,
            'specialist_id' => $request->specialist_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'expires_at' => now()->addMinutes(10)
        ];

        Cache::put("booking_lock:{$lockId}", $lockData, now()->addMinutes(10));

        // Broadcast slot availability change
        event(new SlotAvailabilityChanged(
            $request->service_id,
            $request->specialist_id,
            $request->start_time,
            $request->end_time,
            false
        ));

        return response()->json([
            'lock_id' => $lockId,
            'expires_at' => $lockData['expires_at']
        ]);
    }

    public function releaseLock($lockId)
    {
        $lockData = Cache::get("booking_lock:{$lockId}");
        
        if ($lockData) {
            Cache::forget("booking_lock:{$lockId}");
            
            event(new SlotAvailabilityChanged(
                $lockData['service_id'],
                $lockData['specialist_id'],
                $lockData['start_time'],
                $lockData['end_time'],
                true
            ));
        }

        return response()->noContent();
    }

    public function validateBooking(Request $request)
    {
        $request->validate([
            'service_id' => 'required|integer',
            'specialist_id' => 'required|integer',
            'start_time' => 'required|date|after:now',
            'customer_details' => 'required|array',
            'customer_details.name' => 'required|string',
            'customer_details.email' => 'required|email',
            'customer_details.phone' => 'required|string',
            'lock_id' => 'required|string'
        ]);

        // Verify lock exists and is valid
        $lockData = Cache::get("booking_lock:{$request->lock_id}");
        if (!$lockData) {
            return response()->json([
                'message' => 'Booking lock has expired'
            ], 422);
        }

        return response()->json([
            'message' => 'Booking details are valid'
        ]);
    }

    public function confirmBooking(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|integer',
            'specialist_id' => 'required|integer',
            'start_time' => 'required|date|after:now',
            'customer_details' => 'required|array',
            'customer_details.name' => 'required|string',
            'customer_details.email' => 'required|email',
            'customer_details.phone' => 'required|string',
            'lock_id' => 'required|string'
        ]);

        // Verify lock and create booking
        $lockData = Cache::get("booking_lock:{$request->lock_id}");
        if (!$lockData) {
            return response()->json([
                'message' => 'Booking lock has expired'
            ], 422);
        }

        $service = Service::find($validated['service_id']);
        
        // Create booking
        $booking = Booking::create([
            'service_id' => $validated['service_id'],
            'specialist_id' => $validated['specialist_id'],
            'start_time' => $validated['start_time'],
            'end_time' => Carbon::parse($validated['start_time'])->addMinutes($service->duration),
            'status' => 'confirmed',
            'customer_details' => $validated['customer_details'],
            'total_price' => $service->price,
            'confirmation_code' => strtoupper(uniqid('BK')),
            'timezone' => $request->header('X-Timezone', 'UTC')
        ]);

        // Release lock
        Cache::forget("booking_lock:{$request->lock_id}");

        // Generate calendar invite
        $calendarInvite = $this->generateCalendarInvite($booking);

        // Send confirmation email with calendar invite
        Mail::to($validated['customer_details']['email'])
            ->send(new BookingConfirmation($booking, $calendarInvite));

        return response()->json([
            'booking_id' => $booking->id,
            'confirmation_code' => $booking->confirmation_code,
            'message' => 'Booking confirmed successfully! Check your email for details.'
        ]);
    }

    private function isSlotAvailable($specialistId, $startTime, $endTime)
    {
        // Check existing bookings
        $conflictingBookings = Booking::where('specialist_id', $specialistId)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime]);
            })
            ->count();

        // Check locks
        $conflictingLocks = Cache::get('booking_locks', collect())
            ->where('specialist_id', $specialistId)
            ->where('expires_at', '>', now())
            ->filter(function ($lock) use ($startTime, $endTime) {
                return Carbon::parse($lock['start_time'])->between(
                    Carbon::parse($startTime),
                    Carbon::parse($endTime)
                );
            })
            ->count();

        return $conflictingBookings === 0 && $conflictingLocks === 0;
    }

    private function generateTimeSlots($schedule, $bookings, $serviceDuration)
    {
        $slots = [];
        $date = Carbon::parse($schedule['date']);
        
        // Convert schedule times to Carbon instances
        $startTime = Carbon::parse($schedule['start_time']);
        $endTime = Carbon::parse($schedule['end_time']);
        
        // Break times (lunch, breaks etc)
        $breakTimes = $schedule['breaks'] ?? [];
        
        // Generate slots based on service duration
        $currentSlot = $startTime->copy();
        
        while ($currentSlot->copy()->addMinutes($serviceDuration) <= $endTime) {
            $slotEnd = $currentSlot->copy()->addMinutes($serviceDuration);
            $isAvailable = true;
            
            // Check if slot overlaps with any breaks
            foreach ($breakTimes as $break) {
                $breakStart = Carbon::parse($break['start']);
                $breakEnd = Carbon::parse($break['end']);
                
                if ($currentSlot < $breakEnd && $slotEnd > $breakStart) {
                    $isAvailable = false;
                    break;
                }
            }
            
            // Check if slot overlaps with any existing bookings
            foreach ($bookings as $booking) {
                $bookingStart = Carbon::parse($booking->start_time);
                $bookingEnd = Carbon::parse($booking->end_time);
                
                if ($currentSlot < $bookingEnd && $slotEnd > $bookingStart) {
                    $isAvailable = false;
                    break;
                }
            }
            
            // Check if slot is not in the past
            if ($currentSlot <= now()) {
                $isAvailable = false;
            }
            
            // Add available slot to the list
            if ($isAvailable) {
                $slots[] = [
                    'start_time' => $currentSlot->toDateTimeString(),
                    'end_time' => $slotEnd->toDateTimeString(),
                    'formatted_time' => $currentSlot->format('g:i A')
                ];
            }
            
            // Move to next slot (15-minute intervals)
            $currentSlot->addMinutes(15);
        }
        
        return $slots;
    }

    private function generateCalendarInvite($booking)
    {
        $dtStart = Carbon::parse($booking->start_time)->format('Ymd\THis\Z');
        $dtEnd = Carbon::parse($booking->end_time)->format('Ymd\THis\Z');
        $dtStamp = Carbon::now()->format('Ymd\THis\Z');
        
        // Generate unique identifier for the event
        $uid = $booking->confirmation_code . '@' . config('app.url');
        
        // Build the ICS content
        $ics = [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'PRODID:-//GlamGo//Booking System//EN',
            'CALSCALE:GREGORIAN',
            'METHOD:REQUEST',
            'BEGIN:VEVENT',
            'UID:' . $uid,
            'DTSTAMP:' . $dtStamp,
            'DTSTART:' . $dtStart,
            'DTEND:' . $dtEnd,
            'SUMMARY:' . $booking->service->name . ' at GlamGo',
            'DESCRIPTION:' . 'Your appointment with ' . $booking->specialist->name . '\nBooking Reference: ' . $booking->confirmation_code,
            'LOCATION:GlamGo Salon, 123 Beauty Street, City, State 12345',
            'STATUS:CONFIRMED',
            'SEQUENCE:0',
            'BEGIN:VALARM',
            'TRIGGER:-PT30M',
            'ACTION:DISPLAY',
            'DESCRIPTION:Reminder: Your appointment is in 30 minutes',
            'END:VALARM',
            'END:VEVENT',
            'END:VCALENDAR'
        ];
        
        return implode("\r\n", $ics);
    }

    public function calendar()
    {
        $bookings = Booking::with(['service', 'specialist'])
            ->where('start_time', '>=', now()->startOfWeek())
            ->where('start_time', '<=', now()->endOfWeek())
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'title' => $booking->service->name . ' - ' . ($booking->customer_details['name'] ?? 'Guest'),
                    'start' => $booking->start_time->toDateTimeString(),
                    'end' => $booking->end_time->toDateTimeString(),
                    'color' => $this->getStatusColor($booking->status),
                    'url' => route('admin.bookings.show', $booking)
                ];
            });

        return view('admin.bookings.calendar', compact('bookings'));
    }

    private function getStatusColor($status)
    {
        return [
            'pending' => '#FCD34D',    // Yellow
            'confirmed' => '#34D399',   // Green
            'completed' => '#60A5FA',   // Blue
            'cancelled' => '#F87171',   // Red
        ][$status] ?? '#9CA3AF';       // Gray (default)
    }

    public function cancel(Booking $booking)
    {
        $this->authorize('cancel', $booking);

        try {
            DB::beginTransaction();

            // Check if booking can be cancelled (e.g., not too close to appointment time)
            $startTime = Carbon::parse($booking->start_time);
            if ($startTime->diffInHours(now()) < 24) {
                throw new \Exception('Bookings can only be cancelled at least 24 hours before the appointment');
            }

            // Process refund if applicable
            if ($booking->payment_intent_id) {
                Stripe::setApiKey(config('services.stripe.secret'));
                $refund = \Stripe\Refund::create([
                    'payment_intent' => $booking->payment_intent_id
                ]);
            }

            $booking->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
                'refund_id' => $refund->id ?? null
            ]);

            // Notify user and specialist
            $booking->user->notify(new BookingCancellation($booking));
            $booking->specialist->notify(new BookingCancellation($booking));

            DB::commit();

            return response()->json([
                'message' => 'Booking cancelled successfully',
                'booking' => $booking->fresh()
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Cancellation failed: ' . $e->getMessage()
            ], 422);
        }
    }

    public function reschedule(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $validated = $request->validate([
            'date' => 'required|date|after:today',
            'time_slot' => 'required|date_format:H:i'
        ]);

        try {
            DB::beginTransaction();

            // Check new slot availability
            $availabilityController = new AvailabilityController();
            $availability = $availabilityController->checkSpecialistAvailability(
                new Request(['date' => $validated['date']]),
                $booking->specialist
            )->original;

            if (!in_array($validated['time_slot'], $availability['available_slots'])) {
                throw new \Exception('Selected time slot is not available');
            }

            $startTime = Carbon::parse($validated['date'] . ' ' . $validated['time_slot']);
            $endTime = $startTime->copy()->addMinutes($booking->service->duration);

            $booking->update([
                'start_time' => $startTime,
                'end_time' => $endTime,
                'rescheduled_at' => now()
            ]);

            // Notify user and specialist
            $booking->user->notify(new BookingRescheduled($booking));
            $booking->specialist->notify(new BookingRescheduled($booking));

            DB::commit();

            return response()->json([
                'message' => 'Booking rescheduled successfully',
                'booking' => $booking->fresh()
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Rescheduling failed: ' . $e->getMessage()
            ], 422);
        }
    }

    public function create()
    {
        $services = Service::where('is_active', true)->get();
        $timeSlots = $this->getTimeSlots();
        
        return view('booking', compact('services', 'timeSlots'));
    }

    private function getTimeSlots()
    {
        $slots = [];
        $start = 9; // 9 AM
        $end = 17; // 5 PM

        for ($hour = $start; $hour <= $end; $hour++) {
            $slots[] = sprintf('%02d:00', $hour);
            $slots[] = sprintf('%02d:30', $hour);
        }

        return $slots;
    }

    private function sendConfirmationEmail($booking)
    {
        // Simple email notification
        Mail::raw(
            "Thank you for booking with us!\n\n" .
            "Booking Details:\n" .
            "Service: {$booking->service->name}\n" .
            "Date: {$booking->date}\n" .
            "Time: {$booking->time}\n\n" .
            "We look forward to seeing you!",
            function ($message) use ($booking) {
                $message->to($booking->email)
                    ->subject('Booking Confirmation - GlamGo');
            }
        );
    }
}
