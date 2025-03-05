@props(['href', 'icon'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl hover:bg-pink-50/50 transition-all duration-300']) }}>
    <lord-icon
        src="{{ $icon }}"
        trigger="hover"
        colors="primary:#ec4899,secondary:#9333ea"
        style="width:20px;height:20px">
    </lord-icon>
    <span>{{ $slot }}</span>
</a> 