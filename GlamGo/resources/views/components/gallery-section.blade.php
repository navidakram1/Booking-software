@props(['galleryItems'])

<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Our Gallery
            </h2>
            <p class="mt-4 text-lg text-gray-500">
                Browse through our collection of stunning transformations and beautiful results
            </p>
        </div>

        <!-- Filter Buttons -->
        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <button class="gallery-filter-btn active px-6 py-2 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-filter="all">
                All
            </button>
            <button class="gallery-filter-btn px-6 py-2 rounded-full bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-filter="hair">
                Hair
            </button>
            <button class="gallery-filter-btn px-6 py-2 rounded-full bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-filter="makeup">
                Makeup
            </button>
            <button class="gallery-filter-btn px-6 py-2 rounded-full bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-filter="nails">
                Nails
            </button>
            <button class="gallery-filter-btn px-6 py-2 rounded-full bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-filter="spa">
                Spa
            </button>
        </div>

        <!-- Gallery Grid -->
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-grid">
            @foreach($galleryItems as $item)
                <div class="gallery-item relative group" data-category="{{ $item->category }}">
                    <div class="relative aspect-w-4 aspect-h-3 rounded-lg overflow-hidden">
                        <img src="{{ $item->image_url }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <button onclick="openGalleryModal('{{ $item->id }}')" 
                                    class="p-2 bg-white rounded-full text-gray-900 hover:bg-gray-100 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ $item->title }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $item->description }}</p>
                        @if($item->specialist_name)
                            <p class="mt-2 text-sm font-medium text-indigo-600">By {{ $item->specialist_name }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="mt-12 text-center">
            <button id="load-more-btn" 
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                Load More
                <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.gallery-filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');
            const loadMoreBtn = document.getElementById('load-more-btn');
            let currentItems = 9; // Number of items to show initially

            // Filter functionality
            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const filter = button.dataset.filter;
                    
                    // Update active button state
                    filterButtons.forEach(btn => btn.classList.remove('active', 'bg-indigo-600', 'text-white'));
                    button.classList.add('active', 'bg-indigo-600', 'text-white');
                    
                    // Filter items
                    galleryItems.forEach(item => {
                        const category = item.dataset.category;
                        if (filter === 'all' || category === filter) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            // Load more functionality
            function loadMore() {
                const hiddenItems = document.querySelectorAll('.gallery-item[style="display: none;"]');
                for (let i = 0; i < 6 && i < hiddenItems.length; i++) {
                    hiddenItems[i].style.display = '';
                }
                
                if (document.querySelectorAll('.gallery-item[style="display: none;"]').length === 0) {
                    loadMoreBtn.style.display = 'none';
                }
            }

            loadMoreBtn.addEventListener('click', loadMore);

            // Initialize masonry layout (if using a masonry library)
            // Note: You'll need to include a masonry library like Masonry.js or use CSS grid
            
            // Open gallery modal
            window.openGalleryModal = function(itemId) {
                window.dispatchEvent(new CustomEvent('open-gallery-modal', {
                    detail: { itemId: itemId }
                }));
            };
        });
    </script>
</section>
