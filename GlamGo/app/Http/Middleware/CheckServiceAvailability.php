<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;
use Carbon\Carbon;

class CheckServiceAvailability
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('service')) {
            $service = Service::findOrFail($request->route('service'));
            
            // Get service availability
            $availability = $this->checkAvailability($service);
            
            // Add availability data to the request
            $request->merge(['service_availability' => $availability]);
        }

        return $next($request);
    }

    protected function checkAvailability(Service $service)
    {
        $now = Carbon::now();
        $endOfDay = Carbon::now()->endOfDay();
        
        // Get all bookings for today
        $bookings = Booking::where('service_id', $service->id)
            ->whereDate('booking_time', $now->toDateString())
            ->orderBy('booking_time')
            ->get();

        // Get service duration in minutes
        $duration = $service->duration;

        // Find next available slot
        $nextSlot = $now->copy();
        $availableSlots = [];

        while ($nextSlot->lt($endOfDay)) {
            $slotEnd = $nextSlot->copy()->addMinutes($duration);
            
            // Check if slot conflicts with any booking
            $isAvailable = true;
            foreach ($bookings as $booking) {
                $bookingStart = Carbon::parse($booking->booking_time);
                $bookingEnd = $bookingStart->copy()->addMinutes($duration);
                
                if ($nextSlot->between($bookingStart, $bookingEnd) || 
                    $slotEnd->between($bookingStart, $bookingEnd)) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {
                $availableSlots[] = $nextSlot->format('Y-m-d H:i:s');
                if (count($availableSlots) === 1) {
                    $nextAvailableSlot = $nextSlot->format('Y-m-d H:i:s');
                }
            }

            $nextSlot->addMinutes(30); // Check every 30 minutes
        }

        return [
            'is_available' => !empty($availableSlots),
            'next_available_slot' => $nextAvailableSlot ?? null,
            'available_slots' => $availableSlots
        ];
    }
} 