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
        try {
            // Get the start of current and previous months
            $currentMonthStart = Carbon::now()->startOfMonth();
            $previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
            
            // Calculate total revenue and growth
            $currentMonthRevenue = Booking::where('status', 'completed')
                ->whereMonth('created_at', $currentMonthStart->month)
                ->whereYear('created_at', $currentMonthStart->year)
                ->sum('total_amount'); // Changed from amount to total_amount
                
            $previousMonthRevenue = Booking::where('status', 'completed')
                ->whereMonth('created_at', $previousMonthStart->month)
                ->whereYear('created_at', $previousMonthStart->year)
                ->sum('total_amount'); // Changed from amount to total_amount
                
            $totalRevenue = $currentMonthRevenue;
            $revenueGrowth = $previousMonthRevenue > 0 
                ? (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100 
                : 100;
                
            // Calculate total bookings and growth
            $currentMonthBookings = Booking::whereMonth('created_at', $currentMonthStart->month)
                ->whereYear('created_at', $currentMonthStart->year)
                ->count();
                
            $previousMonthBookings = Booking::whereMonth('created_at', $previousMonthStart->month)
                ->whereYear('created_at', $previousMonthStart->year)
                ->count();
                
            $totalBookings = $currentMonthBookings;
            $bookingsGrowth = $previousMonthBookings > 0 
                ? (($currentMonthBookings - $previousMonthBookings) / $previousMonthBookings) * 100 
                : 100;
                
            // Get active services count and growth
            $currentMonthServices = Service::where('status', 'active')
                ->whereMonth('created_at', $currentMonthStart->month)
                ->whereYear('created_at', $currentMonthStart->year)
                ->count();
                
            $previousMonthServices = Service::where('status', 'active')
                ->whereMonth('created_at', $previousMonthStart->month)
                ->whereYear('created_at', $previousMonthStart->year)
                ->count();
                
            $activeServices = Service::where('status', 'active')->count();
            $servicesGrowth = $previousMonthServices > 0 
                ? (($currentMonthServices - $previousMonthServices) / $previousMonthServices) * 100 
                : 100;
                
            // Calculate total customers and growth
            $currentMonthCustomers = Customer::whereMonth('created_at', $currentMonthStart->month)
                ->whereYear('created_at', $currentMonthStart->year)
                ->count();
                
            $previousMonthCustomers = Customer::whereMonth('created_at', $previousMonthStart->month)
                ->whereYear('created_at', $previousMonthStart->year)
                ->count();
                
            $totalCustomers = Customer::count();
            $customersGrowth = $previousMonthCustomers > 0 
                ? (($currentMonthCustomers - $previousMonthCustomers) / $previousMonthCustomers) * 100 
                : 100;
                
            // Get popular services with proper relationship
            $popularServices = Service::withCount(['bookings' => function($query) {
                    $query->where('status', 'completed');
                }])
                ->where('status', 'active')
                ->orderByDesc('bookings_count')
                ->take(5)
                ->get()
                ->map(function ($service) {
                    $service->color = $this->getRandomColor();
                    $service->color_bg = $this->getRandomColorBg($service->color);
                    $service->icon = $this->getServiceIcon($service->name);
                    return $service;
                });
                
            // Get recent bookings with proper relationships
            $recentBookings = Booking::with(['customer', 'service'])
                ->latest()
                ->take(5)
                ->get();
                
            // Get today's schedule
            $todaySchedule = Booking::with(['customer', 'service'])
                ->whereDate('scheduled_at', Carbon::today())
                ->orderBy('scheduled_at')
                ->get();
                
            // Get revenue data for chart
            $revenueData = $this->getRevenueData('week');
            
            return view('admin.dashboard', compact(
                'totalRevenue',
                'revenueGrowth',
                'totalBookings',
                'bookingsGrowth',
                'activeServices',
                'servicesGrowth',
                'totalCustomers',
                'customersGrowth',
                'popularServices',
                'recentBookings',
                'todaySchedule',
                'revenueData'
            ));
        } catch (\Exception $e) {
            \Log::error('Dashboard Error: ' . $e->getMessage());
            return view('admin.dashboard', [
                'totalRevenue' => 0,
                'revenueGrowth' => 0,
                'totalBookings' => 0,
                'bookingsGrowth' => 0,
                'activeServices' => 0,
                'servicesGrowth' => 0,
                'totalCustomers' => 0,
                'customersGrowth' => 0,
                'popularServices' => collect([]),
                'recentBookings' => collect([]),
                'todaySchedule' => collect([]),
                'revenueData' => ['labels' => [], 'values' => []]
            ])->with('error', 'There was an error loading the dashboard data.');
        }
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
        try {
            $query = Booking::query() // Changed from Appointment to Booking
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

            $bookings = $query->get();

            // Calculate analytics
            $analytics = [
                'total_revenue' => $bookings->sum('total_amount'),
                'average_revenue' => $bookings->avg('total_amount'),
                'total_bookings' => $bookings->count(),
                'revenue_by_service' => $bookings->groupBy('service.name')
                    ->map(function($group) {
                        return [
                            'count' => $group->count(),
                            'revenue' => $group->sum('total_amount'),
                            'average' => $group->avg('total_amount')
                        ];
                    }),
                'revenue_by_staff' => $bookings->groupBy('staff.name')
                    ->map(function($group) {
                        return [
                            'count' => $group->count(),
                            'revenue' => $group->sum('total_amount'),
                            'average' => $group->avg('total_amount')
                        ];
                    }),
                'revenue_by_category' => $bookings->groupBy('service.category')
                    ->map(function($group) {
                        return [
                            'count' => $group->count(),
                            'revenue' => $group->sum('total_amount'),
                            'average' => $group->avg('total_amount')
                        ];
                    }),
                'daily_revenue' => $bookings->groupBy(function($item) {
                    return $item->created_at->format('Y-m-d');
                })->map(function($group) {
                    return [
                        'count' => $group->count(),
                        'revenue' => $group->sum('total_amount'),
                        'average' => $group->avg('total_amount')
                    ];
                }),
                'monthly_revenue' => $bookings->groupBy(function($item) {
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

            return view('admin.analytics.revenue', compact(
                'analytics',
                'filterOptions',
                'startDate',
                'endDate',
                'request'
            ));
        } catch (\Exception $e) {
            \Log::error('Revenue Analytics Error: ' . $e->getMessage());
            return back()->with('error', 'There was an error loading the revenue analytics.');
        }
    }

    /**
     * Export revenue analytics data.
     */
    public function exportRevenueAnalytics(Request $request)
    {
        // Reuse the same query from revenueAnalytics
        $query = Booking::query()
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

        $bookings = $query->get();

        // Prepare data for export
        $data = $bookings->map(function($booking) {
            return [
                'Date' => $booking->created_at->format('Y-m-d'),
                'Service' => $booking->service->name,
                'Category' => $booking->service->category,
                'Customer' => $booking->customer->name,
                'Staff' => $booking->staff->name,
                'Amount' => $booking->total_amount,
                'Status' => $booking->status
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

    public function getRevenueData($period = 'week')
    {
        try {
            $now = Carbon::now();
            $labels = [];
            $values = [];
            
            switch ($period) {
                case 'week':
                    $startDate = $now->copy()->startOfWeek();
                    $endDate = $now->copy()->endOfWeek();
                    
                    while ($startDate <= $endDate) {
                        $labels[] = $startDate->format('D');
                        $values[] = Booking::whereDate('created_at', $startDate)
                            ->where('status', 'completed')
                            ->sum('total_amount'); // Changed from amount to total_amount
                        $startDate->addDay();
                    }
                    break;
                    
                case 'month':
                    $startDate = $now->copy()->startOfMonth();
                    $endDate = $now->copy()->endOfMonth();
                    
                    while ($startDate <= $endDate) {
                        $labels[] = $startDate->format('d M');
                        $values[] = Booking::whereDate('created_at', $startDate)
                            ->where('status', 'completed')
                            ->sum('total_amount'); // Changed from amount to total_amount
                        $startDate->addDay();
                    }
                    break;
                    
                case 'year':
                    $startDate = $now->copy()->startOfYear();
                    $endDate = $now->copy()->endOfYear();
                    
                    while ($startDate <= $endDate) {
                        $labels[] = $startDate->format('M');
                        $values[] = Booking::whereMonth('created_at', $startDate->month)
                            ->whereYear('created_at', $startDate->year)
                            ->where('status', 'completed')
                            ->sum('total_amount'); // Changed from amount to total_amount
                        $startDate->addMonth();
                    }
                    break;
            }
            
            return [
                'labels' => $labels,
                'values' => $values
            ];
        } catch (\Exception $e) {
            \Log::error('Revenue Data Error: ' . $e->getMessage());
            return [
                'labels' => [],
                'values' => []
            ];
        }
    }
    
    private function getRandomColor()
    {
        $colors = [
            '#3498db', // Blue
            '#2ecc71', // Green
            '#9b59b6', // Purple
            '#e67e22', // Orange
            '#e74c3c', // Red
            '#1abc9c', // Turquoise
            '#f1c40f'  // Yellow
        ];
        return $colors[array_rand($colors)];
    }
    
    private function getRandomColorBg($color)
    {
        return str_replace(')', ', 0.1)', str_replace('#', 'rgba(', $this->hexToRgb($color)));
    }
    
    private function hexToRgb($hex)
    {
        $hex = str_replace('#', '', $hex);
        
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        
        return "rgb($r, $g, $b)";
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
