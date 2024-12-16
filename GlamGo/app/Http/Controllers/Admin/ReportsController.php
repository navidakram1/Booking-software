<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index()
    {
        // Sample data for demonstration
        $revenueStats = [
            'total' => 25000,
            'growth' => 15,
            'chart_data' => [
                ['month' => 'Jan', 'revenue' => 18000],
                ['month' => 'Feb', 'revenue' => 20000],
                ['month' => 'Mar', 'revenue' => 22000],
                ['month' => 'Apr', 'revenue' => 25000],
            ]
        ];

        return view('admin.reports.index', compact('revenueStats'));
    }

    public function revenue()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // Sample data for demonstration
        $monthlyRevenue = [
            'total' => 25000,
            'growth' => 15,
            'breakdown' => [
                'services' => 18000,
                'products' => 5000,
                'packages' => 2000
            ],
            'chart_data' => [
                ['month' => 'Jan', 'revenue' => 18000],
                ['month' => 'Feb', 'revenue' => 20000],
                ['month' => 'Mar', 'revenue' => 22000],
                ['month' => 'Apr', 'revenue' => 25000],
            ]
        ];

        return view('admin.reports.revenue', compact('monthlyRevenue'));
    }

    public function appointments()
    {
        // Sample data for demonstration
        $appointmentStats = [
            'total' => 450,
            'completed' => 380,
            'cancelled' => 40,
            'no_show' => 30,
            'chart_data' => [
                ['date' => '2024-12-10', 'appointments' => 15],
                ['date' => '2024-12-11', 'appointments' => 18],
                ['date' => '2024-12-12', 'appointments' => 12],
                ['date' => '2024-12-13', 'appointments' => 20],
                ['date' => '2024-12-14', 'appointments' => 25],
                ['date' => '2024-12-15', 'appointments' => 22],
                ['date' => '2024-12-16', 'appointments' => 15],
            ]
        ];

        return view('admin.reports.appointments', compact('appointmentStats'));
    }

    public function staff()
    {
        // Sample data for demonstration
        $staffPerformance = [
            'total_staff' => 12,
            'active_staff' => 10,
            'top_performers' => [
                [
                    'name' => 'John Smith',
                    'appointments' => 85,
                    'revenue' => 8500,
                    'rating' => 4.9
                ],
                [
                    'name' => 'Sarah Johnson',
                    'appointments' => 75,
                    'revenue' => 7500,
                    'rating' => 4.8
                ],
                [
                    'name' => 'Michael Brown',
                    'appointments' => 70,
                    'revenue' => 7000,
                    'rating' => 4.7
                ]
            ]
        ];

        return view('admin.reports.staff', compact('staffPerformance'));
    }

    public function services()
    {
        // Sample data for demonstration
        $serviceStats = [
            'total_services' => 25,
            'popular_services' => [
                [
                    'name' => 'Hair Styling',
                    'bookings' => 150,
                    'revenue' => 15000,
                    'rating' => 4.8
                ],
                [
                    'name' => 'Manicure',
                    'bookings' => 120,
                    'revenue' => 6000,
                    'rating' => 4.7
                ],
                [
                    'name' => 'Facial Treatment',
                    'bookings' => 100,
                    'revenue' => 10000,
                    'rating' => 4.9
                ]
            ],
            'chart_data' => [
                ['service' => 'Hair Styling', 'bookings' => 150],
                ['service' => 'Manicure', 'bookings' => 120],
                ['service' => 'Facial', 'bookings' => 100],
                ['service' => 'Massage', 'bookings' => 90],
                ['service' => 'Pedicure', 'bookings' => 85],
            ]
        ];

        return view('admin.reports.services', compact('serviceStats'));
    }

    public function export(Request $request)
    {
        $type = $request->input('type', 'revenue');
        $format = $request->input('format', 'csv');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // TODO: Implement export functionality
        // This would generate and download the report in the requested format

        return redirect()->back()->with('success', 'Report exported successfully');
    }
}
