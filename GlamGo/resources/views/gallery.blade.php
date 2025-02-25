@extends('layouts.main')

@section('title', 'Gallery - GlamGo')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    Our Gallery
                </span>
            </h1>
            <p class="text-lg text-gray-600">Explore our stunning collection of beauty transformations</p>
        </div>

        <!-- Category Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button onclick="filterGallery('all')" 
                    class="px-6 py-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-semibold hover:from-pink-600 hover:to-purple-700 transition-all duration-300">
                All
            </button>
            @foreach($categories as $category)
            <button onclick="filterGallery('{{ strtolower($category) }}')"
                    class="px-6 py-2 rounded-full bg-white text-gray-600 font-semibold hover:bg-gray-50 transition-all duration-300">
                {{ $category }}
            </button>
            @endforeach
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($galleryItems as $item)
            <div class="gallery-item" data-category="{{ strtolower($item['category']) }}">
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-all duration-300">
                    <img src="{{ $item['image'] }}" 
                         alt="{{ $item['title'] }}" 
                         class="w-full h-64 object-cover rounded-xl mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-gray-600">{{ $item['description'] }}</p>
                    <div class="mt-4">
                        <span class="inline-block px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-sm font-semibold">
                            {{ $item['category'] }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
function filterGallery(category) {
    const items = document.querySelectorAll('.gallery-item');
    
    items.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });

    // Update active button styles
    const buttons = document.querySelectorAll('.category-filter button');
    buttons.forEach(button => {
        if (button.textContent.toLowerCase() === category) {
            button.classList.add('bg-gradient-to-r', 'from-pink-500', 'to-purple-600', 'text-white');
            button.classList.remove('bg-white', 'text-gray-600');
        } else {
            button.classList.remove('bg-gradient-to-r', 'from-pink-500', 'to-purple-600', 'text-white');
            button.classList.add('bg-white', 'text-gray-600');
        }
    });
}
</script>
@endpush
@endsection
