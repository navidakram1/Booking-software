@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="mb-6">
                <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h2 class="text-2xl font-bold mb-4">Booking Confirmed!</h2>
            <p class="text-gray-600 mb-6">
                Thank you for your booking. A confirmation email has been sent to {{ $booking->customer_email }}
            </p>

            <div class="bg-gray-50 rounded p-6 mb-6 text-left">
                <h3 class="font-bold mb-4">Booking Details:</h3>
                <p><strong>Service:</strong> {{ $booking->service->name }}</p>
                <p><strong>Date:</strong> {{ $booking->booking_date }}</p>
                <p><strong>Time:</strong> {{ $booking->booking_time }}</p>
                <p><strong>Name:</strong> {{ $booking->customer_name }}</p>
            </div>

            <a href="{{ route('home') }}" 
               class="inline-block bg-pink-600 text-white py-2 px-6 rounded hover:bg-pink-700">
                Return to Home
            </a>
        </div>
    </div>
</div>
@endsection 