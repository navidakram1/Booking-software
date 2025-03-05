@forelse($services as $service)
<div class="service-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="relative">
            <img src="{{ asset($service->image) }}" 
                 alt="{{ $service->name }}" 
                 class="service-image w-full h-48 object-cover">
            <div class="absolute top-4 right-4">
                <span class="price-badge px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-sm font-semibold text-pink-600">
                    ${{ number_format($service->price, 2) }}
                </span>
            </div>
        </div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-bold text-gray-900">{{ $service->name }}</h3>
                <span class="text-sm text-gray-500">{{ $service->duration }} min</span>
            </div>
            <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 100) }}</p>
            <div class="flex items-center justify-between">
                <span class="px-3 py-1 bg-pink-50 text-pink-600 rounded-full text-sm">
                    {{ $service->category->name }}
                </span>
                <a href="{{ route('services.show', $service->id) }}" 
                   class="book-button inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-span-full text-center py-12" data-aos="fade-up">
    <div class="text-gray-500">
        <lord-icon
            src="https://cdn.lordicon.com/msoeawqm.json"
            trigger="loop"
            colors="primary:#ec4899,secondary:#9333ea"
            style="width:64px;height:64px">
        </lord-icon>
        <p class="mt-4 text-lg">No services found matching your criteria.</p>
        <button onclick="document.getElementById('filter-form').reset()" 
                class="mt-4 px-6 py-2 text-sm text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-300">
            Clear Filters
        </button>
    </div>
</div>
@endforelse

@if($services->hasPages())
<div class="col-span-full mt-8" data-aos="fade-up">
    {{ $services->links() }}
</div>
@endif
