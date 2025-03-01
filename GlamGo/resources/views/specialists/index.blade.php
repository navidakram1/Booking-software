@extends('specialists')

@section('content')
<main class="pt-32 pb-16">
    <!-- Hero Section -->
    <section class="container mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4">Meet Our Specialists</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Our team of experienced professionals is dedicated to providing you with exceptional service and stunning results</p>
        </div>
    </section>

    <!-- Specialists Grid -->
    <section class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Specialist Card 1 -->
            <div class="specialist-card rounded-2xl p-6 text-center">
                <div class="relative w-32 h-32 mx-auto mb-4">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330" 
                         alt="Sarah Johnson" 
                         class="rounded-full w-full h-full object-cover">
                    <div class="absolute bottom-0 right-0 bg-green-500 w-4 h-4 rounded-full border-2 border-white"></div>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Sarah Johnson</h3>
                <p class="text-gray-600 mb-2">Senior Hair Stylist</p>
                <p class="text-sm text-gray-500 mb-4">10+ years experience</p>
                <div class="flex justify-center space-x-2">
                    <span class="px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-sm">Haircuts</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm">Coloring</span>
                </div>
            </div>

            <!-- Specialist Card 2 -->
            <div class="specialist-card rounded-2xl p-6 text-center">
                <div class="relative w-32 h-32 mx-auto mb-4">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d" 
                         alt="Michael Chen" 
                         class="rounded-full w-full h-full object-cover">
                    <div class="absolute bottom-0 right-0 bg-green-500 w-4 h-4 rounded-full border-2 border-white"></div>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Michael Chen</h3>
                <p class="text-gray-600 mb-2">Color Specialist</p>
                <p class="text-sm text-gray-500 mb-4">8 years experience</p>
                <div class="flex justify-center space-x-2">
                    <span class="px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-sm">Coloring</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm">Highlights</span>
                </div>
            </div>

            <!-- Specialist Card 3 -->
            <div class="specialist-card rounded-2xl p-6 text-center">
                <div class="relative w-32 h-32 mx-auto mb-4">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80" 
                         alt="Emma Davis" 
                         class="rounded-full w-full h-full object-cover">
                    <div class="absolute bottom-0 right-0 bg-green-500 w-4 h-4 rounded-full border-2 border-white"></div>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Emma Davis</h3>
                <p class="text-gray-600 mb-2">Makeup Artist</p>
                <p class="text-sm text-gray-500 mb-4">5 years experience</p>
                <div class="flex justify-center space-x-2">
                    <span class="px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-sm">Makeup</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm">Skincare</span>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection 