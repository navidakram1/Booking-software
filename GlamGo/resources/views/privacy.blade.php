@extends('layouts.main')

@section('title', 'Privacy Policy - GlamGo')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    Privacy Policy
                </span>
            </h1>
            <p class="text-lg text-gray-600">Last updated: {{ now()->format('F d, Y') }}</p>
        </div>

        <!-- Content -->
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Introduction</h2>
                <p class="text-gray-600 mb-8">
                    At GlamGo, we take your privacy seriously. This Privacy Policy explains how we collect, use, disclose, 
                    and safeguard your information when you use our website and services. Please read this privacy policy 
                    carefully. By using our services, you consent to the data practices described in this statement.
                </p>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">Information We Collect</h2>
                <div class="space-y-4 mb-8">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-pink-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-800">Personal Information</h3>
                            <p class="text-gray-600">Name, email address, phone number, and other contact details you provide when creating an account or booking services.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-pink-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-800">Booking Information</h3>
                            <p class="text-gray-600">Service preferences, appointment history, and payment information.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-pink-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-800">Usage Data</h3>
                            <p class="text-gray-600">Information about how you use our website, including your browsing patterns and device information.</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">How We Use Your Information</h2>
                <div class="space-y-4 mb-8">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-purple-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-800">Service Delivery</h3>
                            <p class="text-gray-600">To process your bookings, provide our services, and communicate with you about appointments.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-purple-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-800">Personalization</h3>
                            <p class="text-gray-600">To customize your experience and provide personalized service recommendations.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-purple-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-800">Communication</h3>
                            <p class="text-gray-600">To send you important updates, newsletters, and promotional content (with your consent).</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Protection</h2>
                <p class="text-gray-600 mb-8">
                    We implement appropriate technical and organizational measures to maintain the security of your personal information, 
                    including encryption, access controls, and regular security assessments.
                </p>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">Your Rights</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-pink-50/50 rounded-xl p-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Access and Control</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li>• Access your personal data</li>
                            <li>• Correct inaccurate data</li>
                            <li>• Request data deletion</li>
                            <li>• Export your data</li>
                        </ul>
                    </div>
                    <div class="bg-purple-50/50 rounded-xl p-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Communication Preferences</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li>• Opt-out of marketing</li>
                            <li>• Manage notifications</li>
                            <li>• Update preferences</li>
                            <li>• Unsubscribe anytime</li>
                        </ul>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-gray-800 mb-6">Contact Us</h2>
                <p class="text-gray-600 mb-4">
                    If you have any questions about this Privacy Policy, please contact us:
                </p>
                <div class="bg-gray-50 rounded-xl p-6 space-y-3">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-pink-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-gray-600">privacy@glamgo.com</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-pink-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-gray-600">1-800-GLAMGO</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-pink-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-gray-600">123 Beauty Street, Style City, ST 12345</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <p class="text-gray-600 mb-4">Have questions about your privacy?</p>
            <a href="{{ route('contact') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 transition-all duration-300">
                Contact Our Privacy Team
            </a>
        </div>
    </div>
</div>
@endsection
