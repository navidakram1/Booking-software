@extends('layouts.main')

@section('title', 'Our Services - GlamGo')

@section('content')
    <!-- Rest of your services content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Hero Section -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent mb-4">Our Services</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Discover our wide range of beauty and wellness services designed to make you look and feel your best.</p>
        </div>

        <!-- Filters Section -->
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up" data-aos-delay="100">
            <form id="filter-form" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="relative transition-all duration-300">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Search services..." 
                               class="filter-input w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                    </div>

                    <!-- Category Filter -->
                    <div class="relative transition-all duration-300">
                        <select name="category" class="filter-input w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Filter -->
                    <div class="relative transition-all duration-300">
                        <select name="price" class="filter-input w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                            <option value="">All Prices</option>
                            <option value="low" {{ request('price') == 'low' ? 'selected' : '' }}>Under $50</option>
                            <option value="medium" {{ request('price') == 'medium' ? 'selected' : '' }}>$50 - $100</option>
                            <option value="high" {{ request('price') == 'high' ? 'selected' : '' }}>Over $100</option>
                        </select>
                    </div>

                    <!-- Duration Filter -->
                    <div class="relative transition-all duration-300">
                        <select name="duration" class="filter-input w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                            <option value="">All Durations</option>
                            <option value="short" {{ request('duration') == 'short' ? 'selected' : '' }}>Under 30 mins</option>
                            <option value="medium" {{ request('duration') == 'medium' ? 'selected' : '' }}>30-60 mins</option>
                            <option value="long" {{ request('duration') == 'long' ? 'selected' : '' }}>Over 60 mins</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Services Grid -->
        <div id="services-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @include('components.services-grid')
        </div>
    </div>
@endsection
