@extends('admin.layouts.app')

@section('title', 'Create New Booking')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.bookings.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Back to Bookings
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-900">Create New Booking</h1>
        </div>

        <form action="{{ route('admin.bookings.store') }}" method="POST" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Customer Selection -->
                <div>
                    <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
                    <select name="customer_id" id="customer_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }} ({{ $customer->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Service Selection -->
                <div>
                    <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
                    <select name="service_id" id="service_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" 
                                    data-duration="{{ $service->duration }}"
                                    data-price="{{ $service->price }}"
                                    {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }} ({{ $service->duration }} min - ${{ number_format($service->price, 2) }})
                            </option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Staff Selection -->
                <div>
                    <label for="staff_id" class="block text-sm font-medium text-gray-700">Staff Member</label>
                    <select name="staff_id" id="staff_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select Staff Member</option>
                        @foreach($staff as $member)
                            <option value="{{ $member->id }}" {{ old('staff_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('staff_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date and Time Selection -->
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Appointment Date & Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           value="{{ old('start_time') }}">
                    @error('start_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div class="md:col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea name="notes" id="notes" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Summary -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Booking Summary</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Duration</span>
                        <span id="duration-display" class="block mt-1 text-sm text-gray-900">-</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">End Time</span>
                        <span id="end-time-display" class="block mt-1 text-sm text-gray-900">-</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Total Amount</span>
                        <span id="price-display" class="block mt-1 text-sm text-gray-900">-</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Create Booking
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('service_id');
    const startTimeInput = document.getElementById('start_time');
    const durationDisplay = document.getElementById('duration-display');
    const endTimeDisplay = document.getElementById('end-time-display');
    const priceDisplay = document.getElementById('price-display');

    // Set minimum date to today
    const today = new Date();
    today.setMinutes(today.getMinutes() - today.getTimezoneOffset());
    startTimeInput.min = today.toISOString().slice(0, 16);

    function updateSummary() {
        const selectedService = serviceSelect.options[serviceSelect.selectedIndex];
        if (selectedService.value) {
            const duration = parseInt(selectedService.dataset.duration);
            const price = parseFloat(selectedService.dataset.price);
            
            durationDisplay.textContent = `${duration} minutes`;
            priceDisplay.textContent = `$${price.toFixed(2)}`;

            if (startTimeInput.value) {
                const startTime = new Date(startTimeInput.value);
                const endTime = new Date(startTime.getTime() + duration * 60000);
                endTimeDisplay.textContent = endTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            }
        } else {
            durationDisplay.textContent = '-';
            endTimeDisplay.textContent = '-';
            priceDisplay.textContent = '-';
        }
    }

    serviceSelect.addEventListener('change', updateSummary);
    startTimeInput.addEventListener('change', updateSummary);

    // Initial update if there are pre-selected values
    updateSummary();
});
</script>
@endsection
