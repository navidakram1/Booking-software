@extends('layouts.main')

@section('title', 'Customer Dashboard - GlamGo')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Bookings -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Total Bookings</h3>
                <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_bookings'] }}</p>
            <p class="text-sm text-gray-500 mt-2">All time bookings</p>
        </div>

        <!-- Upcoming Appointments -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Upcoming</h3>
                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['upcoming_appointments'] }}</p>
            <p class="text-sm text-gray-500 mt-2">Upcoming appointments</p>
        </div>

        <!-- Completed Appointments -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Completed</h3>
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['completed_appointments'] }}</p>
            <p class="text-sm text-gray-500 mt-2">Completed appointments</p>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ url('/booking') }}" class="flex items-center space-x-2 text-pink-600 hover:text-pink-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Book New Appointment</span>
                </a>
                <a href="{{ url('/profile') }}" class="flex items-center space-x-2 text-purple-600 hover:text-purple-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Update Profile</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 mb-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Recent Bookings</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="text-left text-sm font-medium text-gray-500">
                        <th class="py-3 px-4">Service</th>
                        <th class="py-3 px-4">Specialist</th>
                        <th class="py-3 px-4">Date</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($stats['recent_bookings'] as $booking)
                    <tr class="text-sm text-gray-700">
                        <td class="py-3 px-4">{{ $booking->service->name }}</td>
                        <td class="py-3 px-4">{{ $booking->staff->name }}</td>
                        <td class="py-3 px-4">{{ $booking->date->format('M d, Y') }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $booking->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Favorite Services -->
    <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100">
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Favorite Services</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($stats['favorite_services'] as $service)
            <div class="bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl p-4 border border-gray-100">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $service->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $service->duration }} mins</p>
                        <p class="text-sm font-medium text-purple-600 mt-1">${{ number_format($service->price, 2) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
