@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Service Packages</h1>
        <button class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">
            Create New Package
        </button>
    </div>

    <!-- Active Packages -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Active Packages</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($activePackages ?? [] as $package)
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $package->name }}</h3>
                            <p class="text-gray-600">{{ $package->description }}</p>
                        </div>
                        <span class="px-2 py-1 text-sm bg-green-100 text-green-800 rounded">Active</span>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Price -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Price</span>
                            <span class="font-semibold">${{ $package->price }}</span>
                        </div>

                        <!-- Duration -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Duration</span>
                            <span class="font-semibold">{{ $package->duration }} min</span>
                        </div>

                        <!-- Services Included -->
                        <div>
                            <h4 class="text-gray-600 mb-2">Services Included</h4>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($package->services ?? [] as $service)
                                <li class="text-gray-700">{{ $service->name }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4 pt-4 border-t">
                            <div class="text-center">
                                <div class="text-sm text-gray-600">Bookings</div>
                                <div class="font-semibold">{{ $package->bookings_count }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-sm text-gray-600">Revenue</div>
                                <div class="font-semibold">${{ $package->revenue }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-sm text-gray-600">Rating</div>
                                <div class="font-semibold">{{ $package->rating }}/5</div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button class="text-blue-600 hover:text-blue-800">Edit</button>
                        <button class="text-red-600 hover:text-red-800">Deactivate</button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-8 bg-white rounded-lg shadow">
                <p class="text-gray-600">No active packages found</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Inactive Packages -->
    <div>
        <h2 class="text-xl font-semibold mb-4">Inactive Packages</h2>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Package Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Price</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Duration</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Total Bookings</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Last Active</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($inactivePackages ?? [] as $package)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-semibold">{{ $package->name }}</div>
                            <div class="text-sm text-gray-600">{{ $package->description }}</div>
                        </td>
                        <td class="px-6 py-4">${{ $package->price }}</td>
                        <td class="px-6 py-4">{{ $package->duration }} min</td>
                        <td class="px-6 py-4">{{ $package->total_bookings }}</td>
                        <td class="px-6 py-4">{{ $package->last_active_date }}</td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-primary hover:text-primary-dark">Reactivate</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-600">
                            No inactive packages found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
