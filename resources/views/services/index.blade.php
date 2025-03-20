@extends('layouts.app')

@section('title', 'Our Services - GlamGo')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary-600 to-primary-700 py-20">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-5xl font-bold mb-4">Our Services</h1>
                <p class="text-xl opacity-90">Discover our range of professional beauty and wellness services</p>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <x-services-section :services="$services" :categories="$categories" />

    <!-- Why Choose Us -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose GlamGo</h2>
                <p class="text-lg text-gray-600">Experience the difference with our premium services</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Professional Experts -->
                <div class="text-center">
                    <div class="bg-primary-100 rounded-full p-6 w-20 h-20 mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Professional Experts</h3>
                    <p class="text-gray-600">Highly skilled and certified beauty professionals</p>
                </div>

                <!-- Quality Products -->
                <div class="text-center">
                    <div class="bg-primary-100 rounded-full p-6 w-20 h-20 mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Quality Products</h3>
                    <p class="text-gray-600">Premium beauty products for the best results</p>
                </div>

                <!-- Hygienic Environment -->
                <div class="text-center">
                    <div class="bg-primary-100 rounded-full p-6 w-20 h-20 mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Hygienic Environment</h3>
                    <p class="text-gray-600">Clean and sanitized spaces for your safety</p>
                </div>

                <!-- Affordable Prices -->
                <div class="text-center">
                    <div class="bg-primary-100 rounded-full p-6 w-20 h-20 mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Affordable Prices</h3>
                    <p class="text-gray-600">Competitive rates for premium services</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-primary-600 py-16">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h2 class="text-4xl font-bold mb-4">Ready to Experience Our Services?</h2>
                <p class="text-xl mb-8 opacity-90">Book your appointment today and treat yourself to excellence</p>
                <a href="{{ route('services.index') }}" 
                   class="inline-block bg-white text-primary-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                    Book Now
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('servicesPage', () => ({
            // Add any additional Alpine.js functionality here
        }));
    });
</script>
@endpush 