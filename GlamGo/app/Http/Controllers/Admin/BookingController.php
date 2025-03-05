<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'service', 'specialist'])
            ->latest();

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        if ($request->filled('specialist')) {
            $query->where('specialist_id', $request->specialist);
        }

        if ($request->filled('service')) {
            $query->where('service_id', $request->service);
        }

        $bookings = $query->paginate(15);
        $specialists = Specialist::all();
        $services = Service::all();

        return view('admin.bookings.index', compact('bookings', 'specialists', 'services'));
    }

    public function calendar()
    {
        $bookings = Booking::with(['service', 'specialist'])
            ->get()
            ->map(function ($booking) {
                $customerDetails = json_decode($booking->customer_details, true);
                return [
                    'id' => $booking->id,
                    'title' => ($customerDetails['name'] ?? 'N/A') . ' - ' . $booking->service->name,
                    'start' => $booking->start_time,
                    'end' => $booking->end_time,
                    'url' => route('admin.bookings.edit', $booking),
                    'className' => $this->getStatusClass($booking->status)
                ];
            });

        return view('admin.bookings.calendar', compact('bookings'));
    }

    public function create()
    {
        $services = Service::active()->get();
        $specialists = Specialist::active()->get();
        $customers = Customer::all();

        return view('admin.bookings.create', compact('services', 'specialists', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'specialist_id' => 'required|exists:specialists,id',
            'appointment_date' => 'required|date|after:now',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking = Booking::create($validated);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        $booking->load(['customer', 'service', 'specialist']);
        $services = Service::active()->get();
        $specialists = Specialist::active()->get();
        $customers = Customer::all();

        return view('admin.bookings.edit', compact('booking', 'services', 'specialists', 'customers'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'specialist_id' => 'required|exists:specialists,id',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking->update($validated);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Booking status updated successfully.');
    }

    public function reschedule(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date|after:now',
            'specialist_id' => 'sometimes|exists:specialists,id'
        ]);

        $booking->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Booking rescheduled successfully.');
    }

    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);

        return redirect()
            ->back()
            ->with('success', 'Booking cancelled successfully.');
    }

    private function getStatusClass($status)
    {
        return [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ][$status] ?? 'bg-gray-100';
    }
} 