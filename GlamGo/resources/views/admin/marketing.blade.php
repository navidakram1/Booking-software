@extends('layouts.admin')

@section('title', 'Marketing & Promotions - GlamGo Admin')
@section('page-title', 'Marketing & Promotions')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Promotions List -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Active Promotions -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Active Promotions</h2>
                <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                    Create Promotion
                </button>
            </div>
            <div class="space-y-4">
                @foreach(range(1, 3) as $index)
                <div class="p-4 bg-gray-50 rounded-xl">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                                <lord-icon src="https://cdn.lordicon.com/ngcezuqf.json" trigger="hover" colors="primary:#ec4899" style="width:24px;height:24px"></lord-icon>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800">Summer Special Offer</h3>
                                <p class="text-sm text-gray-500">20% off on all hair services</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-sm text-green-600 bg-green-50 rounded-full">Active</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Valid until Aug 31, 2024</span>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-blue-600 hover:bg-blue-50 rounded-lg">Edit</button>
                            <button class="px-3 py-1 text-red-600 hover:bg-red-50 rounded-lg">End</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Email Campaigns -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Email Campaigns</h2>
                <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                    New Campaign
                </button>
            </div>
            <div class="space-y-4">
                @foreach(range(1, 3) as $index)
                <div class="p-4 bg-gray-50 rounded-xl">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <lord-icon src="https://cdn.lordicon.com/wxnxiano.json" trigger="hover" colors="primary:#2563eb" style="width:24px;height:24px"></lord-icon>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800">Monthly Newsletter</h3>
                                <p class="text-sm text-gray-500">July Edition - Summer Beauty Tips</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-sm text-blue-600 bg-blue-50 rounded-full">Scheduled</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Sending on Jul 1, 2024</span>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-blue-600 hover:bg-blue-50 rounded-lg">Edit</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-lg">Preview</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Marketing Stats & Tools -->
    <div class="space-y-6">
        <!-- Campaign Performance -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Campaign Performance</h2>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Email Open Rate</span>
                        <span class="font-medium text-gray-800">68%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 68%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Click Rate</span>
                        <span class="font-medium text-gray-800">42%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 42%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Conversion Rate</span>
                        <span class="font-medium text-gray-800">15%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-pink-500 h-2 rounded-full" style="width: 15%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Tools -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Quick Tools</h2>
            <div class="grid grid-cols-2 gap-4">
                <button class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all">
                    <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover" colors="primary:#333333" style="width:32px;height:32px" class="mx-auto mb-2"></lord-icon>
                    <span class="block text-sm font-medium text-gray-700">SMS Blast</span>
                </button>
                <button class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all">
                    <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover" colors="primary:#333333" style="width:32px;height:32px" class="mx-auto mb-2"></lord-icon>
                    <span class="block text-sm font-medium text-gray-700">Analytics</span>
                </button>
                <button class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all">
                    <lord-icon src="https://cdn.lordicon.com/rfbqeber.json" trigger="hover" colors="primary:#333333" style="width:32px;height:32px" class="mx-auto mb-2"></lord-icon>
                    <span class="block text-sm font-medium text-gray-700">Templates</span>
                </button>
                <button class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all">
                    <lord-icon src="https://cdn.lordicon.com/amascaoj.json" trigger="hover" colors="primary:#333333" style="width:32px;height:32px" class="mx-auto mb-2"></lord-icon>
                    <span class="block text-sm font-medium text-gray-700">Segments</span>
                </button>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Upcoming Events</h2>
            <div class="space-y-4">
                @foreach(range(1, 3) as $index)
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Beauty Workshop</h3>
                        <p class="text-sm text-gray-500">Jul 15, 2024 • 2:00 PM</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
