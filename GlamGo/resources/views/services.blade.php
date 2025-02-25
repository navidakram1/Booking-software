@extends('layouts.main')

@section('title', 'Our Services - GlamGo')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Our Services</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="relative">
                    <img src="{{ asset($service['image']) }}" alt="{{ $service['name'] }}" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white px-4 py-1 rounded-full">
                        ${{ number_format($service['price'], 2) }}
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $service['name'] }}</h3>
                    <p class="text-gray-600 mb-4">{{ $service['description'] }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">{{ $service['duration'] }} minutes</span>
                        <button onclick="window.location.href='{{ route('booking') }}'" 
                                class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-lg hover:from-pink-600 hover:to-purple-700 transition-all duration-300">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
