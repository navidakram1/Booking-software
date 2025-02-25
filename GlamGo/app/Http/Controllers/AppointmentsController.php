<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class AppointmentsController extends Controller
{
    public function index()
    {
        // Get user's appointments
        $appointments = [
            'upcoming' => Booking::where('user_id', auth()->id())
                ->where('appointment_date', '>=', now())
                ->orderBy('appointment_date')
                ->get(),
            'past' => Booking::where('user_id', auth()->id())
                ->where('appointment_date', '<', now())
                ->orderBy('appointment_date', 'desc')
                ->get()
        ];

        return view('customer.appointments', compact('appointments'));
    }

    public function create()
    {
        // Get available services
        $services = [
            [
                'id' => 1,
                'name' => 'Haircut & Styling',
                'duration' => 60,
                'price' => 50.00
            ],
            [
                'id' => 2,
                'name' => 'Hair Coloring',
                'duration' => 120,
                'price' => 100.00
            ],
            [
                'id' => 3,
                'name' => 'Manicure',
                'duration' => 45,
                'price' => 35.00
            ],
            [
                'id' => 4,
                'name' => 'Pedicure',
                'duration' => 60,
                'price' => 45.00
            ],
            [
                'id' => 5,
                'name' => 'Facial',
                'duration' => 90,
                'price' => 80.00
            ]
        ];

        return view('book.create', compact('services'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'service_id' => 'required|integer',
            'staff_id' => 'required|integer',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:500'
        ]);

        // Combine date and time
        $appointmentDateTime = Carbon::parse($request->appointment_date . ' ' . $request->appointment_time);

        // Check if slot is available
        $conflictingBooking = Booking::where('staff_id', $request->staff_id)
            ->where('appointment_date', $appointmentDateTime)
            ->exists();

        if ($conflictingBooking) {
            return back()->with('error', 'This time slot is no longer available. Please choose another time.');
        }

        // Create the booking
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->staff_id = $request->staff_id;
        $booking->service_id = $request->service_id;
        $booking->appointment_date = $appointmentDateTime;
        $booking->notes = $request->notes;
        $booking->status = 'pending';
        $booking->save();

        // Send confirmation email (implement later)
        // Mail::to(auth()->user()->email)->send(new BookingConfirmation($booking));

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment booked successfully! Check your email for confirmation.');
    }

    public function cancel(Request $request, $id)
    {
        $appointment = Booking::findOrFail($id);
        
        // Check if appointment belongs to user
        if ($appointment->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Check if appointment can be cancelled (e.g., not within 24 hours)
        if ($appointment->appointment_date->diffInHours(now()) < 24) {
            return back()->with('error', 'Appointments cannot be cancelled within 24 hours.');
        }

        $appointment->status = 'cancelled';
        $appointment->save();

        return back()->with('success', 'Appointment cancelled successfully.');
    }

    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'new_date' => 'required|date|after:now',
            'new_time' => 'required|date_format:H:i',
        ]);

        $appointment = Booking::findOrFail($id);

        // Check if appointment belongs to user
        if ($appointment->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Combine date and time
        $newDateTime = Carbon::parse($request->new_date . ' ' . $request->new_time);

        // Check if new slot is available
        $conflictingBooking = Booking::where('staff_id', $appointment->staff_id)
            ->where('appointment_date', $newDateTime)
            ->where('id', '!=', $id)
            ->exists();

        if ($conflictingBooking) {
            return back()->with('error', 'This time slot is not available. Please choose another time.');
        }

        $appointment->appointment_date = $newDateTime;
        $appointment->status = 'rescheduled';
        $appointment->save();

        return back()->with('success', 'Appointment rescheduled successfully.');
    }

    public function getAvailableSlots(Request $request)
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
            ->whereDate('appointment_date', $date)
            ->pluck('appointment_date')
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
