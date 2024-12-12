@extends('layouts.app')

@section('title', 'Book Appointment - GlamGo')

@section('content')
    <!-- Booking Hero Section -->
    <section class="relative py-20 bg-gradient-to-br from-pink-500 to-purple-600">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-500/90 to-purple-600/90"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Book Your Appointment</h1>
            <p class="text-lg sm:text-xl text-gray-100 max-w-2xl mx-auto">
                Schedule your next beauty transformation with our expert stylists
            </p>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-2xl p-8 md:p-12">
                <!-- Progress Steps -->
                <div class="flex items-center justify-between mb-12 relative">
                    <div class="absolute left-0 top-1/2 w-full h-1 bg-gray-200 -translate-y-1/2"></div>
                    <div class="relative z-10 flex justify-between w-full">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-pink-500 text-white flex items-center justify-center font-semibold">1</div>
                            <span class="text-sm font-medium mt-2">Services</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-semibold">2</div>
                            <span class="text-sm font-medium mt-2">Date & Time</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-semibold">3</div>
                            <span class="text-sm font-medium mt-2">Details</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-semibold">4</div>
                            <span class="text-sm font-medium mt-2">Confirm</span>
                        </div>
                    </div>
                </div>

                <!-- Service Selection -->
                <div class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Service Card 1 -->
                        <div class="glass-card rounded-xl p-6 cursor-pointer hover:shadow-lg transition-all border-2 border-transparent hover:border-pink-500">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center flex-shrink-0">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/dqxvvqzi.json"
                                        trigger="hover"
                                        colors="primary:#ec4899"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold mb-1">Haircut & Styling</h3>
                                    <p class="text-gray-600 text-sm mb-2">Professional cut and style by our experts</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-pink-600 font-semibold">$50</span>
                                        <span class="text-sm text-gray-500">45 mins</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Card 2 -->
                        <div class="glass-card rounded-xl p-6 cursor-pointer hover:shadow-lg transition-all border-2 border-transparent hover:border-pink-500">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/hvuelaml.json"
                                        trigger="hover"
                                        colors="primary:#9333ea"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold mb-1">Hair Coloring</h3>
                                    <p class="text-gray-600 text-sm mb-2">Full color or highlights with premium products</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-pink-600 font-semibold">$120</span>
                                        <span class="text-sm text-gray-500">2 hours</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Card 3 -->
                        <div class="glass-card rounded-xl p-6 cursor-pointer hover:shadow-lg transition-all border-2 border-transparent hover:border-pink-500">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center flex-shrink-0">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/tdrtiskw.json"
                                        trigger="hover"
                                        colors="primary:#ec4899"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold mb-1">Facial Treatment</h3>
                                    <p class="text-gray-600 text-sm mb-2">Rejuvenating facial with premium products</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-pink-600 font-semibold">$80</span>
                                        <span class="text-sm text-gray-500">1 hour</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Card 4 -->
                        <div class="glass-card rounded-xl p-6 cursor-pointer hover:shadow-lg transition-all border-2 border-transparent hover:border-pink-500">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/rjzlnunf.json"
                                        trigger="hover"
                                        colors="primary:#9333ea"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold mb-1">Makeup Service</h3>
                                    <p class="text-gray-600 text-sm mb-2">Professional makeup for any occasion</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-pink-600 font-semibold">$75</span>
                                        <span class="text-sm text-gray-500">1 hour</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Selected Services Summary -->
                    <div class="border-t border-gray-200 pt-6 mt-8">
                        <h3 class="text-lg font-semibold mb-4">Selected Services</h3>
                        <div class="space-y-2">
                            <!-- Selected Service Item -->
                            <div class="flex items-center justify-between py-2 px-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <span class="text-pink-600">•</span>
                                    <span class="font-medium">Haircut & Styling</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-gray-500">45 mins</span>
                                    <span class="font-semibold">$50</span>
                                    <button class="text-gray-400 hover:text-red-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-8">
                        <button class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-all">
                            Back
                        </button>
                        <button class="px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl hover:from-pink-600 hover:to-purple-700 transition-all">
                            Continue to Date & Time
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Add your booking form interaction logic here
    document.addEventListener('DOMContentLoaded', function() {
        // Service selection logic
        const serviceCards = document.querySelectorAll('.glass-card');
        serviceCards.forEach(card => {
            card.addEventListener('click', function() {
                this.classList.toggle('border-pink-500');
                // Add your service selection logic here
            });
        });
    });
</script>
@endpush
