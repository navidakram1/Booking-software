@extends('layouts.app')

@section('title', $service->name . ' - GlamGo')

@section('content')
    <!-- Service Detail Hero -->
    <div class="pt-32 pb-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Service Image -->
                <div class="rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ $service->image_url ?? asset('images/service-placeholder.jpg') }}" 
                         alt="{{ $service->name }}" 
                         class="w-full h-full object-cover">
                </div>

                <!-- Service Details -->
                <div>
                    <h1 class="text-4xl font-bold mb-4">{{ $service->name }}</h1>
                    <div class="flex items-center mb-6">
                        <span class="text-2xl font-bold text-purple-600">${{ number_format($service->price, 2) }}</span>
                        <span class="mx-3 text-gray-400">|</span>
                        <span class="text-gray-600">{{ $service->duration }} minutes</span>
                    </div>
                    
                    <div class="prose max-w-none mb-8">
                        <p>{{ $service->description }}</p>
                    </div>

                    <div class="space-y-6">
                        <!-- What's Included -->
                        @if($service->includes)
                        <div>
                            <h3 class="text-xl font-semibold mb-3">What's Included</h3>
                            <ul class="space-y-2">
                                @foreach(explode("\n", $service->includes) as $item)
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Booking Button -->
                        <div>
                            <a href="{{ route('booking', ['service' => $service->id]) }}" 
                               class="inline-block px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                                Book This Service
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Services -->
    @if(isset($relatedServices) && $relatedServices->count() > 0)
    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Related Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedServices as $relatedService)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ $relatedService->image_url ?? asset('images/service-placeholder.jpg') }}" 
                                 alt="{{ $relatedService->name }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $relatedService->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($relatedService->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-purple-600">${{ number_format($relatedService->price, 2) }}</span>
                                <a href="{{ route('services.show', $relatedService) }}" 
                                   class="px-4 py-2 border border-purple-600 text-purple-600 rounded-full hover:bg-purple-600 hover:text-white transition-all duration-300">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endsection
