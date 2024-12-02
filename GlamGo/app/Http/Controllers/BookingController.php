<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\AdminBookingNotification;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|integer',
            'service_name' => 'required|string',
            'price' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            // Create booking
            $booking = Booking::create($validated);

            // Send confirmation email to customer
            Mail::to($booking->email)->send(new BookingConfirmation($booking));

            // Send notification to admin
            Mail::to(config('mail.admin_address'))->send(new AdminBookingNotification($booking));

            return response()->json([
                'status' => 'success',
                'message' => 'Booking confirmed successfully!',
                'booking' => $booking
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $bookings = auth()->user()->bookings()->latest()->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    public function adminIndex()
    {
        $bookings = Booking::with('user')->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function adminShow(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking->update($validated);

        if ($booking->status === 'confirmed') {
            Mail::to($booking->email)->send(new BookingConfirmation($booking));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Booking status updated successfully',
            'booking' => $booking
        ]);
    }
}
