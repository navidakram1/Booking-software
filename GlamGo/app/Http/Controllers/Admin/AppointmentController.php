<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Booking;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['service', 'specialist'])
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('is_active', true)->get();
        $specialists = User::where('role', 'specialist')
            ->where('is_active', true)
            ->get();

        return view('admin.bookings.create', compact('services', 'specialists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_details' => 'required|array',
            'customer_details.name' => 'required|string|max:100',
            'customer_details.email' => 'required|email|max:100',
            'customer_details.phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'specialist_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'special_requests' => 'nullable|string',
        ]);

        // Calculate end time based on service duration
        $service = Service::findOrFail($request->service_id);
        $startTime = Carbon::parse($validated['start_time']);
        $endTime = $startTime->copy()->addMinutes($service->duration);

        $booking = Booking::create([
            'service_id' => $validated['service_id'],
            'specialist_id' => $validated['specialist_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'customer_details' => $validated['customer_details'],
            'special_requests' => $validated['special_requests'],
            'total_price' => $service->price,
            'status' => 'pending'
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load(['service', 'specialist']);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $services = Service::where('is_active', true)->get();
        $specialists = User::where('role', 'specialist')
            ->where('is_active', true)
            ->get();

        return view('admin.bookings.edit', compact('booking', 'services', 'specialists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_details' => 'required|array',
            'customer_details.name' => 'required|string|max:100',
            'customer_details.email' => 'required|email|max:100',
            'customer_details.phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'specialist_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'special_requests' => 'nullable|string',
        ]);

        // Update total price if service changed
        if ($booking->service_id != $request->service_id) {
            $service = Service::findOrFail($request->service_id);
            $validated['total_price'] = $service->price;
            
            // Update end time based on new service duration
            $startTime = Carbon::parse($validated['start_time']);
            $validated['end_time'] = $startTime->copy()->addMinutes($service->duration);
        }

        $booking->update($validated);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    /**
     * Display the calendar view of appointments.
     */
    public function calendar()
    {
        $bookings = Booking::with(['service', 'specialist'])
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'title' => $booking->service->name . ' - ' . $booking->customer_details['name'],
                    'start' => $booking->start_time,
                    'end' => $booking->end_time,
                    'url' => route('admin.bookings.edit', $booking),
                    'className' => $this->getStatusClass($booking->status),
                    'extendedProps' => [
                        'customer' => $booking->customer_details['name'],
                        'service' => $booking->service->name,
                        'staff' => $booking->specialist->name,
                        'status' => $booking->status
                    ]
                ];
            });

        return view('admin.bookings.calendar', compact('bookings'));
    }

    /**
     * Get the CSS class for a booking status.
     */
    private function getStatusClass($status)
    {
        return match ($status) {
            'completed' => 'bg-green-100 text-green-800 border-green-200',
            'cancelled' => 'bg-red-100 text-red-800 border-red-200',
            'confirmed' => 'bg-blue-100 text-blue-800 border-blue-200',
            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
            default => 'bg-gray-100 text-gray-800 border-gray-200',
        };
    }
}
