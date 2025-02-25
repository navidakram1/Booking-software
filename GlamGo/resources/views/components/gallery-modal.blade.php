<div class="fixed inset-0 z-50 overflow-y-auto" 
     x-show="showModal"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" 
             x-show="showModal"
             @click="showModal = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        <!-- Modal panel -->
        <div class="inline-block w-full max-w-4xl overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle"
             x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <!-- Close button -->
            <button @click="showModal = false" 
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 focus:outline-none">
                <span class="sr-only">Close</span>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="p-6">
                <!-- Before/After Images -->
                @if($item->before_image && $item->after_image)
                <div class="relative aspect-w-16 aspect-h-9 mb-6 rounded-xl overflow-hidden">
                    <div class="before-after-comparison" 
                         x-data="{ position: 50 }"
                         @mousemove="position = $event.offsetX / $event.target.offsetWidth * 100">
                        <!-- After Image -->
                        <img src="{{ asset($item->after_image) }}" 
                             alt="{{ $item->title }} After"
                             class="absolute inset-0 w-full h-full object-cover">
                        
                        <!-- Before Image (Clipped) -->
                        <div class="absolute inset-0 overflow-hidden" :style="{ width: position + '%' }">
                            <img src="{{ asset($item->before_image) }}" 
                                 alt="{{ $item->title }} Before"
                                 class="absolute inset-0 w-full h-full object-cover">
                        </div>
                        
                        <!-- Slider Handle -->
                        <div class="absolute inset-y-0" :style="{ left: position + '%' }">
                            <div class="absolute inset-y-0 -ml-px w-0.5 bg-white"></div>
                            <div class="absolute top-1/2 -ml-4 -mt-4 w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="aspect-w-16 aspect-h-9 mb-6">
                    <img src="{{ asset($item->image) }}" 
                         alt="{{ $item->title }}"
                         class="w-full h-full object-cover rounded-xl">
                </div>
                @endif

                <!-- Content -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $item->title }}</h3>
                        <span class="px-4 py-1.5 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full text-sm font-medium">
                            {{ $item->category->name }}
                        </span>
                    </div>
                    
                    <p class="text-gray-600">{{ $item->description }}</p>
                    
                    <!-- Tags -->
                    @if(count($item->tags) > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($item->tags as $tag)
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">
                            #{{ $tag }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                    <!-- Book Now Button -->
                    <div class="mt-6">
                        <a href="{{ route('booking.create', ['service' => $item->category->slug]) }}"
                           class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                            Book This Service
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
