<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with(['service', 'staff'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('is_active', true)->get();
        $staff = Staff::where('is_active', true)->get();
        $customers = \App\Models\Customer::orderBy('name')->get();

        return view('admin.appointments.create', compact('services', 'staff', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'special_requests' => 'nullable|string',
        ]);

        // Calculate total amount based on service price
        $service = Service::findOrFail($request->service_id);
        $validated['total_amount'] = $service->price;

        $appointment = Appointment::create($validated);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['service', 'staff']);
        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $services = Service::where('is_active', true)->get();
        $staff = Staff::where('is_active', true)->get();

        return view('admin.appointments.edit', compact('appointment', 'services', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'special_requests' => 'nullable|string',
        ]);

        // Update total amount if service changed
        if ($appointment->service_id != $request->service_id) {
            $service = Service::findOrFail($request->service_id);
            $validated['total_amount'] = $service->price;
        }

        $appointment->update($validated);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    /**
     * Display the calendar view of appointments.
     */
    public function calendar()
    {
        $appointments = Appointment::with(['service', 'staff', 'customer'])
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->service->name . ' - ' . $appointment->customer->name,
                    'start' => $appointment->appointment_date,
                    'end' => Carbon::parse($appointment->appointment_date)
                        ->addMinutes($appointment->service->duration),
                    'url' => route('admin.appointments.edit', $appointment->id),
                    'backgroundColor' => $appointment->status === 'confirmed' ? '#10B981' : '#F59E0B',
                ];
            });

        return view('admin.appointments.calendar', compact('appointments'));
    }
}
