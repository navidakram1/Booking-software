@extends('layouts.admin')

@section('title', 'Reports & Analytics - GlamGo Admin')
@section('page-title', 'Reports & Analytics')

@section('content')
<div class="space-y-6">
    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Revenue Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <lord-icon src="https://cdn.lordicon.com/qhviklyi.json" trigger="hover" colors="primary:#059669" style="width:24px;height:24px"></lord-icon>
                </div>
                <button class="text-sm text-gray-500 hover:text-gray-700">
                    <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover" style="width:20px;height:20px"></lord-icon>
                </button>
            </div>
            <h3 class="text-gray-500 text-sm mb-2">Total Revenue</h3>
            <p class="text-2xl font-semibold text-gray-800">$24,560</p>
            <div class="flex items-center mt-2">
                <span class="text-green-500 text-sm">+12.5%</span>
                <span class="text-gray-500 text-sm ml-2">vs last month</span>
            </div>
        </div>

        <!-- Bookings Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="hover" colors="primary:#2563eb" style="width:24px;height:24px"></lord-icon>
                </div>
                <button class="text-sm text-gray-500 hover:text-gray-700">
                    <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover" style="width:20px;height:20px"></lord-icon>
                </button>
            </div>
            <h3 class="text-gray-500 text-sm mb-2">Total Bookings</h3>
            <p class="text-2xl font-semibold text-gray-800">856</p>
            <div class="flex items-center mt-2">
                <span class="text-green-500 text-sm">+8.2%</span>
                <span class="text-gray-500 text-sm ml-2">vs last month</span>
            </div>
        </div>

        <!-- Average Rating Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <lord-icon src="https://cdn.lordicon.com/rjzlnunf.json" trigger="hover" colors="primary:#eab308" style="width:24px;height:24px"></lord-icon>
                </div>
                <button class="text-sm text-gray-500 hover:text-gray-700">
                    <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover" style="width:20px;height:20px"></lord-icon>
                </button>
            </div>
            <h3 class="text-gray-500 text-sm mb-2">Average Rating</h3>
            <p class="text-2xl font-semibold text-gray-800">4.8/5</p>
            <div class="flex items-center mt-2">
                <span class="text-green-500 text-sm">+0.3</span>
                <span class="text-gray-500 text-sm ml-2">vs last month</span>
            </div>
        </div>

        <!-- Customer Satisfaction Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                    <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ec4899" style="width:24px;height:24px"></lord-icon>
                </div>
                <button class="text-sm text-gray-500 hover:text-gray-700">
                    <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover" style="width:20px;height:20px"></lord-icon>
                </button>
            </div>
            <h3 class="text-gray-500 text-sm mb-2">Customer Satisfaction</h3>
            <p class="text-2xl font-semibold text-gray-800">96%</p>
            <div class="flex items-center mt-2">
                <span class="text-green-500 text-sm">+2.4%</span>
                <span class="text-gray-500 text-sm ml-2">vs last month</span>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Revenue Overview</h2>
                <select class="text-sm text-gray-500 border border-gray-200 rounded-lg px-3 py-2">
                    <option>Last 7 Days</option>
                    <option>Last 30 Days</option>
                    <option>Last 90 Days</option>
                </select>
            </div>
            <div class="h-80 flex items-center justify-center bg-gray-50 rounded-xl">
                <!-- Chart will be rendered here -->
                <p class="text-gray-500">Revenue Chart Placeholder</p>
            </div>
        </div>

        <!-- Service Performance -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Service Performance</h2>
                <select class="text-sm text-gray-500 border border-gray-200 rounded-lg px-3 py-2">
                    <option>Last 7 Days</option>
                    <option>Last 30 Days</option>
                    <option>Last 90 Days</option>
                </select>
            </div>
            <div class="h-80 flex items-center justify-center bg-gray-50 rounded-xl">
                <!-- Chart will be rendered here -->
                <p class="text-gray-500">Service Performance Chart Placeholder</p>
            </div>
        </div>
    </div>

    <!-- Detailed Reports -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Top Services -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Top Services</h2>
            <div class="space-y-4">
                @for ($i = 0; $i < 5; $i++)
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-pink-100 flex items-center justify-center">
                            <lord-icon src="https://cdn.lordicon.com/dklbhvrt.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Hair Styling</p>
                            <p class="text-sm text-gray-500">245 bookings</p>
                        </div>
                    </div>
                    <span class="text-green-500">+12%</span>
                </div>
                @endfor
            </div>
        </div>

        <!-- Top Staff -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Top Staff</h2>
            <div class="space-y-4">
                @for ($i = 0; $i < 5; $i++)
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                            <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#2563eb" style="width:20px;height:20px"></lord-icon>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">John Smith</p>
                            <p class="text-sm text-gray-500">156 appointments</p>
                        </div>
                    </div>
                    <span class="text-green-500">+8%</span>
                </div>
                @endfor
            </div>
        </div>

        <!-- Customer Feedback -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Recent Feedback</h2>
            <div class="space-y-4">
                @for ($i = 0; $i < 5; $i++)
                <div class="p-4 bg-gray-50 rounded-xl">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center">
                                <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px"></lord-icon>
                            </div>
                            <span class="font-medium text-gray-800">Sarah J.</span>
                        </div>
                        <div class="flex text-yellow-400">
                            @for ($j = 0; $j < 5; $j++)
                            <lord-icon src="https://cdn.lordicon.com/rjzlnunf.json" trigger="hover" colors="primary:#eab308" style="width:16px;height:16px"></lord-icon>
                            @endfor
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">"Great service, very professional and friendly staff!"</p>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection
