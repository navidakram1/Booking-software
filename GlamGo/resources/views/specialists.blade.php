@extends('layouts.main')

@section('title', 'Our Specialists - GlamGo')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Hero Section -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent mb-4">Our Specialists</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Meet our team of experienced beauty professionals dedicated to making you look and feel your best.</p>
        </div>

        <!-- Specialists Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($specialists as $specialist)
                <div class="specialist-card rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <img src="{{ $specialist['image'] }}" alt="{{ $specialist['name'] }}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $specialist['name'] }}</h3>
                    <p class="text-pink-500 font-medium mb-3">{{ $specialist['role'] }}</p>
                    <p class="text-gray-600 mb-4">{{ $specialist['experience'] }} of experience</p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('booking.index', ['specialist' => $specialist['id']]) }}" 
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-lg hover:from-pink-600 hover:to-purple-700 transition-all duration-300">
                            <span>Book Now</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .specialist-card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .specialist-card:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.15);
        }
    </style>
@endsection
