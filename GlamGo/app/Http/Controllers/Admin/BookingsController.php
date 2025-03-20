<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function calendar()
    {
        return view('admin.bookings.calendar');
    }

    public function list()
    {
        $bookings = Booking::latest()->paginate(10);
        return view('admin.bookings.list', compact('bookings'));
    }

    public function pending()
    {
        $bookings = Booking::where('status', 'pending')->latest()->paginate(10);
        return view('admin.bookings.pending', compact('bookings'));
    }

    public function create()
    {
        return view('admin.bookings.create');
    }

    public function store(Request $request)
    {
        // Implement booking creation logic
        return redirect()->route('admin.bookings.index');
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        // Implement booking update logic
        return redirect()->route('admin.bookings.index');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        // Implement status update logic
        return redirect()->route('admin.bookings.index');
    }

    public function reschedule(Request $request, Booking $booking)
    {
        // Implement reschedule logic
        return redirect()->route('admin.bookings.index');
    }

    public function export()
    {
        // Implement export logic
        return redirect()->route('admin.bookings.index');
    }

    public function getCalendarEvents()
    {
        // Implement calendar events logic
        return response()->json([]);
    }

    public function moveCalendarEvent(Request $request)
    {
        // Implement event move logic
        return response()->json(['success' => true]);
    }

    public function resizeCalendarEvent(Request $request)
    {
        // Implement event resize logic
        return response()->json(['success' => true]);
    }
} 