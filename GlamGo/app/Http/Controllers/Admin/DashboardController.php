<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get recent bookings
        $recentBookings = DB::table('bookings')
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->join('specialists', 'bookings.specialist_id', '=', 'specialists.id')
            ->select(
                'bookings.*',
                'services.name as service_name',
                'specialists.name as specialist_name',
                DB::raw('DATE_FORMAT(bookings.start_time, "%Y-%m-%d %H:%i:%s") as formatted_start_time')
            )
            ->orderBy('bookings.created_at', 'desc')
            ->limit(5)
            ->get();

        // Calculate current revenue
        $currentRevenue = DB::table('bookings')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'completed')
            ->sum('total_price');

        // Calculate revenue growth
        $lastMonthRevenue = DB::table('bookings')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->where('status', 'completed')
            ->sum('total_price');

        $revenueGrowth = $lastMonthRevenue > 0 
            ? (($currentRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 100;

        // Calculate current bookings
        $currentBookings = DB::table('bookings')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Calculate bookings growth
        $lastMonthBookings = DB::table('bookings')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        $bookingsGrowth = $lastMonthBookings > 0 
            ? (($currentBookings - $lastMonthBookings) / $lastMonthBookings) * 100 
            : 100;

        // Calculate new customers (based on unique customer_details)
        $newCustomers = DB::table('bookings')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->distinct(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(customer_details, "$.email"))'))
            ->count();

        // Calculate customers growth
        $lastMonthCustomers = DB::table('bookings')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->distinct(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(customer_details, "$.email"))'))
            ->count();

        $customersGrowth = $lastMonthCustomers > 0 
            ? (($newCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100 
            : 100;

        // Get active staff count
        $activeStaff = User::where('role', 'specialist')
            ->where('is_active', true)
            ->count();

        // Get new staff this month
        $newStaffThisMonth = User::where('role', 'specialist')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Calculate average rating
        $averageRating = DB::table('bookings')
            ->whereNotNull('rating')
            ->avg('rating') ?? 0;

        // Get popular services
        $popularServices = Service::withCount('bookings')
            ->orderByDesc('bookings_count')
            ->limit(5)
            ->get();

        // Get today's schedule
        $todaySchedule = DB::table('bookings')
            ->whereDate('start_time', Carbon::today())
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->join('specialists', 'bookings.specialist_id', '=', 'specialists.id')
            ->select(
                'bookings.*',
                'services.name as service_name',
                'specialists.name as specialist_name',
                DB::raw('DATE_FORMAT(bookings.start_time, "%Y-%m-%d %H:%i:%s") as formatted_start_time')
            )
            ->get();

        // Set monthly revenue data for chart
        $monthlyRevenue = DB::table('bookings')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('status', 'completed')
            ->groupBy('date')
            ->orderBy('date')
            ->limit(12)
            ->get();

        return view('admin.dashboard', compact(
            'currentRevenue',
            'revenueGrowth',
            'currentBookings',
            'bookingsGrowth',
            'newCustomers',
            'customersGrowth',
            'activeStaff',
            'newStaffThisMonth',
            'averageRating',
            'todaySchedule',
            'monthlyRevenue',
            'popularServices',
            'recentBookings'
        ));
    }

    /**
     * Get revenue analytics data.
     */
    public function revenueAnalytics()
    {
        return view('admin.analytics.revenue');
    }
}
