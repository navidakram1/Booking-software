@extends('layouts.admin')

@section('title', 'Create Email Campaign - GlamGo Admin')
@section('page-title', 'Create Email Campaign')

@section('content')
<div class="bg-white rounded-2xl p-6 shadow-sm">
    <form action="{{ route('admin.marketing.emails.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Campaign Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Campaign Name</label>
                <input type="text" name="name" id="name" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Enter campaign name">
            </div>
            
            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Email Subject</label>
                <input type="text" name="subject" id="subject" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Enter email subject">
            </div>
        </div>

        <!-- Email Content -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Email Content</label>
            <textarea name="content" id="content" rows="10" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Compose your email content"></textarea>
        </div>

        <!-- Recipients -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Recipients</label>
            <div class="space-y-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="recipients" value="all" class="text-pink-500 focus:ring-pink-500">
                    <span class="ml-2">All Customers</span>
                </label>
                <br>
                <label class="inline-flex items-center">
                    <input type="radio" name="recipients" value="new" class="text-pink-500 focus:ring-pink-500">
                    <span class="ml-2">New Customers (Last 30 days)</span>
                </label>
                <br>
                <label class="inline-flex items-center">
                    <input type="radio" name="recipients" value="inactive" class="text-pink-500 focus:ring-pink-500">
                    <span class="ml-2">Inactive Customers (No booking in 60 days)</span>
                </label>
            </div>
        </div>

        <!-- Schedule -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Schedule</label>
            <div class="space-y-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="schedule" value="now" class="text-pink-500 focus:ring-pink-500">
                    <span class="ml-2">Send Immediately</span>
                </label>
                <br>
                <label class="inline-flex items-center">
                    <input type="radio" name="schedule" value="later" class="text-pink-500 focus:ring-pink-500">
                    <span class="ml-2">Schedule for Later</span>
                </label>
                <div class="mt-2">
                    <input type="datetime-local" name="scheduled_at" class="rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.marketing.email') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition-colors duration-200">Create Campaign</button>
        </div>
    </form>
</div>
@endsection
