<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Staff;
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
            ->sum('total_amount');
        $lastRevenue = Appointment::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('total_amount');
        $revenueGrowth = $lastRevenue > 0 ? (($currentRevenue - $lastRevenue) / $lastRevenue) * 100 : 100;

        // Calculate total bookings
        $currentBookings = Appointment::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $lastBookings = Appointment::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $bookingsGrowth = $lastBookings > 0 ? (($currentBookings - $lastBookings) / $lastBookings) * 100 : 100;

        // Calculate new customers
        $currentCustomers = Customer::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $lastCustomers = Customer::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $customersGrowth = $lastCustomers > 0 ? (($currentCustomers - $lastCustomers) / $lastCustomers) * 100 : 100;

        // Get active staff count
        $activeStaff = Staff::where('status', 'active')->count();
        $newStaffThisMonth = Staff::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        // Get recent bookings
        $recentBookings = Appointment::with(['customer', 'service', 'staff'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get upcoming appointments for today
        $todayAppointments = Appointment::with(['customer', 'service', 'staff'])
            ->whereDate('appointment_date', Carbon::today())
            ->orderBy('appointment_time')
            ->get();

        return view('admin.dashboard', compact(
            'currentRevenue',
            'revenueGrowth',
            'currentBookings',
            'bookingsGrowth',
            'currentCustomers',
            'customersGrowth',
            'activeStaff',
            'newStaffThisMonth',
            'recentBookings',
            'todayAppointments'
        ));
    }
}
