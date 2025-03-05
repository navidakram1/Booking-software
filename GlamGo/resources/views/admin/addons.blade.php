@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Addons Manager</h1>
            <p class="text-gray-500">Manage and configure your salon's addons and integrations</p>
        </div>
        <button class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 flex items-center gap-2">
            <i class="lord-icon" data-icon="plus"></i>
            Upload Addon
        </button>
    </div>

    <!-- Installed Addons -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Installed Addons</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                [
                    'name' => 'SMS Gateway',
                    'description' => 'Send SMS notifications to customers',
                    'version' => '1.2.0',
                    'status' => 'active'
                ],
                [
                    'name' => 'Payment Gateway',
                    'description' => 'Process online payments securely',
                    'version' => '2.0.1',
                    'status' => 'active'
                ],
                [
                    'name' => 'Email Marketing',
                    'description' => 'Send automated email campaigns',
                    'version' => '1.0.5',
                    'status' => 'inactive'
                ]
            ] as $addon)
            <div class="bg-gray-50 rounded-xl p-4">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-medium text-gray-800">{{ $addon['name'] }}</h3>
                        <p class="text-sm text-gray-500">{{ $addon['description'] }}</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full {{ $addon['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst($addon['status']) }}
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">v{{ $addon['version'] }}</span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 text-sm text-blue-600 hover:text-blue-700">Configure</button>
                        @if($addon['status'] === 'active')
                            <button class="px-3 py-1 text-sm text-red-600 hover:text-red-700">Deactivate</button>
                        @else
                            <button class="px-3 py-1 text-sm text-green-600 hover:text-green-700">Activate</button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Available Addons -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Available Addons</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                [
                    'name' => 'Loyalty Program',
                    'description' => 'Reward your regular customers',
                    'price' => '29.99'
                ],
                [
                    'name' => 'Advanced Analytics',
                    'description' => 'Detailed insights and reports',
                    'price' => '49.99'
                ],
                [
                    'name' => 'Social Media Integration',
                    'description' => 'Connect with social platforms',
                    'price' => '19.99'
                ]
            ] as $addon)
            <div class="bg-gray-50 rounded-xl p-4">
                <div class="mb-4">
                    <h3 class="font-medium text-gray-800">{{ $addon['name'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $addon['description'] }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-700">${{ $addon['price'] }}</span>
                    <button class="px-4 py-1 text-sm text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                        Install
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
