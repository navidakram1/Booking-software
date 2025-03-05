@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Staff Details</h1>
        <div class="flex space-x-3">
            <a href="{{ route('admin.staff.edit', $staff->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Edit Staff
            </a>
            <a href="{{ route('admin.staff.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Back to List
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Staff Information Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center space-x-4 mb-6">
                @if($staff->profile_image)
                    <img src="{{ asset($staff->profile_image) }}" alt="{{ $staff->name }}" class="w-20 h-20 rounded-full object-cover">
                @else
                    <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-2xl text-gray-600">{{ substr($staff->name, 0, 1) }}</span>
                    </div>
                @endif
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $staff->name }}</h2>
                    <p class="text-gray-600">{{ $staff->position }}</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $staff->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $staff->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Contact Information</h3>
                    <p class="mt-1 text-gray-800">{{ $staff->email }}</p>
                    <p class="text-gray-800">{{ $staff->phone ?? 'No phone number' }}</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Bio</h3>
                    <p class="mt-1 text-gray-800">{{ $staff->bio ?? 'No bio available' }}</p>
                </div>
            </div>
        </div>

        <!-- Performance Metrics Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Performance Metrics</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-500">Total Appointments</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $performanceMetrics['appointments'] }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-500">Average Rating</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ number_format($performanceMetrics['rating'] ?? 0, 1) }}/5</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-500">Total Revenue</p>
                    <p class="text-2xl font-semibold text-gray-800">${{ number_format($performanceMetrics['revenue'], 2) }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-500">Client Retention</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ number_format($performanceMetrics['clientRetention'], 1) }}%</p>
                </div>
            </div>
        </div>

        <!-- Services Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Services</h2>
            @if($staff->services->count() > 0)
                <div class="space-y-4">
                    @foreach($staff->services as $service)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <h3 class="font-medium text-gray-800">{{ $service->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $service->duration }} min • ${{ number_format($service->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center">No services assigned</p>
            @endif
        </div>
    </div>

    <!-- Working Hours -->
    <div class="mt-6 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Working Hours</h2>
        <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
            @php
                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            @endphp
            @foreach($days as $day)
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="font-medium text-gray-800">{{ $day }}</h3>
                    @if(isset($staff->working_hours[$day]))
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $staff->working_hours[$day]['start'] }} - {{ $staff->working_hours[$day]['end'] }}
                        </p>
                    @else
                        <p class="text-sm text-gray-500 mt-1">Not available</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 