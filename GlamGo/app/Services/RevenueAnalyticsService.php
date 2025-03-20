<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class RevenueAnalyticsService
{
    private $cacheDuration = 1800; // 30 minutes

    public function getAnalyticsData(Request $request)
    {
        $cacheKey = 'revenue_analytics_' . md5(json_encode($request->all()));
        
        return Cache::remember($cacheKey, $this->cacheDuration, function() use ($request) {
            $query = $this->buildBaseQuery();
            $this->applyFilters($query, $request);
            $bookings = $query->get();
            
            return [
                'analytics' => $this->calculateAnalytics($bookings),
                'filter_options' => $this->getFilterOptions()
            ];
        });
    }

    public function exportData(Request $request)
    {
        $query = $this->buildBaseQuery();
        $this->applyFilters($query, $request);
        return $query->get();
    }

    private function buildBaseQuery()
    {
        return DB::table('bookings')
            ->select(
                'bookings.*',
                'services.name as service_name',
                'services.category as service_category',
                'customers.name as customer_name',
                'staff.name as staff_name'
            )
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->join('customers', 'bookings.customer_id', '=', 'customers.id')
            ->join('staff', 'bookings.staff_id', '=', 'staff.id')
            ->where('bookings.status', 'completed');
    }

    private function applyFilters($query, Request $request)
    {
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('bookings.created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        if ($request->filled('category')) {
            $query->where('services.category', $request->category);
        }
        if ($request->filled('service_id')) {
            $query->where('bookings.service_id', $request->service_id);
        }
        if ($request->filled('staff_id')) {
            $query->where('bookings.staff_id', $request->staff_id);
        }
        if ($request->filled('customer_id')) {
            $query->where('bookings.customer_id', $request->customer_id);
        }
        if ($request->filled('min_price')) {
            $query->where('bookings.total_amount', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('bookings.total_amount', '<=', $request->max_price);
        }
    }

    private function calculateAnalytics($bookings)
    {
        return [
            'total_revenue' => $bookings->sum('total_amount'),
            'average_revenue' => $bookings->avg('total_amount'),
            'total_bookings' => $bookings->count(),
            'revenue_by_service' => $this->groupRevenue($bookings, 'service_name'),
            'revenue_by_staff' => $this->groupRevenue($bookings, 'staff_name'),
            'revenue_by_category' => $this->groupRevenue($bookings, 'service_category')
        ];
    }

    private function groupRevenue($bookings, $groupBy)
    {
        return $bookings->groupBy($groupBy)
            ->map(fn($group) => [
                'count' => $group->count(),
                'revenue' => $group->sum('total_amount'),
                'average' => $group->avg('total_amount')
            ]);
    }

    private function getFilterOptions()
    {
        return Cache::remember('revenue_filter_options', 3600, fn() => [
            'services' => DB::table('services')->select('id', 'name')->orderBy('name')->get(),
            'staff' => DB::table('staff')->select('id', 'name')->orderBy('name')->get(),
            'categories' => DB::table('services')->select('category')->distinct()->pluck('category'),
            'customers' => DB::table('customers')->select('id', 'name')->orderBy('name')->get()
        ]);
    }
} 