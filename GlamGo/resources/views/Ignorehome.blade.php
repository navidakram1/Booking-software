@extends('layouts.app')

@section('title', 'GlamGo - Modern Beauty Salon')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center text-center text-white">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-bg.jpg') }}" alt="Salon Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-500/80 to-purple-600/80 mix-blend-multiply"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6">
                Experience the Art of Beauty
            </h1>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 text-gray-100">
                Transform your look with our expert stylists and premium beauty services
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('booking') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-pink-600 hover:bg-pink-700 md:py-4 md:text-lg md:px-10 transition-all duration-300 shadow-lg hover:shadow-xl">
                    Book Now
                </a>
                <a href="{{ route('services') }}" class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-base font-medium rounded-full text-white hover:bg-white hover:text-pink-600 md:py-4 md:text-lg md:px-10 transition-all duration-300">
                    Our Services
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    @include('components.services-section')

    <!-- Specialists Section -->
    @include('components.specialists-section')

    <!-- Testimonials Section -->
    @include('components.testimonials-section')

    <!-- Promotional Offers -->
    @include('components.promotional-offers-section')

    <!-- Blog Section -->
    @include('components.blog-section')

    <!-- Contact Section -->
    @include('components.contact-section')
@endsection