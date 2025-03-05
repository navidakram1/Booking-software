@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Revenue Analytics</h3>
                </div>
                <div class="card-body">
                    <!-- Date Range Filter -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date Range</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="daterange" name="daterange">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Stats Cards -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success">
                                    <i class="fas fa-dollar-sign"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Revenue</span>
                                    <span class="info-box-number">${{ number_format($totalRevenue, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <i class="fas fa-chart-line"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Growth Rate</span>
                                    <span class="info-box-number">{{ $growthRate }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning">
                                    <i class="fas fa-shopping-cart"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Avg. Transaction</span>
                                    <span class="info-box-number">${{ number_format($avgTransaction, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Customer LTV</span>
                                    <span class="info-box-number">${{ number_format($customerLTV, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Charts -->
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue Trend</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="revenueTrendChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue by Payment Method</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="paymentMethodChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue by Service Category -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue by Service Category</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="serviceCategoryChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue by Staff Member</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="staffRevenueChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top Revenue Generators -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Top Revenue Generators</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Service</th>
                                                    <th>Revenue</th>
                                                    <th>Bookings</th>
                                                    <th>Avg. Price</th>
                                                    <th>Growth</th>
                                                    <th>Profit Margin</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($topServices as $service)
                                                <tr>
                                                    <td>{{ $service->name }}</td>
                                                    <td>${{ number_format($service->revenue, 2) }}</td>
                                                    <td>{{ $service->bookings_count }}</td>
                                                    <td>${{ number_format($service->avg_price, 2) }}</td>
                                                    <td>
                                                        <span class="text-{{ $service->growth >= 0 ? 'success' : 'danger' }}">
                                                            {{ $service->growth }}%
                                                        </span>
                                                    </td>
                                                    <td>{{ $service->profit_margin }}%</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize date range picker
    $('#daterange').daterangepicker({
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    // Initialize revenue trend chart
    const trendCtx = document.getElementById('revenueTrendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($trendData->pluck('date')) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($trendData->pluck('revenue')) !!},
                borderColor: '#00a65a',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Initialize payment method chart
    const paymentCtx = document.getElementById('paymentMethodChart').getContext('2d');
    new Chart(paymentCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($paymentData->pluck('method')) !!},
            datasets: [{
                data: {!! json_encode($paymentData->pluck('amount')) !!},
                backgroundColor: ['#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Initialize service category chart
    const categoryCtx = document.getElementById('serviceCategoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($categoryData->pluck('name')) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($categoryData->pluck('revenue')) !!},
                backgroundColor: '#00a65a'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Initialize staff revenue chart
    const staffCtx = document.getElementById('staffRevenueChart').getContext('2d');
    new Chart(staffCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($staffData->pluck('name')) !!},
            datasets: [{
                label: 'Revenue Generated',
                data: {!! json_encode($staffData->pluck('revenue')) !!},
                backgroundColor: '#f39c12'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@endpush
