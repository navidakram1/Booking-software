@extends('layouts.admin')

@section('title', 'Cache Management')

@section('content')
<div class="bg-white rounded-2xl p-8 shadow-sm">
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Cache Management</h2>
        <p class="text-gray-600">Manage application cache and optimize performance.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-800 rounded-lg p-4 mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 text-red-800 rounded-lg p-4 mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Clear Cache -->
        <div class="bg-pink-50 rounded-xl p-6">
            <div class="flex items-center mb-4">
                <lord-icon
                    src="https://cdn.lordicon.com/tdrtiskw.json"
                    trigger="hover"
                    colors="primary:#ec4899"
                    style="width:32px;height:32px">
                </lord-icon>
                <h3 class="text-xl font-semibold text-gray-800 ml-2">Clear Cache</h3>
            </div>
            <p class="text-gray-600 mb-4">Clear all cached data including configuration, routes, views, and compiled classes.</p>
            <form action="{{ route('admin.cache.clear') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                    Clear All Cache
                </button>
            </form>
        </div>

        <!-- Optimize Application -->
        <div class="bg-purple-50 rounded-xl p-6">
            <div class="flex items-center mb-4">
                <lord-icon
                    src="https://cdn.lordicon.com/ssdupzsv.json"
                    trigger="hover"
                    colors="primary:#9333ea"
                    style="width:32px;height:32px">
                </lord-icon>
                <h3 class="text-xl font-semibold text-gray-800 ml-2">Optimize Application</h3>
            </div>
            <p class="text-gray-600 mb-4">Cache configuration, routes, and views to optimize application performance.</p>
            <form action="{{ route('admin.cache.optimize') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                    Optimize Application
                </button>
            </form>
        </div>
    </div>

    <!-- Cache Information -->
    <div class="mt-8 bg-gray-50 rounded-xl p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Cache Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <h4 class="text-sm font-medium text-gray-600">Configuration Cache</h4>
                <p class="text-lg font-semibold text-gray-800">{{ file_exists(base_path('bootstrap/cache/config.php')) ? 'Enabled' : 'Disabled' }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <h4 class="text-sm font-medium text-gray-600">Route Cache</h4>
                <p class="text-lg font-semibold text-gray-800">{{ file_exists(base_path('bootstrap/cache/routes-v7.php')) ? 'Enabled' : 'Disabled' }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <h4 class="text-sm font-medium text-gray-600">View Cache</h4>
                <p class="text-lg font-semibold text-gray-800">{{ count(glob(storage_path('framework/views/*'))) > 0 ? 'Enabled' : 'Disabled' }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <h4 class="text-sm font-medium text-gray-600">Application Cache</h4>
                <p class="text-lg font-semibold text-gray-800">{{ cache()->has('app.cache') ? 'Enabled' : 'Disabled' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
