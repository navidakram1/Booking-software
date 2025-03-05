@forelse($galleryItems as $item)
<div class="gallery-item" 
     data-category="{{ $item->category->slug }}"
     data-aos="fade-up"
     data-aos-delay="{{ $loop->index * 100 }}">
    <div class="relative group cursor-pointer"
         onclick="openGalleryModal({{ $item->id }})">
        <div class="aspect-w-4 aspect-h-3 rounded-2xl overflow-hidden">
            <!-- Before/After Image Comparison -->
            @if($item->before_image && $item->after_image)
            <div class="before-after-slider relative">
                <img src="{{ asset($item->after_image) }}" 
                     alt="{{ $item->title }} After" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 w-1/2 overflow-hidden transform-gpu transition-transform duration-300 hover:w-0">
                    <img src="{{ asset($item->before_image) }}" 
                         alt="{{ $item->title }} Before" 
                         class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-y-0 left-1/2 w-1 bg-white transform -translate-x-1/2"></div>
            </div>
            @else
            <img src="{{ asset($item->image) }}" 
                 alt="{{ $item->title }}" 
                 class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
            @endif

            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                    <h3 class="text-xl font-bold mb-2">{{ $item->title }}</h3>
                    <p class="text-sm text-white/90">{{ Str::limit($item->description, 100) }}</p>
                </div>
            </div>
        </div>

        <!-- Tags -->
        <div class="absolute top-4 right-4 flex flex-wrap gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            @foreach($item->tags as $tag)
            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-sm font-medium text-gray-800">
                {{ $tag }}
            </span>
            @endforeach
        </div>

        <!-- Category Badge -->
        <div class="absolute top-4 left-4">
            <span class="px-3 py-1 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full text-sm font-medium">
                {{ $item->category->name }}
            </span>
        </div>
    </div>
</div>
@empty
<div class="col-span-full flex flex-col items-center justify-center py-12" data-aos="fade-up">
    <lord-icon
        src="https://cdn.lordicon.com/msoeawqm.json"
        trigger="loop"
        colors="primary:#ec4899,secondary:#9333ea"
        style="width:64px;height:64px">
    </lord-icon>
    <p class="mt-4 text-lg text-gray-600">No gallery items found</p>
</div>
@endforelse

@if($galleryItems->hasPages())
<div class="col-span-full mt-8" data-aos="fade-up">
    {{ $galleryItems->links() }}
</div>
@endif
