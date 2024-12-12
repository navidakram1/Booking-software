@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Business Trends Analysis</h3>
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

                    <!-- Stats Cards -->
                    <div class="row">
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
                                <span class="info-box-icon bg-success">
                                    <i class="fas fa-users"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">New Customers</span>
                                    <span class="info-box-number">{{ $newCustomers }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning">
                                    <i class="fas fa-star"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Avg. Rating</span>
                                    <span class="info-box-number">{{ number_format($avgRating, 1) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger">
                                    <i class="fas fa-clock"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Peak Hours</span>
                                    <span class="info-box-number">{{ $peakHours }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trend Charts -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Bookings by Service</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="bookingsByServiceChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue by Service</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="revenueByServiceChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Demographics -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Customer Age Distribution</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="ageDistributionChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Customer Gender Distribution</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="genderDistributionChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Time Slots -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Popular Time Slots</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Time Slot</th>
                                                    <th>Bookings</th>
                                                    <th>Revenue</th>
                                                    <th>Most Popular Services</th>
                                                    <th>Avg. Duration</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($popularTimeSlots as $slot)
                                                <tr>
                                                    <td>{{ $slot->time_slot }}</td>
                                                    <td>{{ $slot->bookings_count }}</td>
                                                    <td>${{ number_format($slot->revenue, 2) }}</td>
                                                    <td>{{ $slot->popular_services }}</td>
                                                    <td>{{ $slot->avg_duration }} mins</td>
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

    // Initialize bookings by service chart
    const bookingsCtx = document.getElementById('bookingsByServiceChart').getContext('2d');
    new Chart(bookingsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($serviceData->pluck('name')) !!},
            datasets: [{
                label: 'Number of Bookings',
                data: {!! json_encode($serviceData->pluck('bookings_count')) !!},
                backgroundColor: '#00a65a'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Initialize revenue by service chart
    const revenueCtx = document.getElementById('revenueByServiceChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($serviceData->pluck('name')) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($serviceData->pluck('revenue')) !!},
                backgroundColor: '#f39c12'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Initialize age distribution chart
    const ageCtx = document.getElementById('ageDistributionChart').getContext('2d');
    new Chart(ageCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($ageData->pluck('range')) !!},
            datasets: [{
                data: {!! json_encode($ageData->pluck('count')) !!},
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Initialize gender distribution chart
    const genderCtx = document.getElementById('genderDistributionChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($genderData->pluck('gender')) !!},
            datasets: [{
                data: {!! json_encode($genderData->pluck('count')) !!},
                backgroundColor: ['#00a65a', '#f39c12', '#00c0ef']
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
