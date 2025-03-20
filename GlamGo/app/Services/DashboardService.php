<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    private $cacheDuration = 3600; // 1 hour

    public function getDashboardData()
    {
        $cacheKey = 'dashboard_data_' . now()->format('Y_m');
        
        return Cache::remember($cacheKey, $this->cacheDuration, function() {
            $currentMonthStart = Carbon::now()->startOfMonth();
            $previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
            
            return [
                'revenue' => $this->getRevenueStats($currentMonthStart, $previousMonthStart),
                'bookings' => $this->getBookingStats($currentMonthStart, $previousMonthStart),
                'services' => $this->getServiceStats($currentMonthStart, $previousMonthStart),
                'customers' => $this->getCustomerStats($currentMonthStart, $previousMonthStart),
                'popular_services' => $this->getPopularServices(),
                'recent_bookings' => $this->getRecentBookings(),
                'today_schedule' => $this->getTodaySchedule(),
                'revenue_chart' => $this->getRevenueChartData('week')
            ];
        });
    }

    private function getRevenueStats($currentMonthStart, $previousMonthStart)
    {
        $currentMonthRevenue = DB::table('bookings')
            ->where('status', 'completed')
            ->whereMonth('created_at', $currentMonthStart->month)
            ->whereYear('created_at', $currentMonthStart->year)
            ->sum('total_amount');
            
        $previousMonthRevenue = DB::table('bookings')
            ->where('status', 'completed')
            ->whereMonth('created_at', $previousMonthStart->month)
            ->whereYear('created_at', $previousMonthStart->year)
            ->sum('total_amount');
            
        return [
            'total' => $currentMonthRevenue,
            'growth' => $previousMonthRevenue > 0 
                ? (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100 
                : 100
        ];
    }

    private function getBookingStats($currentMonthStart, $previousMonthStart)
    {
        $currentMonthBookings = DB::table('bookings')
            ->whereMonth('created_at', $currentMonthStart->month)
            ->whereYear('created_at', $currentMonthStart->year)
            ->count();
            
        $previousMonthBookings = DB::table('bookings')
            ->whereMonth('created_at', $previousMonthStart->month)
            ->whereYear('created_at', $previousMonthStart->year)
            ->count();
            
        return [
            'total' => $currentMonthBookings,
            'growth' => $previousMonthBookings > 0 
                ? (($currentMonthBookings - $previousMonthBookings) / $previousMonthBookings) * 100 
                : 100
        ];
    }

    private function getServiceStats($currentMonthStart, $previousMonthStart)
    {
        $activeServices = DB::table('services')
            ->where('is_active', true)
            ->count();
            
        $currentMonthServices = DB::table('services')
            ->where('is_active', true)
            ->whereMonth('created_at', $currentMonthStart->month)
            ->whereYear('created_at', $currentMonthStart->year)
            ->count();
            
        $previousMonthServices = DB::table('services')
            ->where('is_active', true)
            ->whereMonth('created_at', $previousMonthStart->month)
            ->whereYear('created_at', $previousMonthStart->year)
            ->count();
            
        return [
            'total' => $activeServices,
            'growth' => $previousMonthServices > 0 
                ? (($currentMonthServices - $previousMonthServices) / $previousMonthServices) * 100 
                : 100
        ];
    }

    private function getCustomerStats($currentMonthStart, $previousMonthStart)
    {
        $totalCustomers = DB::table('customers')->count();
        
        $currentMonthCustomers = DB::table('customers')
            ->whereMonth('created_at', $currentMonthStart->month)
            ->whereYear('created_at', $currentMonthStart->year)
            ->count();
            
        $previousMonthCustomers = DB::table('customers')
            ->whereMonth('created_at', $previousMonthStart->month)
            ->whereYear('created_at', $previousMonthStart->year)
            ->count();
            
        return [
            'total' => $totalCustomers,
            'growth' => $previousMonthCustomers > 0 
                ? (($currentMonthCustomers - $previousMonthCustomers) / $previousMonthCustomers) * 100 
                : 100
        ];
    }

    private function getPopularServices()
    {
        return DB::table('services')
            ->select('services.*', DB::raw('COUNT(bookings.id) as bookings_count'))
            ->leftJoin('bookings', 'services.id', '=', 'bookings.service_id')
            ->where('services.is_active', true)
            ->where('bookings.status', 'completed')
            ->groupBy('services.id')
            ->orderByDesc('bookings_count')
            ->limit(5)
            ->get()
            ->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'bookings_count' => $service->bookings_count,
                    'color' => $this->getRandomColor(),
                    'icon' => $this->getServiceIcon($service->name)
                ];
            });
    }

    private function getRecentBookings()
    {
        return DB::table('bookings')
            ->select(
                'bookings.id',
                'bookings.created_at',
                'bookings.status',
                'bookings.total_amount',
                'customers.name as customer_name',
                'services.name as service_name'
            )
            ->join('customers', 'bookings.customer_id', '=', 'customers.id')
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->orderByDesc('bookings.created_at')
            ->limit(5)
            ->get();
    }

    private function getTodaySchedule()
    {
        return DB::table('bookings')
            ->select(
                'bookings.id',
                'bookings.scheduled_at',
                'bookings.status',
                'customers.name as customer_name',
                'services.name as service_name'
            )
            ->join('customers', 'bookings.customer_id', '=', 'customers.id')
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->whereDate('scheduled_at', Carbon::today())
            ->orderBy('scheduled_at')
            ->get();
    }

    private function getRevenueChartData($period)
    {
        $cacheKey = 'revenue_chart_' . $period . '_' . now()->format('Y_m_d');
        
        return Cache::remember($cacheKey, $this->cacheDuration, function() use ($period) {
            $now = Carbon::now();
            $dates = $this->getDateRangeForPeriod($period, $now);
            
            $data = DB::table('bookings')
                ->select(DB::raw($this->getDateGroupingSql($period)), DB::raw('SUM(total_amount) as total'))
                ->whereBetween('created_at', [$dates['start'], $dates['end']])
                ->where('status', 'completed')
                ->groupBy(DB::raw($this->getDateGroupingSql($period)))
                ->get()
                ->keyBy($this->getKeyByFormat($period));
            
            return $this->formatChartData($data, $dates, $period);
        });
    }

    private function getDateRangeForPeriod($period, $now)
    {
        switch ($period) {
            case 'week':
                return [
                    'start' => $now->copy()->startOfWeek(),
                    'end' => $now->copy()->endOfWeek()
                ];
            case 'month':
                return [
                    'start' => $now->copy()->startOfMonth(),
                    'end' => $now->copy()->endOfMonth()
                ];
            case 'year':
                return [
                    'start' => $now->copy()->startOfYear(),
                    'end' => $now->copy()->endOfYear()
                ];
        }
    }

    private function getDateGroupingSql($period)
    {
        switch ($period) {
            case 'week':
            case 'month':
                return 'DATE(created_at)';
            case 'year':
                return 'DATE_FORMAT(created_at, "%Y-%m")';
        }
    }

    private function getKeyByFormat($period)
    {
        switch ($period) {
            case 'week':
            case 'month':
                return 'date';
            case 'year':
                return 'date_format';
        }
    }

    private function formatChartData($data, $dates, $period)
    {
        $labels = [];
        $values = [];
        $current = $dates['start']->copy();
        
        while ($current <= $dates['end']) {
            $key = $this->getDateKey($current, $period);
            $format = $this->getDateFormat($period);
            
            $labels[] = $current->format($format);
            $values[] = $data->get($key)?->total ?? 0;
            
            $this->incrementDate($current, $period);
        }
        
        return [
            'labels' => $labels,
            'values' => $values
        ];
    }

    private function getDateKey($date, $period)
    {
        switch ($period) {
            case 'week':
            case 'month':
                return $date->format('Y-m-d');
            case 'year':
                return $date->format('Y-m');
        }
    }

    private function getDateFormat($period)
    {
        switch ($period) {
            case 'week':
                return 'D';
            case 'month':
                return 'd M';
            case 'year':
                return 'M';
        }
    }

    private function incrementDate(&$date, $period)
    {
        switch ($period) {
            case 'week':
            case 'month':
                $date->addDay();
                break;
            case 'year':
                $date->addMonth();
                break;
        }
    }

    private function getRandomColor()
    {
        $colors = [
            '#3498db', '#2ecc71', '#9b59b6', '#e67e22', 
            '#e74c3c', '#1abc9c', '#f1c40f'
        ];
        return $colors[array_rand($colors)];
    }

    private function getServiceIcon($serviceName)
    {
        $icons = [
            'haircut' => 'cut',
            'massage' => 'hands',
            'facial' => 'face-smile',
            'manicure' => 'hand-sparkles',
            'pedicure' => 'socks',
            'spa' => 'spa',
            'makeup' => 'paint-brush',
            'hair-color' => 'palette',
            'waxing' => 'leaf',
            'default' => 'star'
        ];
        
        foreach ($icons as $keyword => $icon) {
            if (stripos($serviceName, $keyword) !== false) {
                return $icon;
            }
        }
        
        return 'star';
    }
} 