<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use App\Models\Service;

class BookingsController extends Controller
{
    public function index()
    {
        // Get user's bookings
        $bookings = [
            'upcoming' => Booking::where('user_id', auth()->id())
                ->where('start_time', '>=', now())
                ->orderBy('start_time')
                ->get(),
            'past' => Booking::where('user_id', auth()->id())
                ->where('start_time', '<', now())
                ->orderBy('start_time', 'desc')
                ->get()
        ];

        return view('customer.bookings', compact('bookings'));
    }

    public function create()
    {
        // Get available services
        $services = Service::where('is_active', true)->get();
        return view('book.create', compact('services'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'service_id' => 'required|integer',
            'staff_id' => 'required|integer',
            'start_time' => 'required|date|after:today',
            'notes' => 'nullable|string|max:500'
        ]);

        // Check if slot is available
        $conflictingBooking = Booking::where('staff_id', $request->staff_id)
            ->where('start_time', $request->start_time)
            ->exists();

        if ($conflictingBooking) {
            return back()->with('error', 'This time slot is no longer available. Please choose another time.');
        }

        // Create the booking
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->staff_id = $request->staff_id;
        $booking->service_id = $request->service_id;
        $booking->start_time = $request->start_time;
        $booking->notes = $request->notes;
        $booking->status = 'pending';
        $booking->save();

        return redirect()->route('customer.bookings.index')
            ->with('success', 'Booking created successfully! Check your email for confirmation.');
    }

    public function cancel(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Check if booking belongs to user
        if ($booking->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Check if booking can be cancelled (e.g., not within 24 hours)
        if ($booking->start_time->diffInHours(now()) < 24) {
            return back()->with('error', 'Bookings cannot be cancelled within 24 hours.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date|after:today',
            'staff_id' => 'required|integer',
            'service_id' => 'required|integer'
        ]);

        $date = Carbon::parse($request->date);
        
        // Business hours
        $startTime = Carbon::parse('09:00');
        $endTime = Carbon::parse('17:00');
        
        // Get booked slots
        $bookedSlots = Booking::where('staff_id', $request->staff_id)
            ->whereDate('start_time', $date)
            ->pluck('start_time')
            ->map(function($slot) {
                return Carbon::parse($slot)->format('H:i');
            });

        // Generate available slots
        $availableSlots = [];
        $current = clone $startTime;

        while ($current <= $endTime) {
            $timeSlot = $current->format('H:i');
            if (!$bookedSlots->contains($timeSlot)) {
                $availableSlots[] = $timeSlot;
            }
            $current->addMinutes(30);
        }

        return response()->json(['slots' => $availableSlots]);
    }
}
