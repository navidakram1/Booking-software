@extends('layouts.main')

@section('title', 'My Favorites - GlamGo')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
        <!-- Favorites Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">My Favorites</h1>
            <p class="text-gray-600 mt-1">Your favorite services and stylists</p>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-8">
            <div class="flex space-x-8">
                <button class="border-b-2 border-purple-500 pb-4 text-purple-600 font-medium">
                    Services
                </button>
                <button class="text-gray-500 pb-4 font-medium hover:text-gray-700">
                    Stylists
                </button>
            </div>
        </div>

        <!-- Favorite Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Service Card 1 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1560869713-da86a9ec0744?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80" alt="Haircut & Styling" class="w-full h-full object-cover">
                    <button class="absolute top-4 right-4 p-2 bg-white rounded-full shadow-md">
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800">Haircut & Styling</h3>
                    <p class="text-gray-600 mt-2">Professional haircut and styling services for all hair types.</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-purple-600 font-semibold">$50</span>
                        <a href="{{ route('booking') }}" class="text-sm font-medium text-purple-600 hover:text-purple-700">
                            Book Now →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Service Card 2 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80" alt="Manicure & Pedicure" class="w-full h-full object-cover">
                    <button class="absolute top-4 right-4 p-2 bg-white rounded-full shadow-md">
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800">Manicure & Pedicure</h3>
                    <p class="text-gray-600 mt-2">Luxurious nail care treatment for hands and feet.</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-purple-600 font-semibold">$75</span>
                        <a href="{{ route('booking') }}" class="text-sm font-medium text-purple-600 hover:text-purple-700">
                            Book Now →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Service Card 3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1512290923902-8a9f81dc236c?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80" alt="Facial Treatment" class="w-full h-full object-cover">
                    <button class="absolute top-4 right-4 p-2 bg-white rounded-full shadow-md">
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800">Facial Treatment</h3>
                    <p class="text-gray-600 mt-2">Rejuvenating facial treatment for glowing skin.</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-purple-600 font-semibold">$90</span>
                        <a href="{{ route('booking') }}" class="text-sm font-medium text-purple-600 hover:text-purple-700">
                            Book Now →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
