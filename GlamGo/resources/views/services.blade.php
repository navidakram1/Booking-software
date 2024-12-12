@extends('layouts.app')

@section('title', 'Our Services - GlamGo')

@section('content')
    <!-- Services Hero Section -->
    <section class="relative py-20 bg-gradient-to-br from-pink-500 to-purple-600">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-500/90 to-purple-600/90"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Our Services</h1>
            <p class="text-lg sm:text-xl text-gray-100 max-w-2xl mx-auto">
                Discover our range of professional beauty services designed to enhance your natural beauty
            </p>
        </div>
    </section>

    <!-- Services Grid Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Haircut & Styling -->
                <div class="glass-card rounded-2xl p-8 text-center group hover:scale-105 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto mb-6 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/wmlleaaf.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Haircut & Styling</h3>
                    <p class="text-gray-600 mb-6">Expert cuts and styles tailored to your face shape and personality</p>
                    <div class="space-y-2 text-left mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Women's Haircut</span>
                            <span class="font-semibold">$60+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Men's Haircut</span>
                            <span class="font-semibold">$40+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Blowout</span>
                            <span class="font-semibold">$45+</span>
                        </div>
                    </div>
                    <a href="{{ route('booking') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700">
                        Book Now
                    </a>
                </div>

                <!-- Hair Color -->
                <div class="glass-card rounded-2xl p-8 text-center group hover:scale-105 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto mb-6 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/ktsahwvc.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Hair Color</h3>
                    <p class="text-gray-600 mb-6">Professional color services from subtle changes to bold transformations</p>
                    <div class="space-y-2 text-left mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Full Color</span>
                            <span class="font-semibold">$90+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Highlights</span>
                            <span class="font-semibold">$120+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Balayage</span>
                            <span class="font-semibold">$150+</span>
                        </div>
                    </div>
                    <a href="{{ route('booking') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700">
                        Book Now
                    </a>
                </div>

                <!-- Treatments -->
                <div class="glass-card rounded-2xl p-8 text-center group hover:scale-105 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto mb-6 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Hair Treatments</h3>
                    <p class="text-gray-600 mb-6">Revitalize your hair with our premium treatment services</p>
                    <div class="space-y-2 text-left mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Deep Conditioning</span>
                            <span class="font-semibold">$40+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Keratin Treatment</span>
                            <span class="font-semibold">$200+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Scalp Treatment</span>
                            <span class="font-semibold">$50+</span>
                        </div>
                    </div>
                    <a href="{{ route('booking') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700">
                        Book Now
                    </a>
                </div>

                <!-- Makeup -->
                <div class="glass-card rounded-2xl p-8 text-center group hover:scale-105 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto mb-6 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/diihvcfp.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Makeup Services</h3>
                    <p class="text-gray-600 mb-6">Professional makeup application for any occasion</p>
                    <div class="space-y-2 text-left mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Natural Look</span>
                            <span class="font-semibold">$60+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Special Event</span>
                            <span class="font-semibold">$85+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Bridal</span>
                            <span class="font-semibold">$150+</span>
                        </div>
                    </div>
                    <a href="{{ route('booking') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700">
                        Book Now
                    </a>
                </div>

                <!-- Nails -->
                <div class="glass-card rounded-2xl p-8 text-center group hover:scale-105 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto mb-6 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/wmwqvixz.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Nail Services</h3>
                    <p class="text-gray-600 mb-6">Complete nail care and artistic designs</p>
                    <div class="space-y-2 text-left mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Manicure</span>
                            <span class="font-semibold">$35+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Pedicure</span>
                            <span class="font-semibold">$45+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Gel Polish</span>
                            <span class="font-semibold">$50+</span>
                        </div>
                    </div>
                    <a href="{{ route('booking') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700">
                        Book Now
                    </a>
                </div>

                <!-- Facial -->
                <div class="glass-card rounded-2xl p-8 text-center group hover:scale-105 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto mb-6 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/tftaqjwp.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Facial Treatments</h3>
                    <p class="text-gray-600 mb-6">Rejuvenating facial treatments for glowing skin</p>
                    <div class="space-y-2 text-left mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Classic Facial</span>
                            <span class="font-semibold">$75+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Deep Cleansing</span>
                            <span class="font-semibold">$90+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Anti-Aging</span>
                            <span class="font-semibold">$120+</span>
                        </div>
                    </div>
                    <a href="{{ route('booking') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Info Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Quality Products -->
                <div class="glass-card rounded-2xl p-8">
                    <div class="w-16 h-16 mb-6 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/osuxyevn.json" trigger="hover" colors="primary:#ec4899" style="width:32px;height:32px"></lord-icon>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Premium Products</h3>
                    <p class="text-gray-600">We use only high-quality, professional-grade products to ensure the best results for our clients.</p>
                </div>

                <!-- Expert Staff -->
                <div class="glass-card rounded-2xl p-8">
                    <div class="w-16 h-16 mb-6 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/ktsahwvc.json" trigger="hover" colors="primary:#ec4899" style="width:32px;height:32px"></lord-icon>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Expert Stylists</h3>
                    <p class="text-gray-600">Our team of professionals is highly trained and experienced in the latest beauty trends and techniques.</p>
                </div>

                <!-- Satisfaction Guarantee -->
                <div class="glass-card rounded-2xl p-8">
                    <div class="w-16 h-16 mb-6 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/jnzhohhs.json" trigger="hover" colors="primary:#ec4899" style="width:32px;height:32px"></lord-icon>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Satisfaction Guaranteed</h3>
                    <p class="text-gray-600">Your satisfaction is our priority. We work with you to achieve your desired look and ensure you love the results.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-2xl p-12 text-center">
                <h2 class="text-3xl font-bold mb-4">Ready to Experience Our Services?</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Book an appointment today and let our expert team take care of you.</p>
                <a href="{{ route('booking') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                    Book Your Appointment
                </a>
            </div>
        </div>
    </section>
@endsection