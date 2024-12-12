@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-br from-pink-500 to-purple-600">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-500/90 to-purple-600/90"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Beauty & Style Blog</h1>
            <p class="text-lg sm:text-xl text-gray-100 max-w-2xl mx-auto">
                Discover the latest trends, tips, and insights from our beauty experts.
            </p>
        </div>
    </section>

    <!-- Search and Categories Section -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-4">
                <!-- Search Bar -->
                <div class="w-full md:w-96">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Search articles..." 
                               class="w-full px-4 py-2 pl-10 pr-4 rounded-xl border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        <lord-icon
                            src="https://cdn.lordicon.com/msoeawqm.json"
                            trigger="hover"
                            colors="primary:#ec4899"
                            class="absolute left-3 top-2.5"
                            style="width:20px;height:20px">
                        </lord-icon>
                    </div>
                </div>
                <!-- Categories -->
                <div class="flex flex-wrap justify-center gap-2">
                    <button class="px-4 py-2 rounded-full bg-pink-500 text-white hover:bg-pink-600 transition-colors">All</button>
                    <button class="px-4 py-2 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">Hair Care</button>
                    <button class="px-4 py-2 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">Skin Care</button>
                    <button class="px-4 py-2 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">Makeup</button>
                    <button class="px-4 py-2 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">Trends</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Posts -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-8">Featured Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Featured Post 1 -->
                <article class="glass-card rounded-2xl overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="https://images.pexels.com/photos/3738339/pexels-photo-3738339.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" 
                         alt="Latest Hair Trends 2024" 
                         class="w-full h-64 object-cover">
                    <div class="p-6">
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-pink-100 text-pink-600">Trends</span>
                            <span class="text-sm text-gray-500">5 min read</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Latest Hair Trends 2024</h3>
                        <p class="text-gray-600 mb-4">Discover the hottest hair trends that will dominate the beauty scene in 2024...</p>
                        <a href="#" class="inline-flex items-center space-x-2 text-pink-600 hover:text-pink-700">
                            <span>Read More</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>

                <!-- Featured Post 2 -->
                <article class="glass-card rounded-2xl overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="https://images.pexels.com/photos/3985329/pexels-photo-3985329.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" 
                         alt="Skincare Secrets" 
                         class="w-full h-64 object-cover">
                    <div class="p-6">
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-600">Skin Care</span>
                            <span class="text-sm text-gray-500">7 min read</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Winter Skincare Secrets</h3>
                        <p class="text-gray-600 mb-4">Essential tips to keep your skin glowing and healthy during the cold winter months...</p>
                        <a href="#" class="inline-flex items-center space-x-2 text-pink-600 hover:text-pink-700">
                            <span>Read More</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Recent Posts Grid -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-8">Recent Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Recent Post 1 -->
                <article class="glass-card rounded-2xl overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" 
                         alt="Makeup Tips" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-pink-100 text-pink-600">Makeup</span>
                        <h3 class="text-lg font-bold mt-3 mb-2">5-Minute Makeup Routine</h3>
                        <p class="text-gray-600 text-sm mb-4">Quick and easy makeup tips for busy mornings...</p>
                        <a href="#" class="text-pink-600 hover:text-pink-700 text-sm font-medium">Read More →</a>
                    </div>
                </article>

                <!-- Recent Post 2 -->
                <article class="glass-card rounded-2xl overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="https://images.pexels.com/photos/3993449/pexels-photo-3993449.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" 
                         alt="Hair Care" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-600">Hair Care</span>
                        <h3 class="text-lg font-bold mt-3 mb-2">Natural Hair Care Tips</h3>
                        <p class="text-gray-600 text-sm mb-4">Discover natural ways to maintain healthy hair...</p>
                        <a href="#" class="text-pink-600 hover:text-pink-700 text-sm font-medium">Read More →</a>
                    </div>
                </article>

                <!-- Recent Post 3 -->
                <article class="glass-card rounded-2xl overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="https://images.pexels.com/photos/3997391/pexels-photo-3997391.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" 
                         alt="Spa Treatments" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600">Wellness</span>
                        <h3 class="text-lg font-bold mt-3 mb-2">Spa Day at Home</h3>
                        <p class="text-gray-600 text-sm mb-4">Create a luxurious spa experience at home...</p>
                        <a href="#" class="text-pink-600 hover:text-pink-700 text-sm font-medium">Read More →</a>
                    </div>
                </article>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl hover:from-pink-600 hover:to-purple-700 transition-all">
                    Load More Posts
                </button>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gradient-to-br from-pink-500 to-purple-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto">Subscribe to our newsletter for the latest beauty tips, trends, and exclusive offers.</p>
            <form class="max-w-md mx-auto flex gap-4">
                <input type="email" 
                       placeholder="Enter your email" 
                       class="flex-1 px-4 py-3 rounded-xl text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-white">
                <button type="submit" 
                        class="px-6 py-3 bg-white text-pink-600 rounded-xl hover:bg-gray-100 transition-colors font-semibold">
                    Subscribe
                </button>
            </form>
        </div>
    </section>
@endsection
