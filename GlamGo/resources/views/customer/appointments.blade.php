@extends('layouts.main')

@section('title', 'My Appointments - GlamGo')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
        <!-- Appointments Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">My Appointments</h1>
                <p class="text-gray-600 mt-1">Manage your upcoming and past appointments</p>
            </div>
            <a href="{{ route('booking') }}" class="px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 transition-all duration-300">
                Book New Appointment
            </a>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-8">
            <div class="flex space-x-8">
                <button class="border-b-2 border-purple-500 pb-4 text-purple-600 font-medium">
                    Upcoming
                </button>
                <button class="text-gray-500 pb-4 font-medium hover:text-gray-700">
                    Past
                </button>
            </div>
        </div>

        <!-- Appointments List -->
        <div class="space-y-6">
            <!-- Appointment Card 1 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-lg bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Haircut & Styling</h3>
                            <p class="text-sm text-gray-500">with Jane Smith</p>
                            <div class="flex items-center mt-1">
                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm text-gray-500">Tomorrow at 2:00 PM</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="px-4 py-2 text-sm font-medium text-purple-600 hover:text-purple-700">
                            Reschedule
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Appointment Card 2 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-lg bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Manicure & Pedicure</h3>
                            <p class="text-sm text-gray-500">with John Doe</p>
                            <div class="flex items-center mt-1">
                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm text-gray-500">Next Week, Monday at 10:00 AM</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="px-4 py-2 text-sm font-medium text-purple-600 hover:text-purple-700">
                            Reschedule
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
