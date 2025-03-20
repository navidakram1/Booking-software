<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBookingsController extends Controller
{
    public function index()
    {
        return view('admin.bookings.index');
    }

    public function calendar()
    {
        return view('admin.bookings.calendar');
    }

    public function getCalendarEvents(Request $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $bookings = Booking::with(['customer', 'service', 'staff'])
            ->whereBetween('scheduled_at', [$start, $end])
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'title' => $booking->customer->name . ' - ' . $booking->service->name,
                    'start' => $booking->scheduled_at->format('Y-m-d H:i:s'),
                    'end' => $booking->scheduled_at->addMinutes($booking->duration)->format('Y-m-d H:i:s'),
                    'color' => $booking->getStatusColor(),
                    'textColor' => '#ffffff',
                    'extendedProps' => [
                        'customer' => $booking->customer->name,
                        'service' => $booking->service->name,
                        'staff' => $booking->staff->name,
                        'status' => $booking->status,
                        'amount' => $booking->formatted_total_amount,
                        'duration' => $booking->duration . ' minutes'
                    ]
                ];
            });

        return response()->json($bookings);
    }

    public function moveCalendarEvent(Request $request)
    {
        try {
            $booking = Booking::findOrFail($request->id);
            
            if (!$booking->canBeRescheduled()) {
                return response()->json(['error' => 'This booking cannot be rescheduled.'], 422);
            }
            
            $newStart = Carbon::parse($request->start);
            $booking->scheduled_at = $newStart;
            $booking->save();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to move booking.'], 500);
        }
    }

    public function resizeCalendarEvent(Request $request)
    {
        try {
            $booking = Booking::findOrFail($request->id);
            
            if (!$booking->canBeModified()) {
                return response()->json(['error' => 'This booking cannot be modified.'], 422);
            }
            
            $newEnd = Carbon::parse($request->end);
            $newDuration = $newEnd->diffInMinutes(Carbon::parse($request->start));
            $booking->duration = $newDuration;
            $booking->save();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to resize booking.'], 500);
        }
    }

    public function list()
    {
        return view('admin.bookings.list');
    }

    public function pending()
    {
        return view('admin.bookings.pending');
    }

    public function create()
    {
        $services = Service::where('status', 'active')->get();
        $staff = Staff::all();
        $customers = Customer::all();
        
        return view('admin.bookings.create', compact('services', 'staff', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'scheduled_at' => 'required|date',
            'duration' => 'required|integer|min:15',
            'total_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();
            
            $booking = Booking::create($validated);
            
            DB::commit();
            
            return redirect()
                ->route('admin.bookings.show', $booking)
                ->with('success', 'Booking created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Failed to create booking. ' . $e->getMessage());
        }
    }

    public function show(Booking $booking)
    {
        $booking->load(['customer', 'service', 'staff']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        if (!$booking->canBeModified()) {
            return back()->with('error', 'This booking cannot be modified.');
        }

        $services = Service::where('status', 'active')->get();
        $staff = Staff::all();
        $customers = Customer::all();
        
        return view('admin.bookings.edit', compact('booking', 'services', 'staff', 'customers'));
    }

    public function update(Request $request, Booking $booking)
    {
        if (!$booking->canBeModified()) {
            return back()->with('error', 'This booking cannot be modified.');
        }

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'scheduled_at' => 'required|date',
            'duration' => 'required|integer|min:15',
            'total_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();
            
            $booking->update($validated);
            
            DB::commit();
            
            return redirect()
                ->route('admin.bookings.show', $booking)
                ->with('success', 'Booking updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Failed to update booking. ' . $e->getMessage());
        }
    }

    public function destroy(Booking $booking)
    {
        if (!$booking->canBeCancelled()) {
            return back()->with('error', 'This booking cannot be cancelled.');
        }

        try {
            $booking->delete();
            return redirect()
                ->route('admin.bookings.index')
                ->with('success', 'Booking cancelled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to cancel booking.');
        }
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', [
                Booking::STATUS_PENDING,
                Booking::STATUS_CONFIRMED,
                Booking::STATUS_COMPLETED,
                Booking::STATUS_CANCELLED,
                Booking::STATUS_NO_SHOW
            ])
        ]);

        try {
            $booking->update($validated);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status.'], 500);
        }
    }

    public function reschedule(Request $request, Booking $booking)
    {
        if (!$booking->canBeRescheduled()) {
            return back()->with('error', 'This booking cannot be rescheduled.');
        }

        $validated = $request->validate([
            'scheduled_at' => 'required|date',
            'duration' => 'sometimes|required|integer|min:15'
        ]);

        try {
            $booking->update($validated);
            return redirect()
                ->route('admin.bookings.show', $booking)
                ->with('success', 'Booking rescheduled successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to reschedule booking.');
        }
    }

    public function export()
    {
        $bookings = Booking::with(['customer', 'service', 'staff'])->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="bookings.csv"',
        ];
        
        $callback = function() use ($bookings) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, [
                'ID',
                'Customer',
                'Service',
                'Staff',
                'Scheduled At',
                'Duration',
                'Status',
                'Total Amount',
                'Created At'
            ]);
            
            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->id,
                    $booking->customer->name,
                    $booking->service->name,
                    $booking->staff->name,
                    $booking->scheduled_at->format('Y-m-d H:i:s'),
                    $booking->duration,
                    $booking->status,
                    $booking->total_amount,
                    $booking->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
} 