@extends('layouts.app')

@section('title', 'Privacy Policy - GlamGo')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="glass-card rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Privacy Policy</h1>
        
        <div class="prose prose-pink max-w-none">
            <p class="text-gray-600 mb-6">Last updated: {{ date('F d, Y') }}</p>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">1. Information We Collect</h2>
            <p class="text-gray-600 mb-4">At GlamGo, we collect information that you provide directly to us, including:</p>
            <ul class="list-disc pl-6 text-gray-600 mb-6">
                <li>Name and contact information</li>
                <li>Appointment details and preferences</li>
                <li>Payment information</li>
                <li>Communication history</li>
            </ul>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">2. How We Use Your Information</h2>
            <p class="text-gray-600 mb-4">We use the information we collect to:</p>
            <ul class="list-disc pl-6 text-gray-600 mb-6">
                <li>Process your bookings and payments</li>
                <li>Send appointment reminders</li>
                <li>Improve our services</li>
                <li>Communicate with you about promotions and updates</li>
            </ul>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">3. Information Sharing</h2>
            <p class="text-gray-600 mb-6">We do not sell or share your personal information with third parties except as necessary to provide our services or as required by law.</p>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">4. Security</h2>
            <p class="text-gray-600 mb-6">We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">5. Your Rights</h2>
            <p class="text-gray-600 mb-4">You have the right to:</p>
            <ul class="list-disc pl-6 text-gray-600 mb-6">
                <li>Access your personal information</li>
                <li>Correct inaccurate information</li>
                <li>Request deletion of your information</li>
                <li>Opt-out of marketing communications</li>
            </ul>

            <h2 class="text-xl font-semibold text-gray-900 mt-8 mb-4">6. Contact Us</h2>
            <p class="text-gray-600 mb-6">If you have any questions about this Privacy Policy, please contact us at privacy@glamgo.com.</p>
        </div>
    </div>
</div>
@endsection
