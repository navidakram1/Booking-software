@extends('layouts.app')

@section('title', 'About Us - GlamGo')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-br from-pink-500 to-purple-600">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-500/90 to-purple-600/90"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">About GlamGo</h1>
            <p class="text-lg sm:text-xl text-gray-100 max-w-2xl mx-auto">
                Your premier destination for beauty and wellness, where expertise meets luxury.
            </p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold mb-6">Our Story</h2>
                    <div class="space-y-4 text-gray-600">
                        <p>Founded in 2020, GlamGo was born from a passion for beauty and a vision to create an exceptional salon experience. Our journey began with a simple idea: to combine professional expertise with a luxurious, welcoming atmosphere.</p>
                        <p>Today, we're proud to be one of the most sought-after beauty destinations, known for our innovative treatments and dedication to client satisfaction. Our team of skilled professionals stays at the forefront of beauty trends and techniques, ensuring you receive the very best service.</p>
                        <p>At GlamGo, we believe that everyone deserves to feel beautiful and confident. This belief drives everything we do, from our personalized consultations to our premium services.</p>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden shadow-xl">
                        <img src="{{ asset('images/salon-interior.jpg') }}" alt="GlamGo Salon Interior" class="object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Our Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Excellence -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Excellence</h3>
                    <p class="text-gray-600 text-center">We strive for excellence in every service we provide, ensuring the highest standards of quality and professionalism.</p>
                </div>

                <!-- Innovation -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Innovation</h3>
                    <p class="text-gray-600 text-center">We embrace the latest beauty trends and technologies, constantly evolving to offer you the best services.</p>
                </div>

                <!-- Client Focus -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Client Focus</h3>
                    <p class="text-gray-600 text-center">Your satisfaction is our priority. We're committed to providing personalized care and attention to every client.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    @include('components.specialists-section')

    <!-- Testimonials -->
    @include('components.testimonials-section')

    <!-- CTA Section -->
    <section class="relative py-20 bg-gradient-to-br from-pink-500 to-purple-600">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-500/90 to-purple-600/90"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h2 class="text-3xl sm:text-4xl font-bold mb-6">Ready to Experience the GlamGo Difference?</h2>
            <p class="text-lg sm:text-xl mb-8 max-w-2xl mx-auto">
                Join our community of satisfied clients and let us help you look and feel your best.
            </p>
            <a href="{{ route('booking') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-purple-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition-all duration-300 shadow-lg hover:shadow-xl">
                Book Your Appointment
            </a>
        </div>
    </section>
@endsection