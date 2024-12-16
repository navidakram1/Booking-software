@extends('layouts.app')

@section('title', 'Our Services - GlamGo')

@section('content')
    <!-- Services Hero Section -->
    <div class="pt-32 pb-16 text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">Our Services</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Discover our range of professional beauty and wellness services designed to enhance your natural beauty.</p>
        </div>
    </div>

    <!-- Categories Filter -->
    <div class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center gap-4">
                <button class="category-filter active px-6 py-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white" data-category="all">
                    All Services
                </button>
                @foreach($categories as $category)
                    <button class="category-filter px-6 py-2 rounded-full bg-white text-gray-600 hover:bg-gray-100" data-category="{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="services-grid">
                @foreach($services as $service)
                    <div class="service-card" data-category="{{ $service->category_id }}">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="aspect-w-16 aspect-h-9">
                                <img src="{{ $service->image_url ?? asset('images/service-placeholder.jpg') }}" 
                                     alt="{{ $service->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">{{ $service->name }}</h3>
                                <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-purple-600">${{ number_format($service->price, 2) }}</span>
                                    <a href="{{ route('booking') }}" class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.category-filter');
        const serviceCards = document.querySelectorAll('.service-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active', 'bg-gradient-to-r', 'from-pink-500', 'to-purple-600', 'text-white'));
                filterButtons.forEach(btn => btn.classList.add('bg-white', 'text-gray-600'));

                // Add active class to clicked button
                button.classList.add('active', 'bg-gradient-to-r', 'from-pink-500', 'to-purple-600', 'text-white');
                button.classList.remove('bg-white', 'text-gray-600');

                const category = button.dataset.category;

                serviceCards.forEach(card => {
                    if (category === 'all' || card.dataset.category === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush
