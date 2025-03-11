<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments.
     */
    public function index(Request $request)
    {
        $query = Appointment::with(['customer', 'service', 'staff']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('appointment_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('appointment_date', '<=', $request->end_date);
        }

        // Filter by service
        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        // Filter by staff
        if ($request->filled('staff_id')) {
            $query->where('staff_id', $request->staff_id);
        }

        // Search by customer name
        if ($request->filled('search')) {
            $query->whereHas('customer', function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        $appointments = $query->latest()->paginate(10);
        $services = Service::orderBy('name')->get();
        $staff = Staff::orderBy('name')->get();

        return view('admin.appointments.index', compact('appointments', 'services', 'staff'));
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        $services = Service::active()->orderBy('name')->get();
        $staff = Staff::where('is_active', true)->orderBy('name')->get();
        $customers = User::where('role', 'customer')->orderBy('name')->get();

        return view('admin.appointments.create', compact('services', 'staff', 'customers'));
    }

    /**
     * Store a newly created appointment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        $service = Service::findOrFail($request->service_id);
        $validated['total_amount'] = $service->price;
        $validated['status'] = 'pending';

        $appointment = Appointment::create($validated);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    /**
     * Show the appointment details.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['customer', 'service', 'staff']);
        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the appointment.
     */
    public function edit(Appointment $appointment)
    {
        $services = Service::active()->orderBy('name')->get();
        $staff = Staff::where('is_active', true)->orderBy('name')->get();
        $customers = User::where('role', 'customer')->orderBy('name')->get();

        return view('admin.appointments.edit', compact('appointment', 'services', 'staff', 'customers'));
    }

    /**
     * Update the appointment.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($request->service_id !== $appointment->service_id) {
            $service = Service::findOrFail($request->service_id);
            $validated['total_amount'] = $service->price;
        }

        $appointment->update($validated);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the appointment.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    /**
     * Update appointment status.
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Appointment status updated successfully.');
    }

    /**
     * Reschedule appointment.
     */
    public function reschedule(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date|after:now'
        ]);

        $appointment->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Appointment rescheduled successfully.');
    }

    /**
     * Export appointments.
     */
    public function export(Request $request)
    {
        $query = Appointment::with(['customer', 'service', 'staff']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('appointment_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('appointment_date', '<=', $request->end_date);
        }

        $appointments = $query->get();

        // Generate CSV
        $filename = 'appointments_' . Carbon::now()->format('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $columns = [
            'ID',
            'Customer',
            'Service',
            'Staff',
            'Date',
            'Status',
            'Amount',
            'Notes'
        ];

        return response()->stream(function() use ($appointments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($appointments as $appointment) {
                fputcsv($file, [
                    $appointment->id,
                    $appointment->customer->name,
                    $appointment->service->name,
                    $appointment->staff->name,
                    $appointment->appointment_date->format('Y-m-d H:i:s'),
                    $appointment->status,
                    $appointment->total_amount,
                    $appointment->notes
                ]);
            }

            fclose($file);
        }, 200, $headers);
    }
}
