<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\ServiceReview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get current month's data
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        // Get previous month's data for comparison
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Calculate total revenue
        $currentRevenue = Appointment::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_amount') ?? 0;
        $lastRevenue = Appointment::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('total_amount') ?? 0;
        $revenueGrowth = $lastRevenue > 0 ? (($currentRevenue - $lastRevenue) / $lastRevenue) * 100 : 0;

        // Calculate total bookings
        $currentBookings = Appointment::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $lastBookings = Appointment::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $bookingsGrowth = $lastBookings > 0 ? (($currentBookings - $lastBookings) / $lastBookings) * 100 : 0;

        // Calculate new customers
        $currentCustomers = Customer::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $lastCustomers = Customer::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $customersGrowth = $lastCustomers > 0 ? (($currentCustomers - $lastCustomers) / $lastCustomers) * 100 : 0;
        $newCustomers = $currentCustomers;

        // Get active specialists count
        $activeStaff = Specialist::where('is_active', true)->count();
        $newStaffThisMonth = Specialist::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        // Calculate average rating
        $averageRating = ServiceReview::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->avg('rating') ?? 0;

        // Get popular services
        $popularServices = Service::withCount(['appointments' => function($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        }])
        ->orderBy('appointments_count', 'desc')
        ->take(5)
        ->get();

        // Get recent bookings
        $recentBookings = Appointment::with(['customer', 'service', 'specialist'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get revenue by service category
        $revenueByCategory = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('categories', 'services.category_id', '=', 'categories.id')
            ->whereBetween('appointments.created_at', [$startOfMonth, $endOfMonth])
            ->select('categories.name', DB::raw('SUM(appointments.total_amount) as total_revenue'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total_revenue', 'desc')
            ->get();

        // Get today's schedule
        $todaySchedule = Appointment::whereDate('appointment_date', Carbon::today())
            ->with(['customer', 'specialist', 'services'])
            ->get();

        // Set monthly revenue
        $monthlyRevenue = $currentRevenue; // Current month's revenue

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
