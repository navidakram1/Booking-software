@extends('layouts.main')

@section('title', 'Contact Us - GlamGo')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Contact Us</h1>

        @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Contact Information -->
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-800">Get in Touch</h2>
                <p class="text-gray-600">Have questions or want to book an appointment? We're here to help!</p>
                
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-r from-pink-500 to-purple-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Phone</h3>
                        <p class="text-gray-600">+1 (555) 123-4567</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-r from-pink-500 to-purple-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Email</h3>
                        <p class="text-gray-600">contact@glamgo.com</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-r from-pink-500 to-purple-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Location</h3>
                        <p class="text-gray-600">123 Beauty Street, Suite 100<br>Los Angeles, CA 90210</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div>
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="tel" name="phone" id="phone" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" id="message" rows="4" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500"></textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-pink-500 to-purple-600 text-white py-2 px-4 rounded-md hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
