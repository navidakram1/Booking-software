@extends('layouts.main')

@section('title', 'GlamGo - Modern Salon Booking')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection

@section('content')
        <!-- Hero Section -->
        <section class="relative h-screen overflow-hidden">
            <!-- SVG Pattern Background - No overlay -->
            <img src="{{ asset('images/hero-bg-pattern.svg') }}" 
                 class="absolute inset-0 w-full h-full object-cover">

            <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 h-screen flex items-center">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 h-full items-center pt-16">
                    <!-- Left Content -->
                    <div class="max-w-2xl space-y-8">
                        <div class="space-y-6">
                            <h2 class="text-gray-600 font-medium text-xl tracking-wider">WELCOME TO GLAMGO</h2>
                            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800">
                                Book Your Perfect Style Today
                            </h1>
                            <p class="text-gray-600 text-lg sm:text-xl">
                                Experience luxury hair care with our expert stylists
                            </p>
                        </div>

                        <!-- Combined Booking and Availability Section -->
                        <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.12)] space-y-8 border border-white/20">
                            <div class="space-y-2">
                                <h3 class="text-2xl font-semibold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">Book Your Service</h3>
                                <p class="text-gray-500 text-sm">Choose your preferred service and time</p>
                            </div>
                            
                            <!-- Service Selection -->
                            <div class="space-y-6">
                                <div class="relative">
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        <span>Select Service</span>
                                    </label>
                                    <select class="form-select w-full rounded-xl border-gray-200 bg-gray-50/50 focus:border-purple-500 focus:ring-purple-500 transition-all duration-200 hover:bg-white">
                                        <option>Haircut & Styling</option>
                                        <option>Hair Coloring</option>
                                        <option>Spa Treatment</option>
                                        <option>Manicure & Pedicure</option>
                                        <option>Facial & Skincare</option>
                                        <option>Makeup Services</option>
                                    </select>
                                </div>

                                <!-- Date and Time Selection -->
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>Date</span>
                                        </label>
                                        <input type="date" class="form-input w-full rounded-xl border-gray-200 bg-gray-50/50 focus:border-purple-500 focus:ring-purple-500 transition-all duration-200 hover:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Time</span>
                                        </label>
                                        <select class="form-select w-full rounded-xl border-gray-200 bg-gray-50/50 focus:border-purple-500 focus:ring-purple-500 transition-all duration-200 hover:bg-white">
                                            <option>9:00 AM</option>
                                            <option>10:00 AM</option>
                                            <option>11:00 AM</option>
                                            <option>12:00 PM</option>
                                            <option>1:00 PM</option>
                                            <option>2:00 PM</option>
                                            <option>3:00 PM</option>
                                            <option>4:00 PM</option>
                                            <option>5:00 PM</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Stylist Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>Choose Stylist</span>
                                    </label>
                                    <select class="form-select w-full rounded-xl border-gray-200 bg-gray-50/50 focus:border-purple-500 focus:ring-purple-500 transition-all duration-200 hover:bg-white">
                                        <option>Any Available Stylist</option>
                                        <option>Sarah Johnson</option>
                                        <option>Michael Chen</option>
                                        <option>Emma Davis</option>
                                        <option>James Wilson</option>
                                    </select>
                                </div>

                                <!-- Real-time Availability Indicator -->
                                <div class="bg-green-50 rounded-xl p-4 flex items-center space-x-3 border border-green-100">
                                    <div class="flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-green-800">Available for selected time slot!</p>
                                        <p class="text-xs text-green-600">Book now to secure your appointment</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Book Now Button -->
                            <a href="{{ url('/booking') }}" class="w-full py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-[1.02] shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                                <span>Book Appointment</span>
                                <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="hover" colors="primary:#ffffff,secondary:#ffffff" style="width:24px;height:24px"></lord-icon>
                            </a>
                        </div>
                    </div>

                    <!-- Hero Image - Right Column -->
                    <div class="relative h-[calc(100vh-4rem)] flex items-center justify-center lg:justify-end">
                        <img src="{{ asset('images/Hero.png') }}" 
                             alt="Glamorous salon professional" 
                             class="object-cover h-[90%] w-auto max-w-none lg:scale-125 lg:translate-x-20">
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        @include('components.services-section')

        <!-- Live Queue Section -->
        @include('components.live-queue-section')

        <!-- Promotional Offers Section -->
        @include('components.promotional-offers-section')

        <!-- Testimonials Section -->
        @include('components.testimonials-section')

        <!-- Contact Section -->
        @include('components.contact-section')

          <!-- Specialists Section -->
        @include('components.specialists-section')

        <!-- FAQ Section -->
        @include('components.faq-section')

        <!-- Gallery Section -->
@include('components.gallery-section')

<!-- Blog Section -->
@include('components.blog-section')
@endsection
        
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                setTimeout(() => {
                    mobileMenu.classList.toggle('opacity-0');
                    mobileMenu.classList.toggle('-translate-y-2');
                }, 20);
            });
        });
    </script>
@endsection
