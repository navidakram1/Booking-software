@extends('layouts.main')

@section('title', 'My Profile - GlamGo')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Profile Header -->
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=FF69B4&color=fff&size=128" 
                         alt="Profile Picture" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    <button class="absolute bottom-0 right-0 bg-pink-500 text-white p-2 rounded-full shadow-lg hover:bg-pink-600 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-3xl font-bold text-gray-800">John Doe</h1>
                    <p class="text-gray-600">Member since January 2025</p>
                    <div class="mt-4 flex flex-wrap gap-2 justify-center md:justify-start">
                        <span class="px-4 py-2 bg-pink-100 text-pink-600 rounded-full text-sm font-semibold">
                            Premium Member
                        </span>
                        <span class="px-4 py-2 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold">
                            15 Appointments
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Personal Information -->
            <div class="lg:col-span-2">
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Personal Information</h2>
                        <button class="text-pink-500 hover:text-pink-600 font-semibold">Edit</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Full Name</label>
                            <input type="text" value="John Doe" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                            <input type="email" value="john.doe@example.com" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Phone</label>
                            <input type="tel" value="+1 (555) 123-4567" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Date of Birth</label>
                            <input type="date" value="1990-01-01" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Beauty Preferences -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Beauty Preferences</h2>
                        <button class="text-pink-500 hover:text-pink-600 font-semibold">Edit</button>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Preferred Hair Stylist</label>
                            <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                                <option>Sarah Johnson</option>
                                <option>Michael Smith</option>
                                <option>Emma Davis</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Hair Type</label>
                            <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                                <option>Straight</option>
                                <option>Wavy</option>
                                <option>Curly</option>
                                <option>Coily</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Skin Type</label>
                            <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                                <option>Normal</option>
                                <option>Dry</option>
                                <option>Oily</option>
                                <option>Combination</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Membership Card -->
                <div class="bg-gradient-to-r from-pink-500 to-purple-600 rounded-2xl shadow-xl p-8 text-white">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold">Premium Member</h3>
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="mb-8">
                        <p class="text-sm opacity-80">Member ID</p>
                        <p class="font-bold">PRE-12345-JD</p>
                    </div>
                    <div class="mb-8">
                        <p class="text-sm opacity-80">Valid Until</p>
                        <p class="font-bold">December 2025</p>
                    </div>
                    <button class="w-full bg-white/20 hover:bg-white/30 text-white rounded-lg py-2 transition-all duration-300">
                        View Benefits
                    </button>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Quick Stats</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total Appointments</span>
                            <span class="font-bold text-gray-800">15</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Loyalty Points</span>
                            <span class="font-bold text-gray-800">2,500</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Reviews Given</span>
                            <span class="font-bold text-gray-800">8</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Favorite Services</span>
                            <span class="font-bold text-gray-800">4</span>
                        </div>
                    </div>
                </div>

                <!-- Notification Preferences -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Notification Preferences</h3>
                    <div class="space-y-4">
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" checked class="form-checkbox h-5 w-5 text-pink-500 rounded">
                            <span class="text-gray-700">Appointment Reminders</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" checked class="form-checkbox h-5 w-5 text-pink-500 rounded">
                            <span class="text-gray-700">Special Offers</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-pink-500 rounded">
                            <span class="text-gray-700">Newsletter</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" checked class="form-checkbox h-5 w-5 text-pink-500 rounded">
                            <span class="text-gray-700">SMS Updates</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
