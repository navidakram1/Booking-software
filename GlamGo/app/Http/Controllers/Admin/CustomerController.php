<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Appointment;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $query = Customer::query()
            ->withCount('appointments')
            ->withSum('appointments', 'total_amount as total_spent')
            ->with(['lastAppointment' => function($query) {
                $query->select('id', 'customer_id', 'appointment_date');
            }]);

        // Apply search filter
        if (request()->has('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Apply status filter
        if (request()->has('status') && request('status') !== '') {
            $query->where('is_active', request('status') === 'active');
        }

        // Apply sorting
        switch (request('sort', 'latest')) {
            case 'name':
                $query->orderBy('name');
                break;
            case 'visits':
                $query->orderByDesc('appointments_count');
                break;
            case 'last_visit':
                $query->orderByDesc('last_appointment_date');
                break;
            default:
                $query->latest();
                break;
        }

        // Get statistics
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::where('is_active', true)->count();
        $totalAppointments = Appointment::count();
        $newCustomers = Customer::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $customers = $query->paginate(request('perPage', 10));

        return view('admin.customers.index', compact(
            'customers',
            'totalCustomers',
            'activeCustomers',
            'totalAppointments',
            'newCustomers'
        ));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'marketing_emails' => 'boolean',
        ]);

        // Set boolean fields to false if not present in request
        $validated['email_notifications'] = $request->has('email_notifications');
        $validated['sms_notifications'] = $request->has('sms_notifications');
        $validated['marketing_emails'] = $request->has('marketing_emails');
        $validated['is_active'] = true;

        $customer = Customer::create($validated);

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer created successfully!');
    }

    public function show(Customer $customer)
    {
        $customer->load(['appointments' => function ($query) {
            $query->latest();
        }]);

        return view('admin.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'notes' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ]);

        $customer->update($validated);

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully');
    }

    public function rewards()
    {
        $customers = Customer::withCount('appointments')
            ->with('rewards')
            ->latest()
            ->paginate(25);

        return view('admin.customers.rewards', compact('customers'));
    }

    public function reviews()
    {
        $customers = Customer::withCount('reviews')
            ->with('reviews')
            ->latest()
            ->paginate(25);

        return view('admin.customers.reviews', compact('customers'));
    }

    public function import()
    {
        return view('admin.customers.import');
    }

    public function export()
    {
        $customers = Customer::all();
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=customers.csv',
        ];

        $callback = function() use ($customers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Name', 'Email', 'Phone', 'Address', 'Date of Birth', 'Notes', 'Status']);

            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->name,
                    $customer->email,
                    $customer->phone,
                    $customer->address,
                    $customer->date_of_birth,
                    $customer->notes,
                    $customer->is_active ? 'Active' : 'Inactive'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function importCustomers(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $records = array_map('str_getcsv', file($path));

        // Remove header row
        array_shift($records);

        foreach ($records as $record) {
            if (count($record) >= 4) { // Ensure we have at least name, email, phone
                Customer::updateOrCreate(
                    ['email' => $record[1]], // Use email as unique identifier
                    [
                        'name' => $record[0],
                        'phone' => $record[2],
                        'address' => $record[3] ?? null,
                        'date_of_birth' => isset($record[4]) ? date('Y-m-d', strtotime($record[4])) : null,
                        'notes' => $record[5] ?? null,
                        'is_active' => isset($record[6]) ? strtolower($record[6]) === 'active' : true,
                    ]
                );
            }
        }

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customers imported successfully');
    }
}
