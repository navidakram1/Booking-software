@props(['specialists'])

<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Specialists</h2>
            <p class="text-lg text-gray-600">Meet our team of experienced beauty professionals</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($specialists as $specialist)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                    <div class="relative pb-[100%]">
                        <img src="{{ $specialist->image_url }}" 
                             alt="{{ $specialist->name }}" 
                             class="absolute inset-0 w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $specialist->name }}</h3>
                        <p class="text-gray-600 mb-3">{{ $specialist->role }}</p>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $specialist->rating)
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
                            <span class="text-gray-600 ml-2">({{ $specialist->reviews_count }})</span>
                        </div>
                        <div class="space-y-2">
                            @foreach($specialist->specialties as $specialty)
                                <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                    {{ $specialty }}
                                </span>
                            @endforeach
                        </div>
                        <a href="{{ route('specialists.show', $specialist) }}" 
                           class="mt-4 block w-full text-center bg-primary-600 text-white py-2 rounded-md hover:bg-primary-700 transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section> 