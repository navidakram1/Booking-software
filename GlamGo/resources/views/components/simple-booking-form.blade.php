<!-- Simple Booking Form -->
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8">
    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Service Selection -->
        <div>
            <label for="service" class="block text-sm font-medium text-gray-700">Select Service</label>
            <select id="service" name="service_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }} - ${{ number_format($service->price, 2) }}</option>
                @endforeach
            </select>
        </div>

        <!-- Date Selection -->
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Preferred Date</label>
            <input type="date" id="date" name="date" required 
                   min="{{ date('Y-m-d') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
        </div>

        <!-- Time Selection -->
        <div>
            <label for="time" class="block text-sm font-medium text-gray-700">Preferred Time</label>
            <select id="time" name="time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                @foreach($timeSlots as $slot)
                    <option value="{{ $slot }}">{{ $slot }}</option>
                @endforeach
            </select>
        </div>

        <!-- Contact Information -->
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" id="name" name="name" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
            
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" id="phone" name="phone" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>

        <!-- Notes -->
        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700">Special Requests (Optional)</label>
            <textarea id="notes" name="notes" rows="3" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"></textarea>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                Book Appointment
            </button>
        </div>
    </form>
</div> 