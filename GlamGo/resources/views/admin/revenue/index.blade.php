@extends('layouts.admin')

@section('title', 'Revenue Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Revenue Dashboard</h1>
        <a href="{{ route('admin.revenue.export') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
            Export Report
        </a>
    </div>

    <!-- Revenue Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium mb-2">Today's Revenue</h3>
            <p class="text-2xl font-bold text-gray-900">$0.00</p>
            <div class="flex items-center mt-2">
                <span class="text-green-500 text-sm font-medium">+0%</span>
                <span class="text-gray-400 text-sm ml-2">vs yesterday</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium mb-2">This Week</h3>
            <p class="text-2xl font-bold text-gray-900">$0.00</p>
            <div class="flex items-center mt-2">
                <span class="text-green-500 text-sm font-medium">+0%</span>
                <span class="text-gray-400 text-sm ml-2">vs last week</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium mb-2">This Month</h3>
            <p class="text-2xl font-bold text-gray-900">$0.00</p>
            <div class="flex items-center mt-2">
                <span class="text-green-500 text-sm font-medium">+0%</span>
                <span class="text-gray-400 text-sm ml-2">vs last month</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium mb-2">This Year</h3>
            <p class="text-2xl font-bold text-gray-900">$0.00</p>
            <div class="flex items-center mt-2">
                <span class="text-green-500 text-sm font-medium">+0%</span>
                <span class="text-gray-400 text-sm ml-2">vs last year</span>
            </div>
        </div>
    </div>

    <!-- Revenue Navigation -->
    <div class="flex space-x-4 mb-8">
        <a href="{{ route('admin.revenue.daily') }}" class="bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg shadow">
            Daily View
        </a>
        <a href="{{ route('admin.revenue.monthly') }}" class="bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg shadow">
            Monthly View
        </a>
        <a href="{{ route('admin.revenue.yearly') }}" class="bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg shadow">
            Yearly View
        </a>
    </div>

    <!-- Revenue Chart -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Revenue Overview</h2>
        <div class="h-80 bg-gray-50 rounded-lg">
            <!-- Add your chart component here -->
            <div class="flex items-center justify-center h-full text-gray-400">
                Chart will be displayed here
            </div>
        </div>
    </div>
</div>
@endsection 