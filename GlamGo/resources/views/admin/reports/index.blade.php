@extends('layouts.admin')

@section('title', 'Reports Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-2xl p-8 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Reports Dashboard</h2>
                <p class="text-gray-600 mt-1">View and analyze your business performance</p>
            </div>
            <div class="flex space-x-4">
                <button onclick="window.location.href='{{ route('admin.reports.export') }}'" class="flex items-center px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition duration-200">
                    <lord-icon
                        src="https://cdn.lordicon.com/iiixgoqp.json"
                        trigger="hover"
                        colors="primary:#ffffff"
                        style="width:20px;height:20px">
                    </lord-icon>
                    <span class="ml-2">Export Reports</span>
                </button>
            </div>
        </div>

        <!-- Report Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Revenue Report -->
            <a href="{{ route('admin.reports.revenue') }}" class="bg-gradient-to-br from-pink-50 to-purple-50 p-6 rounded-xl hover:shadow-md transition duration-200">
                <div class="flex items-center mb-4">
                    <lord-icon
                        src="https://cdn.lordicon.com/qhviklyi.json"
                        trigger="hover"
                        colors="primary:#ec4899"
                        style="width:32px;height:32px">
                    </lord-icon>
                    <h3 class="text-lg font-semibold text-gray-800 ml-2">Revenue</h3>
                </div>
                <div class="space-y-2">
                    <p class="text-2xl font-bold text-gray-800">${{ number_format($revenueStats['total']) }}</p>
                    <p class="text-sm text-gray-600">
                        <span class="text-green-500">+{{ $revenueStats['growth'] }}%</span> vs last month
                    </p>
                </div>
            </a>

            <!-- Appointments Report -->
            <a href="{{ route('admin.reports.appointments') }}" class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl hover:shadow-md transition duration-200">
                <div class="flex items-center mb-4">
                    <lord-icon
                        src="https://cdn.lordicon.com/uukerzzv.json"
                        trigger="hover"
                        colors="primary:#3b82f6"
                        style="width:32px;height:32px">
                    </lord-icon>
                    <h3 class="text-lg font-semibold text-gray-800 ml-2">Appointments</h3>
                </div>
                <div class="space-y-2">
                    <p class="text-2xl font-bold text-gray-800">450</p>
                    <p class="text-sm text-gray-600">
                        <span class="text-green-500">+12%</span> completion rate
                    </p>
                </div>
            </a>

            <!-- Staff Report -->
            <a href="{{ route('admin.reports.staff') }}" class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl hover:shadow-md transition duration-200">
                <div class="flex items-center mb-4">
                    <lord-icon
                        src="https://cdn.lordicon.com/dxjqoygy.json"
                        trigger="hover"
                        colors="primary:#10b981"
                        style="width:32px;height:32px">
                    </lord-icon>
                    <h3 class="text-lg font-semibold text-gray-800 ml-2">Staff</h3>
                </div>
                <div class="space-y-2">
                    <p class="text-2xl font-bold text-gray-800">12</p>
                    <p class="text-sm text-gray-600">
                        <span class="text-green-500">95%</span> satisfaction rate
                    </p>
                </div>
            </a>

            <!-- Services Report -->
            <a href="{{ route('admin.reports.services') }}" class="bg-gradient-to-br from-orange-50 to-amber-50 p-6 rounded-xl hover:shadow-md transition duration-200">
                <div class="flex items-center mb-4">
                    <lord-icon
                        src="https://cdn.lordicon.com/zvllgyec.json"
                        trigger="hover"
                        colors="primary:#f97316"
                        style="width:32px;height:32px">
                    </lord-icon>
                    <h3 class="text-lg font-semibold text-gray-800 ml-2">Services</h3>
                </div>
                <div class="space-y-2">
                    <p class="text-2xl font-bold text-gray-800">25</p>
                    <p class="text-sm text-gray-600">
                        <span class="text-green-500">4.8</span> avg rating
                    </p>
                </div>
            </a>
        </div>

        <!-- Revenue Chart -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Revenue Trend</h3>
            <div class="bg-white rounded-xl p-4 h-64">
                <!-- Chart will be rendered here -->
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($revenueStats['chart_data'], 'month')) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode(array_column($revenueStats['chart_data'], 'revenue')) !!},
                borderColor: '#ec4899',
                backgroundColor: '#fce7f3',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush
