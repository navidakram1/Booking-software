@props(['services'])

<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Our Services
            </h2>
            <p class="mt-4 text-lg text-gray-500">
                Choose from our wide range of professional beauty services
            </p>
        </div>

        <!-- Search and Filter Section -->
        <div class="mt-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           id="service-search"
                           placeholder="Search services..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="flex gap-4">
                    <select id="category-filter" 
                            class="px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Categories</option>
                        <option value="hair">Hair</option>
                        <option value="makeup">Makeup</option>
                        <option value="nails">Nails</option>
                        <option value="spa">Spa</option>
                    </select>
                    <select id="price-filter" 
                            class="px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Price Range</option>
                        <option value="0-50">$0 - $50</option>
                        <option value="51-100">$51 - $100</option>
                        <option value="101+">$101+</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $service)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow duration-300"
                     id="service-card-{{ $service->id }}"
                     data-service-id="{{ $service->id }}">
                    <div class="relative">
                        <img class="h-48 w-full object-cover" 
                             src="{{ $service->image_url ?? asset('images/default-service.jpg') }}" 
                             alt="{{ $service->name }}">
                        @if($service->discount_percentage)
                            <div class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                -{{ $service->discount_percentage }}%
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $service->name }}</h3>
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">
                                {{ $service->category }}
                            </span>
                        </div>
                        
                        <p class="mt-3 text-gray-600 text-sm">{{ $service->description }}</p>
                        
                        <!-- Availability Status -->
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="availability-status flex h-3 w-3 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                                <span class="text-sm text-gray-600 availability-text">Checking availability...</span>
                            </div>
                            <span class="text-sm text-gray-500 next-slot"></span>
                        </div>

                        <div class="mt-4 flex items-center">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-4 w-4 {{ $i <= $service->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="ml-2 text-sm text-gray-600">({{ $service->reviews_count ?? 0 }})</span>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                @if($service->original_price && $service->original_price > $service->price)
                                    <span class="text-sm text-gray-500 line-through">
                                        ${{ number_format($service->original_price, 2) }}
                                    </span>
                                @endif
                                <span class="text-lg font-semibold text-gray-900">
                                    ${{ number_format($service->price, 2) }}
                                </span>
                            </div>
                            <button onclick="openServiceBookingModal('{{ $service->id }}')" 
                                    class="book-now-btn px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View All Services Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('services.index') }}" 
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                View All Services
                <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>

    @push('scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        function openServiceBookingModal(serviceId) {
            window.dispatchEvent(new CustomEvent('open-service-booking-modal', {
                detail: { serviceId: serviceId }
            }));
        }

        // Service filtering functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('service-search');
            const categoryFilter = document.getElementById('category-filter');
            const priceFilter = document.getElementById('price-filter');

            const filterServices = () => {
                const searchTerm = searchInput.value.toLowerCase();
                const category = categoryFilter.value;
                const priceRange = priceFilter.value;

                // Emit custom event for service filtering
                window.dispatchEvent(new CustomEvent('filter-services', {
                    detail: { 
                        searchTerm, 
                        category, 
                        priceRange 
                    }
                }));
            };

            searchInput.addEventListener('input', filterServices);
            categoryFilter.addEventListener('change', filterServices);
            priceFilter.addEventListener('change', filterServices);
        });

        // Initialize Pusher
        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            forceTLS: true
        });

        // Subscribe to the service-availability channel
        const channel = pusher.subscribe('service-availability');
        
        // Listen for availability updates
        channel.bind('availability-updated', function(data) {
            updateServiceAvailability(data);
        });

        // Function to update service availability UI
        function updateServiceAvailability(data) {
            const serviceCard = document.querySelector(`#service-card-${data.service_id}`);
            if (!serviceCard) return;

            const statusDot = serviceCard.querySelector('.availability-status span:last-child');
            const statusText = serviceCard.querySelector('.availability-text');
            const nextSlot = serviceCard.querySelector('.next-slot');
            const bookButton = serviceCard.querySelector('.book-now-btn');

            if (data.is_available) {
                statusDot.classList.remove('bg-red-500');
                statusDot.classList.add('bg-green-500');
                statusText.textContent = 'Available';
                nextSlot.textContent = `Next: ${formatTime(data.next_available_slot)}`;
                bookButton.disabled = false;
                bookButton.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                statusDot.classList.remove('bg-green-500');
                statusDot.classList.add('bg-red-500');
                statusText.textContent = 'Unavailable';
                nextSlot.textContent = data.next_available_slot ? 
                    `Next: ${formatTime(data.next_available_slot)}` : 
                    'No slots available today';
                bookButton.disabled = true;
                bookButton.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Helper function to format time
        function formatTime(dateTimeString) {
            return new Date(dateTimeString).toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
        }

        // Initial availability check for all services
        document.querySelectorAll('[data-service-id]').forEach(card => {
            const serviceId = card.dataset.serviceId;
            fetch(`/api/services/${serviceId}/availability`)
                .then(response => response.json())
                .then(data => updateServiceAvailability({
                    service_id: serviceId,
                    ...data
                }))
                .catch(console.error);
        });
    </script>
    @endpush
</section>
