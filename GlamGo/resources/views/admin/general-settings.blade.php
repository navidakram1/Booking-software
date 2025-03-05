@extends('layouts.admin')

@section('content')
<div x-data="{ activeTab: 'general' }" class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">General Settings</h1>
        <p class="text-gray-500">Configure your salon's core settings and preferences</p>
    </div>

    <!-- Tabs -->
    <div class="mb-6 border-b border-gray-200">
        <nav class="flex space-x-8" aria-label="Tabs">
            <button @click="activeTab = 'general'" :class="{'border-pink-500 text-pink-600': activeTab === 'general'}" class="border-b-2 py-4 px-1 text-sm font-medium">
                General
            </button>
            <button @click="activeTab = 'header'" :class="{'border-pink-500 text-pink-600': activeTab === 'header'}" class="border-b-2 py-4 px-1 text-sm font-medium">
                Header/Footer
            </button>
            <button @click="activeTab = 'languages'" :class="{'border-pink-500 text-pink-600': activeTab === 'languages'}" class="border-b-2 py-4 px-1 text-sm font-medium">
                Languages
            </button>
            <button @click="activeTab = 'holidays'" :class="{'border-pink-500 text-pink-600': activeTab === 'holidays'}" class="border-b-2 py-4 px-1 text-sm font-medium">
                Holidays
            </button>
            <button @click="activeTab = 'subscription'" :class="{'border-pink-500 text-pink-600': activeTab === 'subscription'}" class="border-b-2 py-4 px-1 text-sm font-medium">
                Subscription
            </button>
        </nav>
    </div>

    <!-- General Settings Tab -->
    <div x-show="activeTab === 'general'" class="space-y-6">
        <!-- Business Information -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Business Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Business Name</label>
                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                    <input type="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                </div>
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">SEO Settings</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                    <textarea class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500" rows="3"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500" placeholder="Separate keywords with commas">
                </div>
            </div>
        </div>

        <!-- Business Hours -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Business Hours</h2>
            <div class="space-y-4">
                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <span class="font-medium text-gray-700">{{ $day }}</span>
                    <div class="flex items-center space-x-4">
                        <input type="time" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                        <span class="text-gray-500">to</span>
                        <input type="time" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-pink-500">
                            <span class="ml-2 text-sm text-gray-500">Closed</span>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Header/Footer Tab -->
    <div x-show="activeTab === 'header'" class="space-y-6">
        <!-- Header Elements -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Header Configuration</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <h3 class="font-medium text-gray-800">Logo</h3>
                        <p class="text-sm text-gray-500">Upload your business logo</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <img src="#" alt="Current logo" class="w-10 h-10 rounded">
                        <button class="px-4 py-2 text-sm text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                            Change Logo
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <h3 class="font-medium text-gray-800">Navigation Menu</h3>
                        <p class="text-sm text-gray-500">Configure menu items and order</p>
                    </div>
                    <button class="px-4 py-2 text-sm text-blue-600 hover:text-blue-700">
                        Edit Menu
                    </button>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <h3 class="font-medium text-gray-800">Contact Information</h3>
                        <p class="text-sm text-gray-500">Show/hide contact details in header</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-pink-500"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Footer Elements -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Footer Configuration</h2>
            <div class="space-y-4">
                <!-- Social Media Links -->
                <div class="p-4 bg-gray-50 rounded-xl">
                    <h3 class="font-medium text-gray-800 mb-4">Social Media Links</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-500 mb-1">Facebook</label>
                            <input type="url" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-500 mb-1">Instagram</label>
                            <input type="url" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-500 mb-1">Twitter</label>
                            <input type="url" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-500 mb-1">LinkedIn</label>
                            <input type="url" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                        </div>
                    </div>
                </div>

                <!-- Footer Sections -->
                <div class="p-4 bg-gray-50 rounded-xl">
                    <h3 class="font-medium text-gray-800 mb-4">Footer Sections</h3>
                    <div class="space-y-4">
                        @foreach(['About Us', 'Quick Links', 'Services', 'Contact Info'] as $section)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">{{ $section }}</span>
                            <div class="flex items-center space-x-4">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-pink-500"></div>
                                </label>
                                <button class="text-blue-600 hover:text-blue-700">Edit</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Languages Tab -->
    <div x-show="activeTab === 'languages'" class="space-y-6">
        <!-- Language Settings -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Language Settings</h2>
                <button class="px-4 py-2 text-sm text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                    Add New Language
                </button>
            </div>
            <div class="space-y-4">
                @foreach(['English', 'Spanish', 'French'] as $language)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <span class="font-medium text-gray-800">{{ $language }}</span>
                        @if($language === 'English')
                        <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Default</span>
                        @endif
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="text-blue-600 hover:text-blue-700">Edit Translations</button>
                        @if($language !== 'English')
                        <button class="text-red-600 hover:text-red-700">Remove</button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Holidays Tab -->
    <div x-show="activeTab === 'holidays'" class="space-y-6">
        <!-- Holiday Calendar -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Holiday Schedule</h2>
                <button class="px-4 py-2 text-sm text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                    Add Holiday
                </button>
            </div>
            <div class="space-y-4">
                @foreach([
                    ['name' => 'Christmas Day', 'date' => '2024-12-25'],
                    ['name' => 'New Year\'s Day', 'date' => '2024-01-01'],
                    ['name' => 'Independence Day', 'date' => '2024-07-04']
                ] as $holiday)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <h3 class="font-medium text-gray-800">{{ $holiday['name'] }}</h3>
                        <p class="text-sm text-gray-500">{{ $holiday['date'] }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="text-blue-600 hover:text-blue-700">Edit</button>
                        <button class="text-red-600 hover:text-red-700">Remove</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Subscription Tab -->
    <div x-show="activeTab === 'subscription'" class="space-y-6">
        <!-- Newsletter Settings -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Newsletter Settings</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <h3 class="font-medium text-gray-800">Enable Newsletter Signup</h3>
                        <p class="text-sm text-gray-500">Show newsletter signup form on website</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-pink-500"></div>
                    </label>
                </div>
                
                <div class="p-4 bg-gray-50 rounded-xl">
                    <h3 class="font-medium text-gray-800 mb-4">Subscriber Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <span class="text-sm text-gray-500">Total Subscribers</span>
                            <p class="text-2xl font-bold text-pink-500">1,234</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Active Subscribers</span>
                            <p class="text-2xl font-bold text-pink-500">1,198</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">This Month</span>
                            <p class="text-2xl font-bold text-pink-500">+45</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Export Subscribers
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                        Send Newsletter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Changes -->
    <div class="fixed bottom-0 right-0 p-6 bg-white border-t w-full md:w-auto md:rounded-tl-2xl md:border-l">
        <div class="flex items-center justify-end space-x-4">
            <button type="button" class="px-6 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                Cancel
            </button>
            <button type="button" class="px-6 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                Save Changes
            </button>
        </div>
    </div>
</div>
@endsection
