<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Services\RevenueAnalyticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Booking;

class DashboardController extends Controller
{
    private $dashboardService;
    private $revenueAnalyticsService;

    public function __construct(
        DashboardService $dashboardService,
        RevenueAnalyticsService $revenueAnalyticsService
    ) {
        $this->dashboardService = $dashboardService;
        $this->revenueAnalyticsService = $revenueAnalyticsService;
    }

    public function index()
    {
        try {
            $dashboardData = $this->dashboardService->getDashboardData();
            return view('admin.dashboard', $dashboardData);
        } catch (\Exception $e) {
            \Log::error('Dashboard Error: ' . $e->getMessage());
            return view('admin.dashboard', [
                'revenue' => ['total' => 0, 'growth' => 0],
                'bookings' => ['total' => 0, 'growth' => 0],
                'services' => ['total' => 0, 'growth' => 0],
                'customers' => ['total' => 0, 'growth' => 0],
                'popular_services' => collect([]),
                'recent_bookings' => collect([]),
                'today_schedule' => collect([]),
                'revenue_chart' => ['labels' => [], 'values' => []]
            ])->with('error', 'There was an error loading the dashboard data.');
        }
    }

    public function revenueAnalytics(Request $request)
    {
        try {
            $data = $this->revenueAnalyticsService->getAnalyticsData($request);
            
            return view('admin.analytics.revenue', array_merge($data, [
                'startDate' => $request->start_date,
                'endDate' => $request->end_date,
                'request' => $request
            ]));
        } catch (\Exception $e) {
            \Log::error('Revenue Analytics Error: ' . $e->getMessage());
            return back()->with('error', 'There was an error loading the revenue analytics.');
        }
    }

    public function exportRevenueAnalytics(Request $request)
    {
        try {
            $bookings = $this->revenueAnalyticsService->exportData($request);
            
            $filename = 'revenue_analytics_' . Carbon::now()->format('Y-m-d') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            return response()->stream(function() use ($bookings) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['Date', 'Service', 'Category', 'Customer', 'Staff', 'Amount', 'Status']);
                
                foreach ($bookings as $booking) {
                    fputcsv($file, [
                        Carbon::parse($booking->created_at)->format('Y-m-d'),
                        $booking->service_name,
                        $booking->service_category,
                        $booking->customer_name,
                        $booking->staff_name,
                        $booking->total_amount,
                        $booking->status
                    ]);
                }
                fclose($file);
            }, 200, $headers);
        } catch (\Exception $e) {
            \Log::error('Export Revenue Analytics Error: ' . $e->getMessage());
            return back()->with('error', 'There was an error exporting the revenue analytics.');
        }
    }
}
