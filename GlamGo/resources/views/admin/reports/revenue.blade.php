@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Revenue Report</h2>
        <div class="flex gap-3">
            <button onclick="exportReport('pdf')" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
                Export PDF
            </button>
            <button onclick="exportReport('csv')" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Export CSV
            </button>
        </div>
    </div>

    <!-- Revenue Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Total Revenue</h3>
            <div class="text-3xl font-bold text-gray-900">${{ number_format($monthlyRevenue['total'], 2) }}</div>
            <div class="flex items-center mt-2">
                <span class="text-{{ $monthlyRevenue['growth'] >= 0 ? 'green' : 'red' }}-500">
                    {{ $monthlyRevenue['growth'] }}% 
                </span>
                <span class="text-gray-600 ml-1">vs last month</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Revenue Breakdown</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Services</span>
                    <span class="font-medium">${{ number_format($monthlyRevenue['breakdown']['services'], 2) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Products</span>
                    <span class="font-medium">${{ number_format($monthlyRevenue['breakdown']['products'], 2) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Packages</span>
                    <span class="font-medium">${{ number_format($monthlyRevenue['breakdown']['packages'], 2) }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <button class="w-full bg-gray-50 hover:bg-gray-100 text-gray-800 px-4 py-2 rounded-lg text-left">
                    View Detailed Analytics
                </button>
                <button class="w-full bg-gray-50 hover:bg-gray-100 text-gray-800 px-4 py-2 rounded-lg text-left">
                    Schedule Reports
                </button>
                <button class="w-full bg-gray-50 hover:bg-gray-100 text-gray-800 px-4 py-2 rounded-lg text-left">
                    Configure Alerts
                </button>
            </div>
        </div>
    </div>

    <!-- Revenue Chart -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h3 class="text-lg font-medium text-gray-800 mb-4">Revenue Trend</h3>
        <div class="h-80">
            <!-- Chart will be rendered here -->
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Revenue Details Table -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Revenue Details</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Month</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Revenue</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Growth</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Top Service</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($monthlyRevenue['chart_data'] as $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $data['month'] }}</td>
                            <td class="px-4 py-3">${{ number_format($data['revenue'], 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="text-green-500">+5%</span>
                            </td>
                            <td class="px-4 py-3">Hair Styling</td>
                            <td class="px-4 py-3">
                                <button class="text-blue-500 hover:text-blue-700">View Details</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const data = @json($monthlyRevenue['chart_data']);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.map(item => item.month),
            datasets: [{
                label: 'Monthly Revenue',
                data: data.map(item => item.revenue),
                borderColor: '#EC4899',
                backgroundColor: 'rgba(236, 72, 153, 0.1)',
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
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});

function exportReport(format) {
    window.location.href = `{{ route('admin.reports.export') }}?type=revenue&format=${format}`;
}
</script>
@endpush
@endsection 