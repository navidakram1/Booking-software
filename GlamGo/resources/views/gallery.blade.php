@extends('layouts.app')

@section('title', 'Gallery - GlamGo')

@section('content')
    <!-- Gallery Hero Section -->
    <section class="relative py-20 bg-gradient-to-br from-pink-500 to-purple-600">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-500/90 to-purple-600/90"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Our Gallery</h1>
            <p class="text-lg sm:text-xl text-gray-100 max-w-2xl mx-auto">
                Explore our portfolio of stunning transformations and beautiful styles
            </p>
        </div>
    </section>

    <!-- Gallery Filter Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button class="px-6 py-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-medium hover:shadow-lg transition-all duration-300">All</button>
                <button class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 font-medium hover:bg-gray-200 transition-all duration-300">Haircuts</button>
                <button class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 font-medium hover:bg-gray-200 transition-all duration-300">Color</button>
                <button class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 font-medium hover:bg-gray-200 transition-all duration-300">Styling</button>
                <button class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 font-medium hover:bg-gray-200 transition-all duration-300">Treatments</button>
            </div>

            <!-- Gallery Grid with Masonry Layout -->
            <div class="columns-1 md:columns-2 lg:columns-3 gap-8 [column-fill:_balance] box-border mx-auto before:box-inherit after:box-inherit">
                <!-- Gallery Item 1 -->
                <div class="break-inside-avoid mb-8">
                    <div class="glass-card rounded-2xl overflow-hidden group relative cursor-pointer" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3738339/pexels-photo-3738339.jpeg" 
                             alt="Elegant Hairstyle" 
                             class="w-full aspect-[3/4] object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <div class="text-white">
                                <h3 class="font-bold text-lg">Elegant Waves</h3>
                                <p class="text-sm text-gray-200">Modern styling for special occasions</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Gallery Item 2 -->
                <div class="break-inside-avoid mb-8">
                    <div class="glass-card rounded-2xl overflow-hidden group relative cursor-pointer" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3993449/pexels-photo-3993449.jpeg" 
                             alt="Color Treatment" 
                             class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <div class="text-white">
                                <h3 class="font-bold text-lg">Vibrant Colors</h3>
                                <p class="text-sm text-gray-200">Professional color treatments</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Gallery Item 3 -->
                <div class="break-inside-avoid mb-8">
                    <div class="glass-card rounded-2xl overflow-hidden group relative cursor-pointer" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3997391/pexels-photo-3997391.jpeg" 
                             alt="Spa Treatment" 
                             class="w-full aspect-[4/5] object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <div class="text-white">
                                <h3 class="font-bold text-lg">Luxury Spa</h3>
                                <p class="text-sm text-gray-200">Relaxing spa treatments</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Gallery Item 4 -->
                <div class="break-inside-avoid mb-8">
                    <div class="glass-card rounded-2xl overflow-hidden group relative cursor-pointer" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg" 
                             alt="Makeup Session" 
                             class="w-full aspect-[4/3] object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <div class="text-white">
                                <h3 class="font-bold text-lg">Professional Makeup</h3>
                                <p class="text-sm text-gray-200">Expert makeup artistry</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Gallery Item 5 -->
                <div class="break-inside-avoid mb-8">
                    <div class="glass-card rounded-2xl overflow-hidden group relative cursor-pointer" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3985329/pexels-photo-3985329.jpeg" 
                             alt="Facial Treatment" 
                             class="w-full aspect-[3/4] object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <div class="text-white">
                                <h3 class="font-bold text-lg">Facial Care</h3>
                                <p class="text-sm text-gray-200">Rejuvenating facial treatments</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Gallery Item 6 -->
                <div class="break-inside-avoid mb-8">
                    <div class="glass-card rounded-2xl overflow-hidden group relative cursor-pointer" onclick="openLightbox(this)">
                        <img src="https://images.pexels.com/photos/3992855/pexels-photo-3992855.jpeg" 
                             alt="Hair Styling" 
                             class="w-full aspect-[5/6] object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <div class="text-white">
                                <h3 class="font-bold text-lg">Creative Styling</h3>
                                <p class="text-sm text-gray-200">Unique hair designs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl hover:from-pink-600 hover:to-purple-700 transition-all">
                    Load More
                </button>
            </div>
        </div>
    </section>

    <!-- Booking CTA Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-2xl p-12 text-center">
                <h2 class="text-3xl font-bold mb-4">Ready for Your Transformation?</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Book an appointment with our expert stylists and let us help you achieve your dream look.</p>
                <a href="{{ route('booking') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl hover:from-pink-600 hover:to-purple-700 transition-all">
                    Book Now
                </a>
            </div>
        </div>
    </section>

    <!-- Lightbox -->
    <div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden" onclick="closeLightbox()">
        <button class="absolute top-4 right-4 text-white hover:text-pink-500" onclick="closeLightbox()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <div class="flex items-center justify-center h-full">
            <img id="lightbox-img" src="" alt="" class="max-h-[90vh] max-w-[90vw] object-contain">
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function openLightbox(element) {
        const img = element.querySelector('img');
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        
        lightboxImg.src = img.src;
        lightboxImg.alt = img.alt;
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Close lightbox on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });

    // Prevent click on lightbox image from closing the lightbox
    document.getElementById('lightbox-img').addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>
@endpush
