@extends('layouts.app')

@section('title', 'Contact Us - GlamGo')

@section('content')
    <!-- Contact Hero Section -->
    <section class="relative py-20 bg-gradient-to-br from-pink-500 to-purple-600">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-500/90 to-purple-600/90"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Contact Us</h1>
            <p class="text-lg sm:text-xl text-gray-100 max-w-2xl mx-auto">
                Get in touch with us for appointments, inquiries, or feedback.
            </p>
        </div>
    </section>

    <!-- Contact Information Grid -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Location -->
                <div class="glass-card p-8 rounded-2xl text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/osuxyevn.json" trigger="hover" colors="primary:#ec4899" style="width:32px;height:32px"></lord-icon>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Visit Us</h3>
                    <p class="text-gray-600">123 Beauty Lane<br>Glamour City, GC 12345</p>
                </div>

                <!-- Phone -->
                <div class="glass-card p-8 rounded-2xl text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/tftaqjwp.json" trigger="hover" colors="primary:#ec4899" style="width:32px;height:32px"></lord-icon>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Call Us</h3>
                    <p class="text-gray-600">(555) 123-4567<br>Mon-Sat: 9am - 8pm</p>
                </div>

                <!-- Email -->
                <div class="glass-card p-8 rounded-2xl text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-pink-100 rounded-full flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/diihvcfp.json" trigger="hover" colors="primary:#ec4899" style="width:32px;height:32px"></lord-icon>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Email Us</h3>
                    <p class="text-gray-600">info@glamgo.com<br>support@glamgo.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-2xl p-8">
                <h2 class="text-3xl font-bold text-center mb-8">Send us a Message</h2>
                
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-green-50 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone (Optional)</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" id="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-2xl overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1!2d-73.985!3d40.748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM40zMCc0OC4wIk4gNzPCsDU5JzA2LjAiVw!5e0!3m2!1sen!2sus!4v1234567890" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
@endsection