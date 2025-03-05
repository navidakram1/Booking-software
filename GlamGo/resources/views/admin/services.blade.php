@extends('layouts.admin')

@section('title', 'Services - GlamGo Admin')
@section('page-title', 'Service Management')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Services List -->
    <div class="lg:col-span-3 bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Services</h2>
            <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                Add New Service
            </button>
        </div>

        <!-- Categories -->
        <div class="flex space-x-2 mb-6 overflow-x-auto pb-2">
            <button class="px-4 py-2 text-sm font-medium text-pink-600 bg-pink-50 rounded-lg hover:bg-pink-100 whitespace-nowrap">All Services</button>
            <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100 whitespace-nowrap">Hair Care</button>
            <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100 whitespace-nowrap">Nail Care</button>
            <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100 whitespace-nowrap">Facial</button>
            <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100 whitespace-nowrap">Massage</button>
            <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100 whitespace-nowrap">Makeup</button>
        </div>

        <!-- Services Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left rounded-l-lg">Service Name</th>
                        <th class="px-4 py-3 text-left">Category</th>
                        <th class="px-4 py-3 text-left">Duration</th>
                        <th class="px-4 py-3 text-left">Price</th>
                        <th class="px-4 py-3 text-left rounded-r-lg">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @for ($i = 0; $i < 10; $i++)
                    <tr class="text-gray-800">
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-pink-100 flex items-center justify-center">
                                    <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                                </div>
                                <span class="font-medium">Hair Cut & Style</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-500">Hair Care</td>
                        <td class="px-4 py-3 text-gray-500">45 min</td>
                        <td class="px-4 py-3 font-medium">$65.00</td>
                        <td class="px-4 py-3">
                            <div class="flex space-x-2">
                                <button class="p-1 text-blue-600 hover:bg-blue-50 rounded">
                                    <lord-icon src="https://cdn.lordicon.com/puvaffet.json" trigger="hover" colors="primary:#2563eb" style="width:20px;height:20px"></lord-icon>
                                </button>
                                <button class="p-1 text-red-600 hover:bg-red-50 rounded">
                                    <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#dc2626" style="width:20px;height:20px"></lord-icon>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Stats & Actions -->
    <div class="space-y-6">
        <!-- Stats -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Quick Stats</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Services</span>
                    <span class="font-medium text-gray-800">48</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Active Categories</span>
                    <span class="font-medium text-gray-800">8</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Special Offers</span>
                    <span class="font-medium text-gray-800">5</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Quick Actions</h2>
            <div class="space-y-4">
                <button class="w-full flex items-center justify-between p-4 bg-pink-50 rounded-xl text-pink-600 hover:bg-pink-100 transition-colors duration-200">
                    <span class="font-medium">Add Category</span>
                    <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                </button>
                <button class="w-full flex items-center justify-between p-4 bg-purple-50 rounded-xl text-purple-600 hover:bg-purple-100 transition-colors duration-200">
                    <span class="font-medium">Create Offer</span>
                    <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#9333ea" style="width:20px;height:20px"></lord-icon>
                </button>
                <button class="w-full flex items-center justify-between p-4 bg-blue-50 rounded-xl text-blue-600 hover:bg-blue-100 transition-colors duration-200">
                    <span class="font-medium">Bulk Update</span>
                    <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#2563eb" style="width:20px;height:20px"></lord-icon>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
