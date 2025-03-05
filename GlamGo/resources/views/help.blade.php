@extends('layouts.main')

@section('title', 'Help Center - GlamGo')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    How Can We Help You?
                </span>
            </h1>
            <p class="text-lg text-gray-600">Find answers to common questions or contact our support team</p>
        </div>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto mb-12">
            <div class="relative">
                <input type="text" 
                       placeholder="Search for help..." 
                       class="w-full px-6 py-4 rounded-xl bg-white/80 backdrop-blur-lg border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300"
                >
                <button class="absolute right-3 top-1/2 transform -translate-y-1/2 px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-lg hover:from-pink-600 hover:to-purple-700 transition-all duration-300">
                    Search
                </button>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <div class="bg-white/80 backdrop-blur-lg rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="text-pink-500 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Booking Help</h3>
                <p class="text-gray-600 mb-4">Learn how to book, modify, or cancel appointments</p>
                <a href="#" class="text-pink-500 hover:text-pink-600 font-medium">Learn more →</a>
            </div>

            <div class="bg-white/80 backdrop-blur-lg rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="text-purple-500 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Payment Issues</h3>
                <p class="text-gray-600 mb-4">Get help with payments, refunds, and gift cards</p>
                <a href="#" class="text-purple-500 hover:text-purple-600 font-medium">Learn more →</a>
            </div>

            <div class="bg-white/80 backdrop-blur-lg rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="text-pink-500 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Services Guide</h3>
                <p class="text-gray-600 mb-4">Explore our services and treatment guides</p>
                <a href="#" class="text-pink-500 hover:text-pink-600 font-medium">Learn more →</a>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Frequently Asked Questions</h2>
            
            <div class="space-y-4">
                <div x-data="{ open: false }" class="border-b border-gray-200 pb-4">
                    <button @click="open = !open" class="flex justify-between items-center w-full">
                        <span class="text-lg font-medium text-gray-800">How do I book an appointment?</span>
                        <svg class="w-5 h-5 text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" class="mt-4 text-gray-600">
                        You can book an appointment through our website by clicking the "Book Now" button, selecting your desired service, choosing a stylist, and picking an available time slot.
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-b border-gray-200 pb-4">
                    <button @click="open = !open" class="flex justify-between items-center w-full">
                        <span class="text-lg font-medium text-gray-800">What's your cancellation policy?</span>
                        <svg class="w-5 h-5 text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" class="mt-4 text-gray-600">
                        We require 24 hours notice for cancellations. Late cancellations or no-shows may be subject to a fee of 50% of the service price.
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-b border-gray-200 pb-4">
                    <button @click="open = !open" class="flex justify-between items-center w-full">
                        <span class="text-lg font-medium text-gray-800">Do you offer gift cards?</span>
                        <svg class="w-5 h-5 text-gray-500" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" class="mt-4 text-gray-600">
                        Yes, we offer digital and physical gift cards. You can purchase them online or at our salon locations.
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gradient-to-br from-pink-500 to-purple-600 rounded-2xl p-8 text-white">
                <h3 class="text-2xl font-bold mb-4">Need More Help?</h3>
                <p class="mb-6">Our support team is here to help you with any questions or concerns.</p>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>support@glamgo.com</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>1-800-GLAMGO</span>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-8 shadow-xl">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Send Us a Message</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"></textarea>
                    </div>
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-lg font-semibold hover:from-pink-600 hover:to-purple-700 transition-all duration-300">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
