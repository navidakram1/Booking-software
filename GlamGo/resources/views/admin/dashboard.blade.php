@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.css" rel="stylesheet">
<style>
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .stat-value {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .growth-indicator {
        font-size: 0.9rem;
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .growth-positive {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    
    .growth-negative {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .service-card {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }
    
    .service-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .service-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    .booking-table th {
        font-weight: 600;
        color: #495057;
    }
    
    .booking-table td {
        vertical-align: middle;
    }
    
    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .status-pending {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    
    .status-confirmed {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    
    .status-completed {
        background: rgba(23, 162, 184, 0.1);
        color: #17a2b8;
    }
    
    .status-cancelled {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .chart-container {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    
    .chart-filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .chart-filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        border: 1px solid #dee2e6;
        background: white;
        color: #495057;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .chart-filter-btn.active {
        background: #3498db;
        color: white;
        border-color: #3498db;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="Export Report">
                <i class="fas fa-download"></i> Export
            </button>
            <button class="btn btn-primary" data-bs-toggle="tooltip" title="Refresh Data">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Revenue -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-value">${{ number_format($totalRevenue, 2) }}</div>
                <div class="stat-label">Total Revenue</div>
                <div class="growth-indicator {{ $revenueGrowth >= 0 ? 'growth-positive' : 'growth-negative' }}">
                    <i class="fas fa-{{ $revenueGrowth >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                    {{ abs($revenueGrowth) }}%
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-value">{{ $totalBookings }}</div>
                <div class="stat-label">Total Bookings</div>
                <div class="growth-indicator {{ $bookingsGrowth >= 0 ? 'growth-positive' : 'growth-negative' }}">
                    <i class="fas fa-{{ $bookingsGrowth >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                    {{ abs($bookingsGrowth) }}%
                </div>
            </div>
        </div>

        <!-- Active Services -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                    <i class="fas fa-spa"></i>
                </div>
                <div class="stat-value">{{ $activeServices }}</div>
                <div class="stat-label">Active Services</div>
                <div class="growth-indicator {{ $servicesGrowth >= 0 ? 'growth-positive' : 'growth-negative' }}">
                    <i class="fas fa-{{ $servicesGrowth >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                    {{ abs($servicesGrowth) }}%
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(230, 126, 34, 0.1); color: #e67e22;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value">{{ $totalCustomers }}</div>
                <div class="stat-label">Total Customers</div>
                <div class="growth-indicator {{ $customersGrowth >= 0 ? 'growth-positive' : 'growth-negative' }}">
                    <i class="fas fa-{{ $customersGrowth >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                    {{ abs($customersGrowth) }}%
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Chart & Popular Services -->
    <div class="row g-4 mb-4">
        <!-- Revenue Chart -->
        <div class="col-xl-8">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Revenue Overview</h5>
                    <div class="chart-filters">
                        <button class="chart-filter-btn active" data-period="week">Week</button>
                        <button class="chart-filter-btn" data-period="month">Month</button>
                        <button class="chart-filter-btn" data-period="year">Year</button>
                    </div>
                </div>
                <canvas id="revenueChart" height="300"></canvas>
            </div>
        </div>

        <!-- Popular Services -->
        <div class="col-xl-4">
            <div class="card h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">Popular Services</h5>
                </div>
                <div class="card-body">
                    @foreach($popularServices as $service)
                    <div class="service-card">
                        <div class="service-icon" style="background: {{ $service->color_bg }}; color: {{ $service->color }};">
                            <i class="fas fa-{{ $service->icon }}"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $service->name }}</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $service->bookings_count }} bookings</small>
                                <span class="fw-bold">${{ number_format($service->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings & Today's Schedule -->
    <div class="row g-4">
        <!-- Recent Bookings -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Bookings</h5>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-link">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table booking-table">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Service</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings as $booking)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar">
                                                @if($booking->customer->avatar)
                                                    <img src="{{ $booking->customer->avatar }}" alt="Avatar" class="rounded-circle" width="32">
                                                @else
                                                    <div class="avatar-initial rounded-circle bg-light text-dark">
                                                        {{ substr($booking->customer->name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $booking->customer->name }}</h6>
                                                <small class="text-muted">{{ $booking->customer->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $booking->service->name }}</td>
                                    <td>{{ $booking->scheduled_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($booking->status) }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($booking->amount, 2) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Schedule -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">Today's Schedule</h5>
                </div>
                <div class="card-body">
                    @forelse($todaySchedule as $appointment)
                    <div class="d-flex align-items-center p-3 border-bottom">
                        <div class="me-3">
                            <div class="text-center">
                                <div class="fw-bold">{{ $appointment->scheduled_at->format('h:i A') }}</div>
                                <small class="text-muted">{{ $appointment->duration }} min</small>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $appointment->service->name }}</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <small>{{ $appointment->customer->name }}</small>
                                <span class="status-badge status-{{ strtolower($appointment->status) }}">
                                    {{ $appointment->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-check fa-3x text-muted mb-3"></i>
                        <p class="mb-0">No appointments scheduled for today</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueData['labels']) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($revenueData['values']) !!},
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(255, 255, 255, 0.9)',
                    titleColor: '#2c3e50',
                    bodyColor: '#2c3e50',
                    borderColor: '#e9ecef',
                    borderWidth: 1,
                    padding: 12,
                    boxPadding: 6,
                    usePointStyle: true,
                    callbacks: {
                        label: function(context) {
                            return `Revenue: $${context.parsed.y.toFixed(2)}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f8f9fa'
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
                        }
                    }
                }
            }
        }
    });

    // Chart Period Filter
    document.querySelectorAll('.chart-filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.chart-filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Update chart data based on selected period
            fetch(`/admin/revenue-data?period=${this.dataset.period}`)
                .then(response => response.json())
                .then(data => {
                    revenueChart.data.labels = data.labels;
                    revenueChart.data.datasets[0].data = data.values;
                    revenueChart.update();
                });
        });
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush
