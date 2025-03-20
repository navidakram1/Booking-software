@props(['images'])

<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Gallery</h2>
            <p class="text-lg text-gray-600">Explore our latest work and transformations</p>
        </div>

        <!-- Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button class="px-6 py-2 rounded-full bg-primary-600 text-white hover:bg-primary-700 transition-colors"
                    x-data
                    @click="$dispatch('filter-gallery', 'all')">
                All
            </button>
            <button class="px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors"
                    x-data
                    @click="$dispatch('filter-gallery', 'hair')">
                Hair
            </button>
            <button class="px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors"
                    x-data
                    @click="$dispatch('filter-gallery', 'makeup')">
                Makeup
            </button>
            <button class="px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors"
                    x-data
                    @click="$dispatch('filter-gallery', 'spa')">
                Spa
            </button>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
             x-data="{ selectedImage: null }"
             @keydown.escape="selectedImage = null">
            @foreach($images as $image)
                <div class="relative group cursor-pointer overflow-hidden rounded-lg"
                     @click="selectedImage = $el.querySelector('img').src">
                    <img src="{{ $image->url }}" 
                         alt="{{ $image->description }}" 
                         class="w-full h-72 object-cover transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <div class="text-white text-center">
                            <p class="text-lg font-semibold">{{ $image->title }}</p>
                            <p class="text-sm">{{ $image->category }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div x-show="selectedImage" 
             x-transition
             class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
             @click="selectedImage = null">
            <div class="max-w-4xl mx-auto p-4">
                <img :src="selectedImage" class="max-h-[80vh] w-auto" @click.stop>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="px-8 py-3 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors"
                    x-data
                    @click="$dispatch('load-more-images')">
                Load More
            </button>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('gallerySection', () => ({
                filter: 'all',
                page: 1,
                
                filterGallery(category) {
                    this.filter = category;
                    this.$wire.filterGallery(category);
                },
                
                loadMore() {
                    this.page++;
                    this.$wire.loadMoreImages(this.page);
                }
            }));
        });
    </script>
    @endpush
</section> 