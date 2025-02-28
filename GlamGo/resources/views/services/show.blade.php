@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            @if($service->image_url)
                <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="w-full h-64 object-cover">
            @endif
            
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $service->name }}</h1>
                
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <span class="text-2xl font-semibold text-primary">${{ number_format($service->price, 2) }}</span>
                        <span class="ml-2 text-gray-600">({{ $service->duration }} minutes)</span>
                    </div>
                    
                    <a href="{{ route('booking.index', ['service' => $service->id]) }}" 
                       class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                        Book Now
                    </a>
                </div>
                
                <div class="prose max-w-none">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Description</h2>
                    <p class="text-gray-700">{{ $service->description }}</p>
                </div>
                
                @if($service->specialists->count() > 0)
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Available Specialists</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($service->specialists as $specialist)
                                <div class="flex items-center p-4 border rounded-lg">
                                    @if($specialist->profile_image)
                                        <img src="{{ $specialist->profile_image }}" 
                                             alt="{{ $specialist->name }}" 
                                             class="w-12 h-12 rounded-full object-cover">
                                    @endif
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900">{{ $specialist->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $specialist->years_of_experience }} years experience</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @if($service->category)
                    <div class="mt-6 pt-6 border-t">
                        <p class="text-gray-600">
                            Category: 
                            <a href="{{ route('services', ['category' => $service->category->slug]) }}" 
                               class="text-primary hover:underline">
                                {{ $service->category->name }}
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 