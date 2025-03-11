<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Support\Facades\Cache;
use App\Models\Booking;

class DashboardController extends Controller
{
    private $cacheDuration = 3600; // 1 hour cache

    public function index()
    {
        // Initialize all variables with default values
        $data = [
            'totalBookings' => 0,
            'monthlyRevenue' => 0,
            'activeServices' => 0,
            'totalCustomers' => 0,
            'recentBookings' => []
        ];

        try {
            // Get total bookings
            $data['totalBookings'] = Booking::count();

            // Get monthly revenue
            $data['monthlyRevenue'] = Booking::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total_amount');

            // Get active services
            $data['activeServices'] = Service::where('status', 'active')->count();

            // Get total customers
            $data['totalCustomers'] = Customer::count();

            // Get recent bookings
            $data['recentBookings'] = Booking::with(['customer', 'service'])
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($booking) {
                    $booking->status_color = $this->getStatusColor($booking->status);
                    return $booking;
                });

        } catch (\Exception $e) {
            // Log the error but don't throw it
            \Log::error('Dashboard data fetch error: ' . $e->getMessage());
        }

        return view('admin.dashboard', $data);
    }

    private function getStatusColor($status)
    {
        return match (strtolower($status)) {
            'completed' => 'success',
            'pending' => 'warning',
            'cancelled' => 'danger',
            'in-progress' => 'info',
            default => 'secondary',
        };
    }

    /**
     * Get revenue analytics data with advanced filtering.
     */
    public function revenueAnalytics(Request $request)
    {
        $query = Appointment::query()
            ->where('status', 'completed')
            ->with(['service', 'customer', 'staff']);

        // Date range filter
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());
        
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        // Service category filter
        if ($request->filled('category')) {
            $query->whereHas('service', function($q) use ($request) {
                $q->where('category', $request->category);
            });
        }

        // Service filter
        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        // Staff filter
        if ($request->filled('staff_id')) {
            $query->where('staff_id', $request->staff_id);
        }

        // Customer filter
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('total_amount', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('total_amount', '<=', $request->max_price);
        }

        // Get filtered data
        $appointments = $query->get();

        // Calculate analytics
        $analytics = [
            'total_revenue' => $appointments->sum('total_amount'),
            'average_revenue' => $appointments->avg('total_amount'),
            'total_appointments' => $appointments->count(),
            'revenue_by_service' => $appointments->groupBy('service.name')
                ->map(function($group) {
                    return [
                        'count' => $group->count(),
                        'revenue' => $group->sum('total_amount'),
                        'average' => $group->avg('total_amount')
                    ];
                }),
            'revenue_by_staff' => $appointments->groupBy('staff.name')
                ->map(function($group) {
                    return [
                        'count' => $group->count(),
                        'revenue' => $group->sum('total_amount'),
                        'average' => $group->avg('total_amount')
                    ];
                }),
            'revenue_by_category' => $appointments->groupBy('service.category')
                ->map(function($group) {
                    return [
                        'count' => $group->count(),
                        'revenue' => $group->sum('total_amount'),
                        'average' => $group->avg('total_amount')
                    ];
                }),
            'daily_revenue' => $appointments->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            })->map(function($group) {
                return [
                    'count' => $group->count(),
                    'revenue' => $group->sum('total_amount'),
                    'average' => $group->avg('total_amount')
                ];
            }),
            'monthly_revenue' => $appointments->groupBy(function($item) {
                return $item->created_at->format('Y-m');
            })->map(function($group) {
                return [
                    'count' => $group->count(),
                    'revenue' => $group->sum('total_amount'),
                    'average' => $group->avg('total_amount')
                ];
            })
        ];

        // Get filter options
        $filterOptions = [
            'services' => Service::orderBy('name')->get(),
            'staff' => Staff::orderBy('name')->get(),
            'categories' => Service::distinct()->pluck('category'),
            'customers' => Customer::orderBy('name')->get()
        ];

        // Get date range for the chart
        $dateRange = [
            'start' => $startDate,
            'end' => $endDate
        ];

        return view('admin.analytics.revenue', compact(
            'analytics',
            'filterOptions',
            'dateRange',
            'request'
        ));
    }

    /**
     * Export revenue analytics data.
     */
    public function exportRevenueAnalytics(Request $request)
    {
        // Reuse the same query from revenueAnalytics
        $query = Appointment::query()
            ->where('status', 'completed')
            ->with(['service', 'customer', 'staff']);

        // Apply the same filters
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());
        
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        // ... apply other filters ...

        $appointments = $query->get();

        // Prepare data for export
        $data = $appointments->map(function($appointment) {
            return [
                'Date' => $appointment->created_at->format('Y-m-d'),
                'Service' => $appointment->service->name,
                'Category' => $appointment->service->category,
                'Customer' => $appointment->customer->name,
                'Staff' => $appointment->staff->name,
                'Amount' => $appointment->total_amount,
                'Status' => $appointment->status
            ];
        });

        // Generate CSV
        $filename = 'revenue_analytics_' . Carbon::now()->format('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->stream(function() use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array_keys($data->first()));
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }, 200, $headers);
    }
}
