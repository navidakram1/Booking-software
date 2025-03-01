@extends('layouts.main')

@section('title', 'About Us - GlamGo')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    Welcome to GlamGo
                </span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Your premier destination for beauty and wellness services. We're dedicated to making you look and feel your absolute best.
            </p>
        </div>

        <!-- Mission & Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 transform hover:-translate-y-1 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h2>
                <p class="text-gray-600">
                    To provide exceptional beauty services that enhance natural beauty and boost confidence. 
                    We strive to create a welcoming environment where every client feels valued and beautiful.
                </p>
            </div>
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 transform hover:-translate-y-1 transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Our Vision</h2>
                <p class="text-gray-600">
                    To become the leading beauty destination known for innovation, excellence, and personalized service. 
                    We aim to set new standards in the beauty industry.
                </p>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    Why Choose GlamGo?
                </span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-pink-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Expert Stylists</h3>
                    <p class="text-gray-600">Highly trained professionals with years of experience</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-purple-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Convenient Booking</h3>
                    <p class="text-gray-600">Easy online scheduling system</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-pink-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Quality Products</h3>
                    <p class="text-gray-600">Premium beauty products and equipment</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-purple-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Satisfaction Guaranteed</h3>
                    <p class="text-gray-600">Your happiness is our priority</p>
                </div>
            </div>
        </div>

        <!-- Our Team -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    Meet Our Team
                </span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition-all duration-300">
                    <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=FF69B4&color=fff" 
                         alt="Sarah Johnson" 
                         class="w-32 h-32 rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Sarah Johnson</h3>
                    <p class="text-pink-500 text-center mb-4">Lead Hair Stylist</p>
                    <p class="text-gray-600 text-center">
                        With over 10 years of experience, Sarah specializes in creating unique styles that complement each client's personality.
                    </p>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition-all duration-300">
                    <img src="https://ui-avatars.com/api/?name=Emma+Davis&background=FF69B4&color=fff" 
                         alt="Emma Davis" 
                         class="w-32 h-32 rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Emma Davis</h3>
                    <p class="text-pink-500 text-center mb-4">Senior Makeup Artist</p>
                    <p class="text-gray-600 text-center">
                        Emma's artistic touch and attention to detail make her one of our most sought-after makeup artists.
                    </p>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition-all duration-300">
                    <img src="https://ui-avatars.com/api/?name=Michael+Smith&background=FF69B4&color=fff" 
                         alt="Michael Smith" 
                         class="w-32 h-32 rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Michael Smith</h3>
                    <p class="text-pink-500 text-center mb-4">Spa Specialist</p>
                    <p class="text-gray-600 text-center">
                        Michael's holistic approach to wellness has helped countless clients achieve total relaxation.
                    </p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Ready to Experience GlamGo?</h2>
            <p class="text-gray-600 mb-8">Book your appointment today and let us help you look and feel your best.</p>
            <a href="{{ route('booking.index') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 transition-all duration-300">
                Book Now
            </a>
        </div>
    </div>
</div>
@endsection