<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['customer', 'service', 'staff'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(10);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $services = Service::orderBy('name')->get();
        $staff = Staff::where('status', 'active')->orderBy('name')->get();

        return view('admin.appointments.create', compact('customers', 'services', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'notes' => 'nullable|string|max:500',
        ]);

        $appointment = Appointment::create([
            'customer_id' => $validated['customer_id'],
            'service_id' => $validated['service_id'],
            'staff_id' => $validated['staff_id'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'confirmed',
        ]);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully');
    }

    public function edit(Appointment $appointment)
    {
        $customers = Customer::orderBy('name')->get();
        $services = Service::orderBy('name')->get();
        $staff = Staff::where('status', 'active')->orderBy('name')->get();

        return view('admin.appointments.edit', compact('appointment', 'customers', 'services', 'staff'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|in:confirmed,cancelled,completed,no-show',
            'notes' => 'nullable|string|max:500',
        ]);

        $appointment->update($validated);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully');
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed,no-show',
        ]);

        $appointment->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment status updated successfully',
        ]);
    }

    public function calendar()
    {
        $appointments = Appointment::with(['customer', 'service', 'staff'])
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->customer->name . ' - ' . $appointment->service->name,
                    'start' => $appointment->appointment_date . 'T' . $appointment->appointment_time,
                    'end' => Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time)
                        ->addMinutes($appointment->service->duration)
                        ->format('Y-m-d\TH:i:s'),
                    'color' => $this->getStatusColor($appointment->status),
                    'extendedProps' => [
                        'customer' => $appointment->customer->name,
                        'service' => $appointment->service->name,
                        'staff' => $appointment->staff->name,
                        'status' => $appointment->status,
                    ],
                ];
            });

        return view('admin.appointments.calendar', compact('appointments'));
    }

    private function getStatusColor($status)
    {
        return [
            'confirmed' => '#10B981', // green
            'cancelled' => '#EF4444', // red
            'completed' => '#3B82F6', // blue
            'no-show' => '#F59E0B', // yellow
        ][$status] ?? '#6B7280'; // gray default
    }
}
