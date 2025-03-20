@props(['specialists'])

<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Our Expert Specialists
            </h2>
            <p class="mt-4 text-lg text-gray-500">
                Book appointments with our highly qualified beauty professionals
            </p>
        </div>

        <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($specialists as $specialist)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative">
                        <img class="h-48 w-full object-cover" src="{{ $specialist->image_url ?? asset('images/default-specialist.jpg') }}" alt="{{ $specialist->name }}">
                        @if($specialist->is_available)
                            <span class="absolute top-2 right-2 px-2 py-1 bg-green-500 text-white text-sm rounded-full">Available</span>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $specialist->name }}</h3>
                        <p class="mt-2 text-gray-600">{{ $specialist->specialization }}</p>
                        
                        <div class="mt-4 flex items-center">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-5 w-5 {{ $i <= $specialist->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="ml-2 text-sm text-gray-600">({{ $specialist->reviews_count ?? 0 }} reviews)</span>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <span class="text-lg font-semibold text-gray-900">
                                ${{ number_format($specialist->hourly_rate, 2) }}/hour
                            </span>
                            <button onclick="openBookingModal('{{ $specialist->id }}')" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('specialists.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                View All Specialists
                <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>

    <script>
        function openBookingModal(specialistId) {
            // Emit event for booking modal
            window.dispatchEvent(new CustomEvent('open-booking-modal', {
                detail: { specialistId: specialistId }
            }));
        }
    </script>
</section>
