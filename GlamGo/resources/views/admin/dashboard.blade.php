@extends('layouts.admin')

@section('title', 'Dashboard - GlamGo Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Revenue -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm">Total Revenue</h3>
            <lord-icon src="https://cdn.lordicon.com/qhviklyi.json" trigger="loop" colors="primary:#121331,secondary:#ec4899" style="width:28px;height:28px"></lord-icon>
        </div>
        <p class="text-2xl font-bold text-gray-800">${{ number_format($currentRevenue, 2) }}</p>
        <p class="text-sm {{ $revenueGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} mt-2">
            {{ $revenueGrowth >= 0 ? '+' : '' }}{{ number_format($revenueGrowth, 1) }}% from last month
        </p>
    </div>

    <!-- Total Bookings -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm">Total Bookings</h3>
            <lord-icon src="https://cdn.lordicon.com/uukerzzv.json" trigger="loop" colors="primary:#121331,secondary:#ec4899" style="width:28px;height:28px"></lord-icon>
        </div>
        <p class="text-2xl font-bold text-gray-800">{{ $currentBookings }}</p>
        <p class="text-sm {{ $bookingsGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} mt-2">
            {{ $bookingsGrowth >= 0 ? '+' : '' }}{{ number_format($bookingsGrowth, 1) }}% from last month
        </p>
    </div>

    <!-- New Customers -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm">New Customers</h3>
            <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="loop" colors="primary:#121331,secondary:#ec4899" style="width:28px;height:28px"></lord-icon>
        </div>
        <p class="text-2xl font-bold text-gray-800">{{ $currentCustomers }}</p>
        <p class="text-sm {{ $customersGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} mt-2">
            {{ $customersGrowth >= 0 ? '+' : '' }}{{ number_format($customersGrowth, 1) }}% from last month
        </p>
    </div>

    <!-- Active Staff -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm">Active Staff</h3>
            <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="loop" colors="primary:#121331,secondary:#ec4899" style="width:28px;height:28px"></lord-icon>
        </div>
        <p class="text-2xl font-bold text-gray-800">{{ $activeStaff }}</p>
        <p class="text-sm text-green-500 mt-2">+{{ $newStaffThisMonth }} new this month</p>
    </div>
</div>

<!-- Recent Bookings & Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Bookings -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Recent Bookings</h2>
            <a href="{{ route('admin.appointments.index') }}" class="text-pink-500 hover:text-pink-600 text-sm">View All</a>
        </div>
        <div class="space-y-4">
            @forelse($recentBookings as $booking)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">{{ $booking->customer->name }}</p>
                        <p class="text-sm text-gray-500">{{ $booking->service->name }} • {{ \Carbon\Carbon::parse($booking->appointment_time)->format('g:i A') }}</p>
                    </div>
                </div>
                <span class="px-3 py-1 text-sm text-pink-600 bg-pink-50 rounded-full">{{ ucfirst($booking->status) }}</span>
            </div>
            @empty
            <div class="text-center text-gray-500">No recent bookings</div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Quick Actions</h2>
        <div class="space-y-4">
            <a href="{{ route('admin.appointments.create') }}" class="w-full flex items-center justify-between p-4 bg-pink-50 rounded-xl text-pink-600 hover:bg-pink-100 transition-colors duration-200">
                <span class="font-medium">New Appointment</span>
                <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
            </a>
            <a href="{{ route('admin.services.create') }}" class="w-full flex items-center justify-between p-4 bg-purple-50 rounded-xl text-purple-600 hover:bg-purple-100 transition-colors duration-200">
                <span class="font-medium">Add Service</span>
                <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#9333ea" style="width:20px;height:20px"></lord-icon>
            </a>
            <a href="{{ route('admin.staff.create') }}" class="w-full flex items-center justify-between p-4 bg-blue-50 rounded-xl text-blue-600 hover:bg-blue-100 transition-colors duration-200">
                <span class="font-medium">Add Staff</span>
                <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#2563eb" style="width:20px;height:20px"></lord-icon>
            </a>
            <a href="{{ route('admin.analytics.revenue') }}" class="w-full flex items-center justify-between p-4 bg-green-50 rounded-xl text-green-600 hover:bg-green-100 transition-colors duration-200">
                <span class="font-medium">View Reports</span>
                <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#059669" style="width:20px;height:20px"></lord-icon>
            </a>
        </div>
    </div>
</div>

<!-- Today's Schedule -->
<div class="mt-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Today's Schedule</h2>
            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
        </div>
        <div class="space-y-4">
            @forelse($todayAppointments as $appointment)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div class="flex items-center space-x-4">
                    <div class="text-center w-20">
                        <p class="text-sm font-medium text-gray-800">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">{{ $appointment->customer->name }}</p>
                        <p class="text-sm text-gray-500">{{ $appointment->service->name }} with {{ $appointment->staff->name }}</p>
                    </div>
                </div>
                <span class="px-3 py-1 text-sm {{ $appointment->status === 'confirmed' ? 'text-green-600 bg-green-50' : 'text-yellow-600 bg-yellow-50' }} rounded-full">
                    {{ ucfirst($appointment->status) }}
                </span>
            </div>
            @empty
            <div class="text-center text-gray-500">No appointments scheduled for today</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
