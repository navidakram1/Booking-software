@extends('layouts.main')

@section('title', 'Terms & Conditions - GlamGo')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    Terms & Conditions
                </span>
            </h1>
            <p class="text-lg text-gray-600">Last updated: {{ now()->format('F d, Y') }}</p>
        </div>

        <!-- Content -->
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
            <div class="prose max-w-none">
                <!-- Introduction -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Welcome to GlamGo</h2>
                    <p class="text-gray-600">
                        By accessing and using our website and services, you agree to be bound by these Terms and Conditions. 
                        Please read them carefully before proceeding to use our services.
                    </p>
                </div>

                <!-- Service Terms -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Service Terms</h2>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-pink-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-800">Booking and Appointments</h3>
                                <p class="text-gray-600">
                                    Appointments must be booked in advance. A valid credit card is required to secure your booking.
                                    We require at least 24 hours notice for cancellations or rescheduling.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-pink-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-800">Cancellation Policy</h3>
                                <p class="text-gray-600">
                                    Late cancellations (less than 24 hours notice) or no-shows may result in a charge of up to 50% 
                                    of the service price. Repeated no-shows may affect future booking privileges.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-pink-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-800">Payment Terms</h3>
                                <p class="text-gray-600">
                                    Payment is required at the time of service. We accept major credit cards, debit cards, 
                                    and digital payments. Gift cards are non-refundable but transferable.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Responsibilities -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">User Responsibilities</h2>
                    <div class="bg-purple-50/50 rounded-xl p-6 space-y-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-purple-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <p class="text-gray-600">Provide accurate and complete information when booking services</p>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-purple-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <p class="text-gray-600">Arrive at least 5 minutes before your scheduled appointment time</p>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-purple-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <p class="text-gray-600">Inform us of any health conditions or allergies that may affect services</p>
                        </div>
                    </div>
                </div>

                <!-- Liability and Disclaimers -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Liability and Disclaimers</h2>
                    <div class="bg-pink-50/50 rounded-xl p-6">
                        <p class="text-gray-600 mb-4">
                            While we strive to provide the best possible service, GlamGo is not liable for:
                        </p>
                        <ul class="list-disc list-inside space-y-2 text-gray-600">
                            <li>Unsatisfactory results due to client's failure to disclose relevant information</li>
                            <li>Allergic reactions to products used during services</li>
                            <li>Personal items lost or damaged on our premises</li>
                            <li>Service interruptions due to technical issues or maintenance</li>
                        </ul>
                    </div>
                </div>

                <!-- Changes to Terms -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Changes to Terms</h2>
                    <p class="text-gray-600">
                        We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting 
                        to our website. Your continued use of our services constitutes acceptance of these changes.
                    </p>
                </div>

                <!-- Contact Information -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Questions About Our Terms?</h2>
                    <div class="bg-gray-50 rounded-xl p-6 space-y-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-pink-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-600">legal@glamgo.com</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-pink-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-gray-600">1-800-GLAMGO</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agreement Button -->
        <div class="text-center">
            <p class="text-gray-600 mb-4">By using our services, you agree to these terms and conditions</p>
            <a href="{{ route('booking') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 transition-all duration-300">
                Book an Appointment
            </a>
        </div>
    </div>
</div>
@endsection
