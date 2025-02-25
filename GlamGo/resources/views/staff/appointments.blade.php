@extends('layouts.main')

@section('title', 'Staff Appointments - GlamGo')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    Manage Appointments
                </span>
            </h1>
            <p class="text-lg text-gray-600">View and manage your upcoming appointments</p>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Calendar Section -->
            <div class="lg:col-span-2">
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">February 2025</h2>
                        <div class="flex space-x-2">
                            <button class="p-2 hover:bg-gray-100 rounded-lg transition-all duration-200">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button class="p-2 hover:bg-gray-100 rounded-lg transition-all duration-200">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Calendar Grid -->
                    <div class="grid grid-cols-7 gap-2">
                        <!-- Days of Week -->
                        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                            <div class="text-center text-sm font-medium text-gray-600 py-2">{{ $day }}</div>
                        @endforeach

                        <!-- Calendar Days -->
                        @for($i = 1; $i <= 35; $i++)
                            <div class="aspect-square p-2 {{ $i == 25 ? 'bg-pink-50 ring-2 ring-pink-500' : 'hover:bg-gray-50' }} rounded-lg cursor-pointer transition-all duration-200">
                                <div class="text-sm {{ $i == 25 ? 'font-bold text-pink-600' : 'text-gray-600' }}">{{ $i }}</div>
                                @if($i == 25)
                                    <div class="mt-1">
                                        <div class="text-xs bg-pink-200 text-pink-700 rounded px-1 py-0.5 mb-1">2 slots</div>
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Time Slots -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Available Time Slots</h3>
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                        @foreach($appointments['available_times'] as $time)
                            <button class="px-4 py-2 text-sm {{ $time === '10:00 AM' || $time === '2:00 PM' ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white hover:bg-pink-50 text-gray-700 hover:text-pink-600' }} border border-gray-200 rounded-lg transition-all duration-200">
                                {{ $time }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Appointment Details -->
            <div class="space-y-6">
                <!-- New Appointment Card -->
                <div class="bg-gradient-to-br from-pink-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white">
                    <h3 class="text-xl font-bold mb-4">Create New Appointment</h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Service</label>
                            <select class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/60 focus:ring-2 focus:ring-white/50 focus:border-transparent">
                                <option value="">Select a service</option>
                                @foreach($appointments['services'] as $service)
                                    <option value="{{ $service['id'] }}">{{ $service['name'] }} ({{ $service['duration'] }}min)</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Client Name</label>
                            <input type="text" class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/60 focus:ring-2 focus:ring-white/50 focus:border-transparent" placeholder="Enter client name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Notes</label>
                            <textarea class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/60 focus:ring-2 focus:ring-white/50 focus:border-transparent" rows="2" placeholder="Add appointment notes"></textarea>
                        </div>
                        <button type="submit" class="w-full px-6 py-3 bg-white text-purple-600 rounded-lg font-semibold hover:bg-gray-50 transition-all duration-200">
                            Create Appointment
                        </button>
                    </form>
                </div>

                <!-- Upcoming Appointments -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Upcoming Appointments</h3>
                    <div class="space-y-4">
                        @foreach($appointments['upcoming'] as $appointment)
                            <div class="bg-white border border-gray-100 rounded-xl p-4 hover:shadow-md transition-all duration-200">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-600">{{ $appointment['date'] }}</span>
                                    <span class="px-2 py-1 text-xs rounded-full {{ $appointment['status'] === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ ucfirst($appointment['status']) }}
                                    </span>
                                </div>
                                <h4 class="font-medium text-gray-800">{{ $appointment['client'] }}</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $appointment['time'] }} ({{ $appointment['duration'] }}min)
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    {{ $appointment['service'] }}
                                </div>
                                <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between items-center">
                                    <span class="font-medium text-purple-600">${{ number_format($appointment['price'], 2) }}</span>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-600 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-all duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
