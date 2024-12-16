<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['customer', 'service', 'staff'])->latest()->paginate(10);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $services = Service::all();
        $staff = Staff::all();
        $customers = Customer::all();
        return view('admin.appointments.create', compact('services', 'staff', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'nullable|string'
        ]);

        $appointment = Appointment::create([
            'customer_id' => $validated['customer_id'],
            'service_id' => $validated['service_id'],
            'staff_id' => $validated['staff_id'],
            'appointment_datetime' => Carbon::parse($validated['date'] . ' ' . $validated['time']),
            'notes' => $validated['notes'] ?? null,
            'status' => 'scheduled'
        ]);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function edit(Appointment $appointment)
    {
        $services = Service::all();
        $staff = Staff::all();
        $customers = Customer::all();
        return view('admin.appointments.edit', compact('appointment', 'services', 'staff', 'customers'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,confirmed,completed,cancelled'
        ]);

        $appointment->update([
            'customer_id' => $validated['customer_id'],
            'service_id' => $validated['service_id'],
            'staff_id' => $validated['staff_id'],
            'appointment_datetime' => Carbon::parse($validated['date'] . ' ' . $validated['time']),
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status']
        ]);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    public function calendar()
    {
        $appointments = Appointment::with(['customer', 'service', 'staff'])
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'title' => optional($appointment->customer)->name . ' - ' . optional($appointment->service)->name,
                    'start' => $appointment->appointment_datetime->format('Y-m-d\TH:i:s'),
                    'end' => $appointment->appointment_datetime
                        ->addMinutes(optional($appointment->service)->duration ?? 60)
                        ->format('Y-m-d\TH:i:s'),
                    'customer' => optional($appointment->customer)->name ?? 'No Customer',
                    'service' => optional($appointment->service)->name ?? 'No Service',
                    'staff' => optional($appointment->staff)->name ?? 'No Staff',
                    'status' => $appointment->status
                ];
            });

        return view('admin.appointments.calendar', compact('appointments'));
    }
}
