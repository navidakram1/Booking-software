@extends('layouts.app')

@section('content')
<div class="pt-32 pb-20 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">My Appointments</h1>
            <p class="text-lg text-gray-600">Manage your salon appointments and bookings</p>
        </div>

        <!-- Quick Actions -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <a href="{{ route('booking') }}" 
               class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Book New Appointment
            </a>
        </div>

        <!-- Appointments Tabs -->
        <div x-data="{ tab: 'upcoming' }" class="mb-8">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button @click="tab = 'upcoming'"
                            :class="{ 'border-pink-500 text-pink-500': tab === 'upcoming' }"
                            class="border-b-2 py-4 px-1 text-sm font-medium">
                        Upcoming
                    </button>
                    <button @click="tab = 'past'"
                            :class="{ 'border-pink-500 text-pink-500': tab === 'past' }"
                            class="border-b-2 py-4 px-1 text-sm font-medium">
                        Past
                    </button>
                    <button @click="tab = 'cancelled'"
                            :class="{ 'border-pink-500 text-pink-500': tab === 'cancelled' }"
                            class="border-b-2 py-4 px-1 text-sm font-medium">
                        Cancelled
                    </button>
                </nav>
            </div>

            <!-- Upcoming Appointments -->
            <div x-show="tab === 'upcoming'" class="space-y-6 mt-8">
                <!-- Appointment Card -->
                <div class="glass-card rounded-2xl p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm font-medium text-green-500">Confirmed</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mt-2">Hair Styling & Treatment</h3>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    March 25, 2024 - 2:00 PM
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    with Sarah Johnson
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    90 minutes
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2 md:text-right">
                            <span class="text-2xl font-bold text-gray-800">$120.00</span>
                            <div class="flex space-x-2">
                                <button class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Reschedule
                                </button>
                                <button class="px-4 py-2 border border-red-300 rounded-lg shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Another Appointment Card -->
                <div class="glass-card rounded-2xl p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                                <span class="text-sm font-medium text-yellow-500">Pending</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mt-2">Manicure & Pedicure</h3>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    March 28, 2024 - 11:00 AM
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    with Emma Davis
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    60 minutes
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2 md:text-right">
                            <span class="text-2xl font-bold text-gray-800">$80.00</span>
                            <div class="flex space-x-2">
                                <button class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Reschedule
                                </button>
                                <button class="px-4 py-2 border border-red-300 rounded-lg shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Past Appointments -->
            <div x-show="tab === 'past'" class="space-y-6 mt-8">
                <!-- Past Appointment Card -->
                <div class="glass-card rounded-2xl p-6 opacity-75">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-gray-500 rounded-full mr-2"></div>
                                <span class="text-sm font-medium text-gray-500">Completed</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mt-2">Facial Treatment</h3>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    March 15, 2024 - 3:00 PM
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2 md:text-right">
                            <span class="text-2xl font-bold text-gray-800">$150.00</span>
                            <button class="px-4 py-2 border border-pink-300 rounded-lg shadow-sm text-sm font-medium text-pink-700 bg-white hover:bg-pink-50">
                                Leave Review
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cancelled Appointments -->
            <div x-show="tab === 'cancelled'" class="space-y-6 mt-8">
                <!-- Cancelled Appointment Card -->
                <div class="glass-card rounded-2xl p-6 opacity-75">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                                <span class="text-sm font-medium text-red-500">Cancelled</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mt-2">Massage Therapy</h3>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    March 20, 2024 - 1:00 PM
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2 md:text-right">
                            <span class="text-2xl font-bold text-gray-800">$90.00</span>
                            <button class="px-4 py-2 border border-pink-300 rounded-lg shadow-sm text-sm font-medium text-pink-700 bg-white hover:bg-pink-50">
                                Book Again
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
