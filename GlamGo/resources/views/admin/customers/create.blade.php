@extends('layouts.admin')

@section('title', 'New Customer - GlamGo Admin')
@section('page-title', 'New Customer')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">New Customer</h1>
            <p class="mt-1 text-sm text-gray-600">Add a new customer to your salon</p>
        </div>
        <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
            <lord-icon src="https://cdn.lordicon.com/zmkotitn.json" trigger="hover" colors="primary:#111827" style="width:18px;height:18px" class="mr-2"></lord-icon>
            Back to Customers
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <form action="{{ route('admin.customers.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Basic Information</h3>
                        <p class="mt-1 text-sm text-gray-500">Customer's personal information.</p>
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm @error('name') border-red-300 @enderror"
                                placeholder="Enter customer's full name">
                        </div>
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm @error('email') border-red-300 @enderror"
                                placeholder="customer@example.com">
                        </div>
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <div class="mt-1">
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm @error('phone') border-red-300 @enderror"
                                placeholder="Enter phone number">
                        </div>
                        @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Additional Information</h3>
                        <p class="mt-1 text-sm text-gray-500">Optional details about the customer.</p>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <div class="mt-1">
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <div class="mt-1">
                            <select name="gender" id="gender"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                                <option value="">Select gender</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <div class="mt-1">
                            <textarea name="address" id="address" rows="3"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                                placeholder="Enter customer's address">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <div class="mt-1">
                            <textarea name="notes" id="notes" rows="3"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                                placeholder="Any additional notes about the customer">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preferences -->
            <div class="pt-6">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Preferences</h3>
                    <p class="mt-1 text-sm text-gray-500">Customer communication preferences.</p>
                </div>

                <div class="mt-4 space-y-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="email_notifications" id="email_notifications"
                                class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded"
                                {{ old('email_notifications') ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="email_notifications" class="font-medium text-gray-700">Email Notifications</label>
                            <p class="text-gray-500">Receive appointment reminders and updates via email.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="sms_notifications" id="sms_notifications"
                                class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded"
                                {{ old('sms_notifications') ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="sms_notifications" class="font-medium text-gray-700">SMS Notifications</label>
                            <p class="text-gray-500">Receive appointment reminders and updates via SMS.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="marketing_emails" id="marketing_emails"
                                class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded"
                                {{ old('marketing_emails') ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="marketing_emails" class="font-medium text-gray-700">Marketing Emails</label>
                            <p class="text-gray-500">Receive promotional offers and updates about new services.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-6 border-t border-gray-200">
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="window.location.href='{{ route('admin.customers.index') }}'"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                        <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ffffff"
                            style="width:18px;height:18px" class="mr-2"></lord-icon>
                        Create Customer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
