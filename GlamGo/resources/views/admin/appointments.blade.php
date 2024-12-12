@extends('layouts.admin')

@section('title', 'Appointments - GlamGo Admin')
@section('page-title', 'Appointment Management')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Calendar Section -->
    <div class="lg:col-span-3 bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Booking Calendar</h2>
            <div class="flex space-x-2">
                <button class="px-4 py-2 text-sm font-medium text-pink-600 bg-pink-50 rounded-lg hover:bg-pink-100">Today</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100">Week</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100">Month</button>
            </div>
        </div>
        
        <!-- Calendar Grid -->
        <div class="border rounded-xl">
            <!-- Calendar Header -->
            <div class="grid grid-cols-7 gap-px bg-gray-200 text-sm font-medium text-gray-600">
                @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                <div class="bg-gray-50 p-2 text-center">{{ $day }}</div>
                @endforeach
            </div>
            
            <!-- Calendar Body -->
            <div class="grid grid-cols-7 gap-px bg-gray-200">
                @for ($i = 0; $i < 35; $i++)
                <div class="bg-white p-2 min-h-[100px] relative group hover:bg-gray-50">
                    <span class="text-sm text-gray-500">{{ $i + 1 }}</span>
                    @if($i % 7 == 3)
                    <div class="mt-2">
                        <div class="text-xs bg-pink-100 text-pink-600 p-1 rounded mb-1">2:30 PM - Hair Cut</div>
                        <div class="text-xs bg-purple-100 text-purple-600 p-1 rounded">4:00 PM - Manicure</div>
                    </div>
                    @endif
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Upcoming Appointments -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Today's Schedule</h2>
        <div class="space-y-4">
            @for ($i = 0; $i < 5; $i++)
            <div class="p-4 bg-gray-50 rounded-xl">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-800">2:30 PM</span>
                    <span class="px-2 py-1 text-xs text-pink-600 bg-pink-50 rounded-full">Confirmed</span>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-gray-800">Sarah Johnson</p>
                    <p class="text-sm text-gray-500">Hair Styling</p>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#6b7280" style="width:16px;height:16px"></lord-icon>
                        <span>with John Smith</span>
                    </div>
                </div>
                <div class="mt-4 flex space-x-2">
                    <button class="flex-1 px-3 py-1.5 text-xs font-medium text-pink-600 bg-pink-50 rounded-lg hover:bg-pink-100">Edit</button>
                    <button class="flex-1 px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Cancel</button>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection
