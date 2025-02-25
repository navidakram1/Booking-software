@extends('layouts.main')

@section('title', 'Staff Profile - GlamGo')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Profile Header -->
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <!-- Profile Image -->
                <div class="relative group">
                    <div class="w-48 h-48 rounded-full overflow-hidden ring-4 ring-pink-500 ring-offset-4">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400" 
                             alt="Profile" 
                             class="w-full h-full object-cover">
                    </div>
                    <button class="absolute bottom-0 right-0 bg-purple-600 text-white p-2 rounded-full shadow-lg hover:bg-purple-700 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                </div>

                <!-- Profile Info -->
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $staff['name'] }}</h1>
                            <p class="text-lg text-purple-600 font-medium">{{ $staff['role'] }}</p>
                        </div>
                        <button class="mt-4 md:mt-0 px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 transition-all duration-300">
                            Edit Profile
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-pink-50 rounded-xl p-4">
                            <div class="text-2xl font-bold text-pink-600">{{ $staff['stats']['appointments'] }}</div>
                            <div class="text-sm text-gray-600">Appointments</div>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-4">
                            <div class="text-2xl font-bold text-purple-600">{{ $staff['stats']['rating'] }}</div>
                            <div class="text-sm text-gray-600">Rating</div>
                        </div>
                        <div class="bg-pink-50 rounded-xl p-4">
                            <div class="text-2xl font-bold text-pink-600">{{ $staff['stats']['years'] }}</div>
                            <div class="text-sm text-gray-600">Years Exp.</div>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-4">
                            <div class="text-2xl font-bold text-purple-600">{{ $staff['stats']['reviews'] }}</div>
                            <div class="text-sm text-gray-600">Reviews</div>
                        </div>
                    </div>

                    <!-- Bio -->
                    <p class="text-gray-600 mb-6">
                        {{ $staff['bio'] }}
                    </p>

                    <!-- Specialties -->
                    <div class="flex flex-wrap gap-2">
                        @foreach($staff['specialties'] as $specialty)
                            <span class="px-4 py-2 {{ $loop->even ? 'bg-purple-100 text-purple-600' : 'bg-pink-100 text-pink-600' }} rounded-full text-sm font-medium">{{ $specialty }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div x-data="{ activeTab: 'schedule' }" class="mb-8">
            <div class="flex space-x-4 mb-6">
                <button @click="activeTab = 'schedule'" 
                        :class="{'bg-gradient-to-r from-pink-500 to-purple-600 text-white': activeTab === 'schedule', 'bg-white/80 text-gray-600 hover:bg-white': activeTab !== 'schedule'}"
                        class="px-6 py-3 rounded-xl font-medium transition-all duration-300">
                    Schedule
                </button>
                <button @click="activeTab = 'reviews'" 
                        :class="{'bg-gradient-to-r from-pink-500 to-purple-600 text-white': activeTab === 'reviews', 'bg-white/80 text-gray-600 hover:bg-white': activeTab !== 'reviews'}"
                        class="px-6 py-3 rounded-xl font-medium transition-all duration-300">
                    Reviews
                </button>
                <button @click="activeTab = 'portfolio'" 
                        :class="{'bg-gradient-to-r from-pink-500 to-purple-600 text-white': activeTab === 'portfolio', 'bg-white/80 text-gray-600 hover:bg-white': activeTab !== 'portfolio'}"
                        class="px-6 py-3 rounded-xl font-medium transition-all duration-300">
                    Portfolio
                </button>
            </div>

            <!-- Schedule Tab -->
            <div x-show="activeTab === 'schedule'" class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Calendar -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Upcoming Appointments</h3>
                        <div class="space-y-4">
                            @foreach($staff['appointments'] as $appointment)
                                <div class="flex items-center p-4 bg-pink-50 rounded-xl">
                                    <div class="mr-4">
                                        <div class="text-lg font-bold text-pink-600">{{ $appointment['date'] }}</div>
                                        <div class="text-sm text-gray-600">{{ $appointment['time'] }}</div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-800">{{ $appointment['service'] }}</div>
                                        <div class="text-sm text-gray-600">{{ $appointment['client'] }}</div>
                                    </div>
                                    <button class="text-purple-600 hover:text-purple-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Working Hours</h3>
                        <div class="space-y-3">
                            @foreach($staff['workingHours'] as $day => $hours)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">{{ $day }}</span>
                                    <span class="text-gray-800 font-medium">{{ $hours }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Tab -->
            <div x-show="activeTab === 'reviews'" class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8">
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=48&h=48" 
                                 alt="Client" 
                                 class="w-12 h-12 rounded-full mr-4">
                            <div class="flex-1">
                                <div class="flex items-center mb-1">
                                    <h4 class="font-medium text-gray-800 mr-2">Jessica Smith</h4>
                                    <div class="flex text-yellow-400">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-600">Amazing experience! Sarah is incredibly talented and really listens to what you want.</p>
                                <div class="mt-2 text-sm text-gray-500">2 days ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Portfolio Tab -->
            <div x-show="activeTab === 'portfolio'" class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="relative group rounded-xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400" 
                             alt="Portfolio" 
                             class="w-full h-64 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <div class="absolute bottom-4 left-4 text-white">
                                <h4 class="font-medium">Balayage Transformation</h4>
                                <p class="text-sm">Color & Style</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
