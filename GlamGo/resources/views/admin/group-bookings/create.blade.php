@extends('layouts.admin')

@section('title', 'Create Group Booking - GlamGo Admin')
@section('page-title', 'Create Group Booking')

@section('content')
<div class="bg-white rounded-2xl p-6 shadow-sm">
    <form action="{{ route('admin.group-bookings.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Basic Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Group/Event Name</label>
                <input type="text" name="name" id="name" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="e.g., Johnson Wedding Party">
            </div>
            
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Event Date</label>
                <input type="date" name="date" id="date" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>

        <!-- Venue Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="venue" class="block text-sm font-medium text-gray-700 mb-2">Venue Name</label>
                <input type="text" name="venue" id="venue" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="e.g., Grand Hotel & Spa">
            </div>
            
            <div>
                <label for="venue_address" class="block text-sm font-medium text-gray-700 mb-2">Venue Address</label>
                <input type="text" name="venue_address" id="venue_address" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Enter venue address">
            </div>
        </div>

        <!-- Timing -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="setup_time" class="block text-sm font-medium text-gray-700 mb-2">Setup Time</label>
                <input type="time" name="setup_time" id="setup_time" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
            </div>
            
            <div>
                <label for="event_time" class="block text-sm font-medium text-gray-700 mb-2">Event Time</label>
                <input type="time" name="event_time" id="event_time" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>

        <!-- Services -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Services Required</label>
            <div class="space-y-4">
                @foreach($services as $service)
                <div class="flex items-center justify-between p-4 border rounded-lg">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="services[]" value="{{ $service->id }}" class="text-pink-500 focus:ring-pink-500">
                            <span class="ml-2">{{ $service->name }}</span>
                        </label>
                        <div class="ml-6 text-sm text-gray-500">
                            {{ $service->duration }} mins | ${{ number_format($service->price, 2) }}
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Number of Guests</label>
                        <input type="number" name="service_guests[{{ $service->id }}]" min="1" class="ml-2 w-20 rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Notes -->
        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Additional Notes</label>
            <textarea name="notes" id="notes" rows="4" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Enter any special requirements or notes"></textarea>
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.group-bookings.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition-colors duration-200">Create Booking</button>
        </div>
    </form>
</div>
@endsection
