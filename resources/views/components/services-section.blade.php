@props(['services'])

<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Services</h2>
            <p class="text-lg text-gray-600">Discover our range of professional beauty services</p>
        </div>

        <!-- Search and Filter -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           placeholder="Search services..." 
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           x-model="searchQuery"
                           @input="filterServices">
                </div>
                <div class="flex gap-4">
                    <select class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            x-model="selectedCategory"
                            @change="filterServices">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            x-model="priceRange"
                            @change="filterServices">
                        <option value="">Price Range</option>
                        <option value="0-50">Under $50</option>
                        <option value="50-100">$50 - $100</option>
                        <option value="100-200">$100 - $200</option>
                        <option value="200+">$200+</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                    <div class="relative pb-[60%]">
                        <img src="{{ $service->image_url }}" 
                             alt="{{ $service->name }}" 
                             class="absolute inset-0 w-full h-full object-cover">
                        @if($service->hasDiscount())
                            <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $service->discount_percentage }}% OFF
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $service->name }}</h3>
                                <p class="text-gray-600">{{ $service->short_description }}</p>
                            </div>
                            <div class="text-right">
                                @if($service->hasDiscount())
                                    <span class="text-gray-400 line-through text-sm">${{ $service->original_price }}</span><br>
                                @endif
                                <span class="text-2xl font-bold text-primary-600">${{ $service->price }}</span>
                            </div>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $service->rating)
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                            <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 fill-current text-gray-300" viewBox="0 0 24 24">
                                            <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-gray-600 ml-2">({{ $service->reviews_count }})</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $service->duration }} mins
                            </div>
                            <a href="{{ route('services.show', $service) }}" 
                               class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
                                Book Now
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        {{ $services->links() }}
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('servicesSection', () => ({
                searchQuery: '',
                selectedCategory: '',
                priceRange: '',
                
                filterServices() {
                    // Implement filtering logic here
                    this.$wire.filterServices({
                        search: this.searchQuery,
                        category: this.selectedCategory,
                        priceRange: this.priceRange
                    });
                }
            }));
        });
    </script>
    @endpush
</section> 