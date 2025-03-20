@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-6">Book an Appointment</h2>

            @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 mb-6 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                
                <!-- Service Selection -->
                <div class="mb-4">
                    <label class="block mb-2">Select Service</label>
                    <select name="service_id" required class="w-full border rounded p-2">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->name }} - ${{ number_format($service->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div class="mb-4">
                    <label class="block mb-2">Select Date</label>
                    <input type="date" name="booking_date" required 
                           min="{{ date('Y-m-d') }}"
                           class="w-full border rounded p-2">
                </div>

                <!-- Time -->
                <div class="mb-4">
                    <label class="block mb-2">Select Time</label>
                    <select name="booking_time" required class="w-full border rounded p-2">
                        @foreach($timeSlots as $slot)
                            <option value="{{ $slot }}">{{ $slot }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Customer Details -->
                <div class="mb-4">
                    <label class="block mb-2">Your Name</label>
                    <input type="text" name="customer_name" required 
                           class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Email</label>
                    <input type="email" name="customer_email" required 
                           class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Phone</label>
                    <input type="tel" name="customer_phone" required 
                           class="w-full border rounded p-2">
                </div>

                <!-- Notes -->
                <div class="mb-6">
                    <label class="block mb-2">Special Requests (Optional)</label>
                    <textarea name="notes" rows="3" 
                              class="w-full border rounded p-2"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-pink-600 text-white py-2 px-4 rounded hover:bg-pink-700">
                    Book Appointment
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 