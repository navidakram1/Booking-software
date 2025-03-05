@extends('layouts.admin')

@section('title', 'Dashboard - GlamGo Admin')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Revenue -->
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="0">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm">Total Revenue</h3>
            <lord-icon src="https://cdn.lordicon.com/qhviklyi.json" trigger="loop" colors="primary:#121331,secondary:#ec4899" style="width:28px;height:28px"></lord-icon>
        </div>
        <p class="text-2xl font-bold text-gray-800">${{ number_format($currentRevenue, 2) }}</p>
        <p class="text-sm {{ $revenueGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} mt-2 flex items-center">
            <span class="mr-1">{{ $revenueGrowth >= 0 ? '↑' : '↓' }}</span>
            {{ abs(number_format($revenueGrowth, 1)) }}% from last month
        </p>
    </div>

    <!-- Total Bookings -->
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm">Total Bookings</h3>
            <lord-icon src="https://cdn.lordicon.com/uukerzzv.json" trigger="loop" colors="primary:#121331,secondary:#ec4899" style="width:28px;height:28px"></lord-icon>
        </div>
        <p class="text-2xl font-bold text-gray-800">{{ $currentBookings }}</p>
        <p class="text-sm {{ $bookingsGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} mt-2 flex items-center">
            <span class="mr-1">{{ $bookingsGrowth >= 0 ? '↑' : '↓' }}</span>
            {{ abs(number_format($bookingsGrowth, 1)) }}% from last month
        </p>
    </div>

    <!-- New Customers -->
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm">New Customers</h3>
            <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="loop" colors="primary:#121331,secondary:#ec4899" style="width:28px;height:28px"></lord-icon>
        </div>
        <p class="text-2xl font-bold text-gray-800">{{ $newCustomers }}</p>
        <p class="text-sm {{ $customersGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} mt-2 flex items-center">
            <span class="mr-1">{{ $customersGrowth >= 0 ? '↑' : '↓' }}</span>
            {{ abs(number_format($customersGrowth, 1)) }}% from last month
        </p>
    </div>

    <!-- Staff Performance -->
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm">Staff Performance</h3>
            <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="loop" colors="primary:#121331,secondary:#ec4899" style="width:28px;height:28px"></lord-icon>
        </div>
        <p class="text-2xl font-bold text-gray-800">{{ number_format($averageRating, 1) }}</p>
        <div class="flex items-center mt-2">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= round($averageRating))
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @else
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @endif
            @endfor
        </div>
    </div>
</div>

<!-- Charts and Tables -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Revenue Chart -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm" data-aos="fade-up">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Revenue Overview</h2>
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="text-gray-500 hover:text-gray-700">
                    <lord-icon src="https://cdn.lordicon.com/gwuqcxrh.json" trigger="hover" colors="primary:#121331" style="width:24px;height:24px"></lord-icon>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50">This Week</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50">This Month</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50">This Year</a>
                </div>
            </div>
        </div>
        <canvas id="revenueChart" class="w-full h-64"></canvas>
    </div>

    <!-- Popular Services -->
    <div class="bg-white rounded-2xl p-6 shadow-sm" data-aos="fade-up">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Popular Services</h2>
            <a href="{{ route('admin.services.index') }}" class="text-sm text-pink-500 hover:text-pink-600">View All</a>
        </div>
        <div class="space-y-4">
            @foreach($popularServices as $service)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-pink-50 transition-all duration-300">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr($service->name, 0, 2)) }}
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $service->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $service->bookings_count }} bookings</p>
                    </div>
                </div>
                <span class="text-lg font-semibold text-gray-800">${{ number_format($service->price, 2) }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Recent Activity and Schedule -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
    <!-- Recent Bookings -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm" data-aos="fade-up">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Recent Bookings</h2>
            <a href="{{ route('admin.appointments.index') }}" class="text-sm text-pink-500 hover:text-pink-600">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500">
                        <th class="pb-4">Customer</th>
                        <th class="pb-4">Service</th>
                        <th class="pb-4">Date & Time</th>
                        <th class="pb-4">Status</th>
                        <th class="pb-4">Amount</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($recentBookings as $booking)
                    <tr class="border-t border-gray-100">
                        <td class="py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-semibold">
                                    {{ strtoupper(substr($booking->customer->name, 0, 1)) }}
                                </div>
                                <span class="font-medium text-gray-800">{{ $booking->customer->name }}</span>
                            </div>
                        </td>
                        <td class="py-4 text-gray-600">{{ $booking->service->name }}</td>
                        <td class="py-4 text-gray-600">{{ $booking->scheduled_at->format('M d, Y g:i A') }}</td>
                        <td class="py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($booking->status === 'completed') bg-green-100 text-green-600
                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-600
                                @else bg-yellow-100 text-yellow-600
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="py-4 font-medium text-gray-800">${{ number_format($booking->total_amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Today's Schedule -->
    <div class="bg-white rounded-2xl p-6 shadow-sm" data-aos="fade-up">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Today's Schedule</h2>
            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
        </div>
        <div class="space-y-4">
            @forelse($todaySchedule as $appointment)
            <div class="p-4 rounded-xl @if($appointment->status === 'completed') bg-green-50 @elseif($appointment->status === 'cancelled') bg-red-50 @else bg-gray-50 @endif">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-800">{{ $appointment->scheduled_at->format('g:i A') }}</span>
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                        @if($appointment->status === 'completed') bg-green-100 text-green-600
                        @elseif($appointment->status === 'cancelled') bg-red-100 text-red-600
                        @else bg-yellow-100 text-yellow-600
                        @endif">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
                <h3 class="font-medium text-gray-800">{{ $appointment->service->name }}</h3>
                <div class="flex items-center mt-2 text-sm text-gray-500">
                    <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#9ca3af" style="width:16px;height:16px"></lord-icon>
                    <span class="ml-1">{{ $appointment->customer->name }}</span>
                </div>
            </div>
            @empty
            <div class="text-center py-8">
                <lord-icon src="https://cdn.lordicon.com/kxoxiwrf.json" trigger="loop" colors="primary:#9ca3af" style="width:48px;height:48px"></lord-icon>
                <p class="mt-2 text-gray-500">No appointments scheduled for today</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true
    });

    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueData = @json($monthlyRevenue);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: revenueData.map(item => item.date),
            datasets: [{
                label: 'Revenue',
                data: revenueData.map(item => item.total),
                borderColor: '#EC4899',
                backgroundColor: 'rgba(236, 72, 153, 0.1)',
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
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleColor: '#fff',
                    titleFont: {
                        size: 14,
                        weight: 'bold',
                        family: "'Poppins', sans-serif"
                    },
                    bodyFont: {
                        size: 13,
                        family: "'Poppins', sans-serif"
                    },
                    callbacks: {
                        label: function(context) {
                            return '$ ' + context.raw.toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif"
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif"
                        },
                        callback: function(value) {
                            return '$ ' + value.toLocaleString('en-US');
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
