@extends('layouts.admin')

@section('title', 'Staff Management - GlamGo Admin')
@section('page-title', 'Staff Management')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Staff List -->
    <div class="lg:col-span-3 bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Staff Members</h2>
            <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                Add New Staff
            </button>
        </div>

        <!-- Staff Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @for ($i = 0; $i < 6; $i++)
            <div class="bg-gray-50 rounded-xl p-6">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#ec4899" style="width:32px;height:32px"></lord-icon>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">John Smith</h3>
                        <p class="text-sm text-gray-500">Hair Stylist</p>
                    </div>
                </div>
                
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Appointments</span>
                        <span class="font-medium text-gray-800">245</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Revenue</span>
                        <span class="font-medium text-gray-800">$12,450</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Rating</span>
                        <span class="font-medium text-gray-800">4.8/5</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button class="flex-1 px-3 py-2 text-sm font-medium text-pink-600 bg-pink-50 rounded-lg hover:bg-pink-100">Profile</button>
                    <button class="flex-1 px-3 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Schedule</button>
                </div>
            </div>
            @endfor
        </div>
    </div>

    <!-- Staff Stats & Actions -->
    <div class="space-y-6">
        <!-- Performance Overview -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Performance Overview</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Active Staff</span>
                    <span class="font-medium text-gray-800">12</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">On Leave</span>
                    <span class="font-medium text-gray-800">2</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Average Rating</span>
                    <span class="font-medium text-gray-800">4.7/5</span>
                </div>
            </div>
        </div>

        <!-- Commission Structure -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Commission Structure</h2>
            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-xl">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-800">Junior Staff</span>
                        <span class="text-sm text-pink-600">30%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-pink-500 h-2 rounded-full" style="width: 30%"></div>
                    </div>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-800">Senior Staff</span>
                        <span class="text-sm text-pink-600">45%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-pink-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-800">Expert Staff</span>
                        <span class="text-sm text-pink-600">60%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-pink-500 h-2 rounded-full" style="width: 60%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
