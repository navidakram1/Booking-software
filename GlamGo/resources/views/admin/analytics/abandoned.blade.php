@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Abandoned Bookings Analysis</h3>
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
                                <span class="info-box-icon bg-warning">
                                    <i class="fas fa-shopping-cart"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Abandoned</span>
                                    <span class="info-box-number">{{ $totalAbandoned }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <i class="fas fa-percentage"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Abandonment Rate</span>
                                    <span class="info-box-number">{{ $abandonmentRate }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success">
                                    <i class="fas fa-dollar-sign"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Lost Revenue</span>
                                    <span class="info-box-number">${{ number_format($lostRevenue, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger">
                                    <i class="fas fa-clock"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Avg. Time to Abandon</span>
                                    <span class="info-box-number">{{ $avgTimeToAbandon }} mins</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Abandonment Trend Chart -->
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Abandonment Trend</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="abandonmentTrendChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Abandonment by Service</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="abandonmentByServiceChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Abandoned Bookings Table -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Abandoned Bookings</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Service</th>
                                                    <th>Date</th>
                                                    <th>Time in Cart</th>
                                                    <th>Value</th>
                                                    <th>Last Step</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($abandonedBookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->customer_name }}</td>
                                                    <td>{{ $booking->service_name }}</td>
                                                    <td>{{ $booking->created_at->format('M d, Y') }}</td>
                                                    <td>{{ $booking->time_in_cart }}</td>
                                                    <td>${{ number_format($booking->value, 2) }}</td>
                                                    <td>{{ $booking->last_step }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary" onclick="sendRecoveryEmail({{ $booking->id }})">
                                                            Send Recovery Email
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $abandonedBookings->links() }}
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

    // Initialize abandonment trend chart
    const trendCtx = document.getElementById('abandonmentTrendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($trendData->pluck('date')) !!},
            datasets: [{
                label: 'Abandoned Bookings',
                data: {!! json_encode($trendData->pluck('count')) !!},
                borderColor: '#f39c12',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Initialize service breakdown chart
    const serviceCtx = document.getElementById('abandonmentByServiceChart').getContext('2d');
    new Chart(serviceCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($serviceData->pluck('name')) !!},
            datasets: [{
                data: {!! json_encode($serviceData->pluck('count')) !!},
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});

function sendRecoveryEmail(bookingId) {
    fetch(`/admin/analytics/abandoned/${bookingId}/recover`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Recovery email sent successfully!');
        } else {
            alert('Failed to send recovery email. Please try again.');
        }
    });
}
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@endpush
