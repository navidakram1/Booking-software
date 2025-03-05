@extends('layouts.admin')

@section('title', 'Edit Booking - GlamGo Admin')
@section('page-title', 'Edit Booking')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Edit Booking</h1>
            <p class="mt-1 text-sm text-gray-600">Update booking details</p>
        </div>
        <div>
            <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to List
            </a>
        </div>
    </div>

    <!-- Booking Form -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Customer Details -->
                <div>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="customer_details[name]" id="customer_name" value="{{ $booking->customer_details['name'] }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" required>
                        </div>
                        <div>
                            <label for="customer_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="customer_details[email]" id="customer_email" value="{{ $booking->customer_details['email'] }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" required>
                        </div>
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="tel" name="customer_details[phone]" id="customer_phone" value="{{ $booking->customer_details['phone'] }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" required>
                        </div>
                    </div>
                </div>

                <!-- Service Details -->
                <div>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Service Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
                            <select name="service_id" id="service_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" required>
                                <option value="">Select a service</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" data-duration="{{ $service->duration }}" data-price="{{ $service->price }}" {{ $booking->service_id == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }} - {{ $service->duration }}min - ${{ number_format($service->price, 2) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="specialist_id" class="block text-sm font-medium text-gray-700">Specialist</label>
                            <select name="specialist_id" id="specialist_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" required>
                                <option value="">Select a specialist</option>
                                @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}" {{ $booking->specialist_id == $specialist->id ? 'selected' : '' }}>
                                    {{ $specialist->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Date & Time</label>
                            <input type="text" name="start_time" id="start_time" value="{{ $booking->start_time }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Details -->
            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h2>
                <div class="space-y-4">
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">{{ $booking->notes }}</textarea>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm" required>
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-between">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                    Update Booking
                </button>
                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this booking?')">
                        Delete Booking
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize datetime picker
    flatpickr("#start_time", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
        minuteIncrement: 15
    });

    // Handle service selection to update end time
    const serviceSelect = document.getElementById('service_id');
    serviceSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const duration = selectedOption.dataset.duration;
        // You can use the duration to calculate and display the end time
        // based on the selected start time
    });
});
</script>
@endpush 