@extends('layouts.main')

@section('title', 'Blog - GlamGo')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    Our Blog
                </span>
            </h1>
            <p class="text-lg text-gray-600">Stay updated with the latest beauty tips and trends</p>
        </div>

        <!-- Blog Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300">
                <div class="relative">
                    <img src="{{ $post['image'] }}" 
                         alt="{{ $post['title'] }}" 
                         class="w-full h-56 object-cover rounded-t-2xl">
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-pink-500 text-white text-xs font-bold rounded-full">
                            {{ $post['category'] }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                        <span>{{ $post['author'] }}</span>
                        <span>•</span>
                        <span>{{ date('M d, Y', strtotime($post['date'])) }}</span>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $post['title'] }}</h2>
                    <p class="text-gray-600 mb-4">{{ $post['excerpt'] }}</p>
                    <a href="{{ url('/blog/' . $post['id']) }}" 
                       class="inline-flex items-center space-x-2 text-pink-600 hover:text-pink-700 font-medium">
                        <span>Read More</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</div>
@endsection
