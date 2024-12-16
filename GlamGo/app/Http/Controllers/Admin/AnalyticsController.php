<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Customer;

class AnalyticsController extends Controller
{
    public function retention()
    {
        return view('admin.analytics.retention');
    }

    public function revenue()
    {
        return view('admin.analytics.revenue');
    }

    public function trends()
    {
        return view('admin.analytics.trends');
    }

    public function abandoned()
    {
        return view('admin.analytics.abandoned');
    }

    public function index()
    {
        // Get top customers with proper null checks
        $topCustomers = Customer::select('id', 'name')
            ->withCount('appointments as visits_count')
            ->orderByDesc('visits_count')
            ->take(5)
            ->get()
            ->map(function ($customer) {
                return [
                    'name' => $customer->name ?? 'Unknown Customer',
                    'visits_count' => $customer->visits_count ?? 0
                ];
            });

        // Get recent activity with proper null checks
        $recentActivity = Appointment::with(['customer', 'service'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($appointment) {
                return [
                    'customer_name' => optional($appointment->customer)->name ?? 'Unknown Customer',
                    'service_name' => optional($appointment->service)->name ?? 'Unknown Service',
                    'date' => $appointment->created_at->format('Y-m-d H:i:s')
                ];
            });

        return view('admin.analytics.index', compact('topCustomers', 'recentActivity'));
    }
}
