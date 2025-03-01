@extends('layouts.main')

@section('title', 'Gallery - GlamGo')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12" data-aos="fade-down">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                        Our Gallery
                    </span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Explore our stunning collection of beauty transformations and get inspired for your next look
                </p>
            </div>

            <!-- Filters -->
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up">
                <form id="filter-form" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Category Filter -->
                        <div class="relative">
                            <select name="category" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                                <option value="all">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ Str::slug($category) }}" {{ request('category') == Str::slug($category) ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search -->
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Search gallery..." 
                                   class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        </div>

                        <!-- Tags -->
                        <div class="relative">
                            <input type="text" 
                                   name="tag" 
                                   value="{{ request('tag') }}" 
                                   placeholder="Search by tag..." 
                                   class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Gallery Grid -->
            <div id="gallery-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @include('components.gallery-grid')
            </div>
        </div>
    </div>

    <!-- Modal Container (Alpine.js) -->
    <div x-data="{ showModal: false }" 
         x-on:keydown.escape.window="showModal = false"
         id="gallery-modal">
    </div>
@endsection
