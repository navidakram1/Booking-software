@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Cache Management</h1>
        <p class="text-gray-500">Clear various types of cache to improve system performance</p>
    </div>

    <!-- Cache Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach([
            [
                'name' => 'Application Cache',
                'size' => '256 MB',
                'last_cleared' => '2 hours ago',
                'icon' => 'settings'
            ],
            [
                'name' => 'View Cache',
                'size' => '128 MB',
                'last_cleared' => '1 day ago',
                'icon' => 'layout'
            ],
            [
                'name' => 'Route Cache',
                'size' => '64 MB',
                'last_cleared' => '3 days ago',
                'icon' => 'route'
            ],
            [
                'name' => 'Config Cache',
                'size' => '32 MB',
                'last_cleared' => '1 week ago',
                'icon' => 'gear'
            ]
        ] as $cache)
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                    <i class="lord-icon text-pink-500" data-icon="{{ $cache['icon'] }}"></i>
                </div>
                <button class="text-sm text-blue-600 hover:text-blue-700">Clear</button>
            </div>
            <h3 class="font-medium text-gray-800">{{ $cache['name'] }}</h3>
            <div class="mt-2 space-y-1">
                <p class="text-sm text-gray-500">Size: {{ $cache['size'] }}</p>
                <p class="text-sm text-gray-500">Last cleared: {{ $cache['last_cleared'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Cache Actions -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Cache Actions</h2>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div>
                    <h3 class="font-medium text-gray-800">Clear All Cache</h3>
                    <p class="text-sm text-gray-500">Clear all cached data at once</p>
                </div>
                <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                    Clear All
                </button>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div>
                    <h3 class="font-medium text-gray-800">Optimize Cache</h3>
                    <p class="text-sm text-gray-500">Optimize cache for better performance</p>
                </div>
                <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                    Optimize
                </button>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div>
                    <h3 class="font-medium text-gray-800">Cache Maintenance Mode</h3>
                    <p class="text-sm text-gray-500">Enable maintenance mode while clearing cache</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                </label>
            </div>
        </div>
    </div>

    <!-- Cache Statistics -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Cache Statistics</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-4 bg-gray-50 rounded-xl">
                <h3 class="font-medium text-gray-800">Total Cache Size</h3>
                <p class="text-2xl font-bold text-pink-500 mt-2">480 MB</p>
                <p class="text-sm text-gray-500 mt-1">Across all cache types</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl">
                <h3 class="font-medium text-gray-800">Cache Hit Rate</h3>
                <p class="text-2xl font-bold text-pink-500 mt-2">92%</p>
                <p class="text-sm text-gray-500 mt-1">Last 24 hours</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl">
                <h3 class="font-medium text-gray-800">Cache Efficiency</h3>
                <p class="text-2xl font-bold text-pink-500 mt-2">Good</p>
                <p class="text-sm text-gray-500 mt-1">Based on current metrics</p>
            </div>
        </div>
    </div>
</div>
@endsection
