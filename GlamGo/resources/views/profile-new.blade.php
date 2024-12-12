@extends('layouts.app')

@section('content')
<div class="pt-32 pb-20 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Profile Header -->
        <div class="glass-card rounded-2xl p-8 mb-8">
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-8">
                <div class="relative">
                    <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}" 
                         alt="Profile Picture" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    <button class="absolute bottom-0 right-0 bg-pink-500 text-white p-2 rounded-full shadow-lg hover:bg-pink-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>
                </div>
                <div class="text-center md:text-left flex-1">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">{{ auth()->user()->name }}</h1>
                            <p class="text-gray-600">Member since {{ auth()->user()->created_at->format('F Y') }}</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <button class="px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl hover:from-pink-600 hover:to-purple-700 transition-all">
                                Book New Appointment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Navigation -->
        <div class="glass-card rounded-2xl p-4 mb-8">
            <nav class="flex flex-wrap gap-4">
                <button class="px-6 py-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-medium">
                    Profile
                </button>
                <button class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 font-medium hover:bg-gray-200 transition-all">
                    Appointments
                </button>
                <button class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 font-medium hover:bg-gray-200 transition-all">
                    Favorite Services
                </button>
                <button class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 font-medium hover:bg-gray-200 transition-all">
                    Saved Stylists
                </button>
            </nav>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Stats & Quick Actions -->
            <div class="space-y-8">
                <!-- Quick Stats -->
                <div class="glass-card rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Stats</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-pink-50 rounded-xl">
                            <p class="text-3xl font-bold text-pink-500">12</p>
                            <p class="text-sm text-gray-600">Appointments</p>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-xl">
                            <p class="text-3xl font-bold text-purple-600">450</p>
                            <p class="text-sm text-gray-600">Points</p>
                        </div>
                        <div class="text-center p-4 bg-pink-50 rounded-xl">
                            <p class="text-3xl font-bold text-pink-500">8</p>
                            <p class="text-sm text-gray-600">Reviews</p>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-xl">
                            <p class="text-3xl font-bold text-purple-600">4</p>
                            <p class="text-sm text-gray-600">Favorites</p>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Appointment -->
                <div class="glass-card rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Next Appointment</h3>
                    <div class="bg-gradient-to-r from-pink-500 to-purple-600 text-white p-4 rounded-xl">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm opacity-90">Dec 15, 2024</span>
                            <span class="text-sm opacity-90">2:30 PM</span>
                        </div>
                        <h4 class="font-semibold mb-1">Hair Styling & Treatment</h4>
                        <p class="text-sm opacity-90">with Sarah Johnson</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm">45 minutes</span>
                            <button class="px-4 py-1 bg-white/20 rounded-full text-sm hover:bg-white/30 transition-colors">
                                Reschedule
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content - Profile Information -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Personal Information -->
                <div class="glass-card rounded-2xl p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Personal Information</h2>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" value="{{ auth()->user()->name }}" 
                                       class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" value="{{ auth()->user()->email }}" 
                                       class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="tel" value="{{ auth()->user()->phone }}" 
                                       class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Birthday</label>
                                <input type="date" value="{{ auth()->user()->birthday }}" 
                                       class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea rows="3" 
                                      class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">{{ auth()->user()->address }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" 
                                    class="px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl hover:from-pink-600 hover:to-purple-700 transition-all">
                                Save Changes
                            </button>
                            <button type="button"
                                    class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-all">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Recent Appointments -->
                <div class="glass-card rounded-2xl p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Recent Appointments</h2>
                        <a href="#" class="text-pink-500 hover:text-pink-600">View All</a>
                    </div>
                    <div class="space-y-4">
                        <!-- Appointment Item -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/dqxvvqzi.json"
                                        trigger="hover"
                                        colors="primary:#ec4899"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Hair Styling</h4>
                                    <p class="text-sm text-gray-600">Nov 28, 2024 • with Sarah</p>
                                </div>
                            </div>
                            <button class="text-pink-500 hover:text-pink-600">
                                Book Again
                            </button>
                        </div>

                        <!-- Appointment Item -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/tdrtiskw.json"
                                        trigger="hover"
                                        colors="primary:#9333ea"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Facial Treatment</h4>
                                    <p class="text-sm text-gray-600">Nov 15, 2024 • with Emma</p>
                                </div>
                            </div>
                            <button class="text-pink-500 hover:text-pink-600">
                                Book Again
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Saved Stylists -->
                <div class="glass-card rounded-2xl p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Favorite Stylists</h2>
                        <a href="#" class="text-pink-500 hover:text-pink-600">View All</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Stylist Card -->
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <img src="https://i.pravatar.cc/150?img=1" alt="Sarah Johnson" 
                                 class="w-16 h-16 rounded-full object-cover">
                            <div class="flex-1">
                                <h4 class="font-semibold">Sarah Johnson</h4>
                                <p class="text-sm text-gray-600">Hair Specialist</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex text-yellow-400">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="ml-1 text-sm">4.9</span>
                                    </div>
                                </div>
                            </div>
                            <button class="text-pink-500 hover:text-pink-600">
                                Book Now
                            </button>
                        </div>

                        <!-- Stylist Card -->
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <img src="https://i.pravatar.cc/150?img=2" alt="Emma Davis" 
                                 class="w-16 h-16 rounded-full object-cover">
                            <div class="flex-1">
                                <h4 class="font-semibold">Emma Davis</h4>
                                <p class="text-sm text-gray-600">Facial Expert</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex text-yellow-400">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="ml-1 text-sm">4.8</span>
                                    </div>
                                </div>
                            </div>
                            <button class="text-pink-500 hover:text-pink-600">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
