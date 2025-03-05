@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Analytics Dashboard</h1>
        <div class="flex space-x-4">
            <select class="border rounded px-3 py-2">
                <option value="7">Last 7 days</option>
                <option value="30">Last 30 days</option>
                <option value="90">Last 90 days</option>
                <option value="365">Last year</option>
            </select>
            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">
                Export Report
            </button>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 mb-2">Total Revenue</h3>
            <div class="text-3xl font-bold">${{ $totalRevenue ?? '0' }}</div>
            <div class="text-sm text-gray-600 mt-2">
                <span class="{{ ($revenueGrowth ?? 0) > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $revenueGrowth ?? '0' }}%
                </span>
                vs previous period
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 mb-2">Total Bookings</h3>
            <div class="text-3xl font-bold">{{ $totalBookings ?? '0' }}</div>
            <div class="text-sm text-gray-600 mt-2">
                <span class="{{ ($bookingsGrowth ?? 0) > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $bookingsGrowth ?? '0' }}%
                </span>
                vs previous period
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 mb-2">New Customers</h3>
            <div class="text-3xl font-bold">{{ $newCustomers ?? '0' }}</div>
            <div class="text-sm text-gray-600 mt-2">
                <span class="{{ ($customerGrowth ?? 0) > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $customerGrowth ?? '0' }}%
                </span>
                vs previous period
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 mb-2">Average Rating</h3>
            <div class="text-3xl font-bold">{{ $avgRating ?? '0' }}/5</div>
            <div class="text-sm text-gray-600 mt-2">
                Based on {{ $totalReviews ?? '0' }} reviews
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Revenue Trend</h2>
                <canvas id="revenueChart" height="300"></canvas>
            </div>
        </div>

        <!-- Top Services -->
        <div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Top Services</h2>
                <div class="space-y-4">
                    @forelse($topServices ?? [] as $service)
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="font-semibold">{{ $service->name }}</div>
                            <div class="text-sm text-gray-600">${{ $service->revenue }} revenue</div>
                        </div>
                        <div class="text-right">
                            <div>{{ $service->bookings }} bookings</div>
                            <div class="text-sm text-gray-600">{{ $service->growth }}% growth</div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-600">
                        No services data available
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Staff Performance -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Staff Performance</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="pb-2">Staff Member</th>
                                <th class="pb-2">Bookings</th>
                                <th class="pb-2">Revenue</th>
                                <th class="pb-2">Rating</th>
                                <th class="pb-2">Utilization</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($staffPerformance ?? [] as $staff)
                            <tr class="border-b">
                                <td class="py-2">
                                    <div class="font-semibold">{{ $staff->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $staff->role }}</div>
                                </td>
                                <td class="py-2">{{ $staff->bookings }}</td>
                                <td class="py-2">${{ $staff->revenue }}</td>
                                <td class="py-2">{{ $staff->rating }}/5</td>
                                <td class="py-2">{{ $staff->utilization }}%</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-600">
                                    No staff performance data available
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Customer Insights -->
        <div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Customer Insights</h2>
                <div class="space-y-6">
                    <!-- Customer Demographics -->
                    <div>
                        <h3 class="font-semibold mb-2">Demographics</h3>
                        <canvas id="demographicsChart" height="200"></canvas>
                    </div>

                    <!-- Customer Satisfaction -->
                    <div>
                        <h3 class="font-semibold mb-2">Satisfaction Metrics</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span>Overall Satisfaction</span>
                                <span class="font-semibold">{{ $satisfaction ?? '0' }}%</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Repeat Customers</span>
                                <span class="font-semibold">{{ $repeatCustomers ?? '0' }}%</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Referral Rate</span>
                                <span class="font-semibold">{{ $referralRate ?? '0' }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueDates ?? []) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($revenueData ?? []) !!},
                borderColor: '#4F46E5',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Demographics Chart
    const demographicsCtx = document.getElementById('demographicsChart').getContext('2d');
    new Chart(demographicsCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($demographicsLabels ?? []) !!},
            datasets: [{
                data: {!! json_encode($demographicsData ?? []) !!},
                backgroundColor: ['#4F46E5', '#10B981', '#F59E0B', '#EF4444']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endpush
@endsection
