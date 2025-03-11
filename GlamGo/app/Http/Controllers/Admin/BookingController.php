<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Staff;
use App\Notifications\BookingRescheduled;
use App\Notifications\BookingStatusChanged;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'service', 'staff'])
            ->when($request->status, function ($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->when($request->date, function ($q) use ($request) {
                return $q->whereDate('start_time', Carbon::parse($request->date));
            })
            ->when($request->staff_id, function ($q) use ($request) {
                return $q->where('staff_id', $request->staff_id);
            });

        if ($request->view === 'calendar') {
            $bookings = $query->get()->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'title' => $booking->service->name . ' - ' . $booking->customer->name,
                    'start' => $booking->start_time,
                    'end' => $booking->end_time,
                    'color' => $this->getStatusColor($booking->status),
                    'url' => route('admin.bookings.show', $booking)
                ];
            });
            return response()->json($bookings);
        }

        $bookings = $query->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        $staff = Staff::all();
        return view('admin.bookings.create', compact('customers', 'services', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $service = Service::findOrFail($validated['service_id']);
            $booking = new Booking($validated);
            $booking->status = 'pending';
            $booking->total_amount = $service->price;
            $booking->payment_status = 'pending';
            $booking->save();

            // Send notifications
            $booking->customer->notify(new BookingStatusChanged($booking, null, 'pending'));

            DB::commit();
            return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages(['error' => 'Failed to create booking. ' . $e->getMessage()]);
        }
    }

    public function show(Booking $booking)
    {
        $booking->load(['customer', 'service', 'staff']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'sometimes|required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
            'cancellation_reason' => 'required_if:status,cancelled|nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $oldStatus = $booking->status;
            $booking->update($validated);

            if ($oldStatus !== $booking->status) {
                $booking->customer->notify(new BookingStatusChanged($booking, $oldStatus, $booking->status));
            }

            DB::commit();
            return redirect()->route('admin.bookings.show', $booking)->with('success', 'Booking updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages(['error' => 'Failed to update booking. ' . $e->getMessage()]);
        }
    }

    public function reschedule(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'staff_id' => 'sometimes|exists:staff,id'
        ]);

        try {
            DB::beginTransaction();

            // Create new booking with updated schedule
            $newBooking = $booking->replicate();
            $newBooking->start_time = $validated['start_time'];
            $newBooking->end_time = $validated['end_time'];
            $newBooking->staff_id = $validated['staff_id'] ?? $booking->staff_id;
            $newBooking->rescheduled_from = $booking->id;
            $newBooking->save();

            // Update old booking status
            $booking->status = 'cancelled';
            $booking->cancellation_reason = 'Rescheduled to new time slot';
            $booking->save();

            // Send notifications
            $booking->customer->notify(new BookingRescheduled($booking, $newBooking));

            DB::commit();
            return redirect()->route('admin.bookings.show', $newBooking)->with('success', 'Booking rescheduled successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages(['error' => 'Failed to reschedule booking. ' . $e->getMessage()]);
        }
    }

    private function getStatusColor($status)
    {
        return [
            'pending' => '#fbbf24',    // Yellow
            'confirmed' => '#60a5fa',   // Blue
            'cancelled' => '#ef4444',   // Red
            'completed' => '#34d399',   // Green
        ][$status] ?? '#6b7280';        // Gray default
    }
} 