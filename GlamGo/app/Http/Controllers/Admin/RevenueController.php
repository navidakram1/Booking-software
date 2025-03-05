<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RevenueController extends Controller
{
    /**
     * Display revenue dashboard.
     */
    public function index()
    {
        // Get revenue summary for different time periods
        $today = $this->getRevenueSummary('today');
        $thisWeek = $this->getRevenueSummary('week');
        $thisMonth = $this->getRevenueSummary('month');
        $thisYear = $this->getRevenueSummary('year');

        // Get top performing services
        $topServices = Service::withCount('appointments')
            ->withSum('appointments', 'total_amount')
            ->orderByDesc('appointments_sum_total_amount')
            ->limit(5)
            ->get();

        // Get revenue by service category
        $revenueByCategory = Appointment::join('services', 'appointments.service_id', '=', 'services.id')
            ->join('categories', 'services.category_id', '=', 'categories.id')
            ->select(
                DB::raw('COALESCE(categories.name, "Uncategorized") as category'),
                DB::raw('SUM(appointments.total_amount) as total_revenue')
            )
            ->groupBy('categories.name')
            ->orderByDesc('total_revenue')
            ->get();

        return view('admin.revenue.index', compact(
            'today',
            'thisWeek',
            'thisMonth',
            'thisYear',
            'topServices',
            'revenueByCategory'
        ));
    }

    /**
     * Display daily revenue.
     */
    public function daily()
    {
        return view('admin.revenue.daily');
    }

    /**
     * Display monthly revenue.
     */
    public function monthly()
    {
        return view('admin.revenue.monthly');
    }

    /**
     * Display yearly revenue.
     */
    public function yearly()
    {
        return view('admin.revenue.yearly');
    }

    /**
     * Export revenue report.
     */
    public function export()
    {
        // Add export logic here
        return back()->with('success', 'Report exported successfully');
    }

    private function getRevenueSummary($period)
    {
        $query = Appointment::query();

        switch ($period) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
                break;
            case 'year':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
        }

        return [
            'total' => $query->sum('total_amount'),
            'count' => $query->count(),
            'average' => $query->avg('total_amount')
        ];
    }

    private function getMonthlyRevenue()
    {
        return Appointment::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('SUM(total_amount) as total_revenue'),
            DB::raw('COUNT(*) as appointment_count')
        )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();
    }

    private function calculateRevenueGrowth()
    {
        $currentMonth = Appointment::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');

        $lastMonth = Appointment::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('total_amount');

        if ($lastMonth > 0) {
            return (($currentMonth - $lastMonth) / $lastMonth) * 100;
        }

        return 0;
    }

    private function generateRevenueForecast()
    {
        // Simple linear regression based on historical data
        $historicalData = $this->getMonthlyRevenue();
        
        // Calculate trend and generate forecast
        // This is a simplified example - you might want to use more sophisticated forecasting methods
        $forecast = [];
        $lastValue = $historicalData->first()->total_revenue ?? 0;
        $growth = $this->calculateRevenueGrowth() / 100;

        for ($i = 1; $i <= 6; $i++) {
            $forecast[] = [
                'month' => Carbon::now()->addMonths($i)->format('Y-m'),
                'predicted_revenue' => $lastValue * (1 + $growth)
            ];
            $lastValue = $lastValue * (1 + $growth);
        }

        return $forecast;
    }

    private function generateRevenueReport()
    {
        // Generate and save report file
        // Implementation depends on your export library (e.g., Laravel Excel)
        // This is a placeholder
        return storage_path('app/reports/revenue.csv');
    }
} 