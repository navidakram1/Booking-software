@extends('layouts.app')

@section('title', 'Terms of Service - GlamGo')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="glass-card rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Terms of Service</h1>
        
        <div class="prose prose-pink max-w-none">
            <p class="text-gray-600 mb-6">Last updated: {{ date('F d, Y') }}</p>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">1. Acceptance of Terms</h2>
            <p class="text-gray-600 mb-6">By accessing and using GlamGo's services, you agree to be bound by these Terms of Service and all applicable laws and regulations.</p>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">2. Service Description</h2>
            <p class="text-gray-600 mb-6">GlamGo provides an online platform for booking beauty and wellness services. We reserve the right to modify, suspend, or discontinue any aspect of our services at any time.</p>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">3. Booking and Cancellation</h2>
            <ul class="list-disc pl-6 text-gray-600 mb-6">
                <li>Appointments must be booked at least 24 hours in advance</li>
                <li>Cancellations must be made at least 24 hours before the appointment</li>
                <li>Late cancellations may incur a fee</li>
                <li>No-shows will be charged the full service amount</li>
            </ul>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">4. Payment Terms</h2>
            <ul class="list-disc pl-6 text-gray-600 mb-6">
                <li>Payment is required at the time of booking</li>
                <li>We accept major credit cards and digital payments</li>
                <li>Prices are subject to change without notice</li>
                <li>Refunds are processed according to our refund policy</li>
            </ul>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">5. User Responsibilities</h2>
            <p class="text-gray-600 mb-6">You agree to:</p>
            <ul class="list-disc pl-6 text-gray-600 mb-6">
                <li>Provide accurate and complete information</li>
                <li>Maintain the security of your account</li>
                <li>Comply with all applicable laws and regulations</li>
                <li>Not interfere with the proper operation of our services</li>
            </ul>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">6. Limitation of Liability</h2>
            <p class="text-gray-600 mb-6">GlamGo is not liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of our services.</p>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">7. Changes to Terms</h2>
            <p class="text-gray-600 mb-6">We reserve the right to modify these terms at any time. Continued use of our services after such modifications constitutes acceptance of the updated terms.</p>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">8. Contact Information</h2>
            <p class="text-gray-600 mb-6">For questions about these Terms of Service, please contact us at legal@glamgo.com.</p>
        </div>
    </div>
</div>
@endsection
