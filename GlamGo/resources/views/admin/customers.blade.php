@extends('layouts.admin')

@section('title', 'Customer Management - GlamGo Admin')
@section('page-title', 'Customer Management')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Customer List -->
    <div class="lg:col-span-3 bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Customers</h2>
            <div class="flex space-x-2">
                <div class="relative">
                    <input type="text" placeholder="Search customers..." class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="hover" colors="primary:#121331" style="width:20px;height:20px" class="absolute left-3 top-2.5"></lord-icon>
                </div>
                <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                    Add Customer
                </button>
            </div>
        </div>

        <!-- Customer Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left rounded-l-lg">Customer</th>
                        <th class="px-4 py-3 text-left">Contact</th>
                        <th class="px-4 py-3 text-left">Total Visits</th>
                        <th class="px-4 py-3 text-left">Last Visit</th>
                        <th class="px-4 py-3 text-left">Loyalty Points</th>
                        <th class="px-4 py-3 text-left rounded-r-lg">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @for ($i = 0; $i < 10; $i++)
                    <tr class="text-gray-800">
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center">
                                    <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                                </div>
                                <div>
                                    <p class="font-medium">Sarah Johnson</p>
                                    <p class="text-sm text-gray-500">Premium Member</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-gray-500">sarah@example.com</p>
                            <p class="text-sm text-gray-500">+1 234 567 890</p>
                        </td>
                        <td class="px-4 py-3 text-gray-500">24</td>
                        <td class="px-4 py-3 text-gray-500">Dec 5, 2023</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-sm text-pink-600 bg-pink-50 rounded-full">450 pts</span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex space-x-2">
                                <button class="p-1 text-blue-600 hover:bg-blue-50 rounded">
                                    <lord-icon src="https://cdn.lordicon.com/puvaffet.json" trigger="hover" colors="primary:#2563eb" style="width:20px;height:20px"></lord-icon>
                                </button>
                                <button class="p-1 text-pink-600 hover:bg-pink-50 rounded">
                                    <lord-icon src="https://cdn.lordicon.com/uukerzzv.json" trigger="hover" colors="primary:#ec4899" style="width:20px;height:20px"></lord-icon>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

    <!-- Customer Stats & Insights -->
    <div class="space-y-6">
        <!-- Customer Stats -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Customer Stats</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Customers</span>
                    <span class="font-medium text-gray-800">1,248</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">New This Month</span>
                    <span class="font-medium text-gray-800">86</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Premium Members</span>
                    <span class="font-medium text-gray-800">342</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Recent Activity</h2>
            <div class="space-y-4">
                @for ($i = 0; $i < 4; $i++)
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center">
                        <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ec4899" style="width:16px;height:16px"></lord-icon>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Sarah booked a Hair Styling</p>
                        <p class="text-xs text-gray-500">2 hours ago</p>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection
