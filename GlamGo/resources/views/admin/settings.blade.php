@extends('layouts.admin')

@section('title', 'Settings - GlamGo Admin')
@section('page-title', 'Settings')

@section('content')
<div x-data="{ activeTab: 'general' }">
    <!-- Settings Navigation -->
    <div class="bg-white rounded-2xl p-4 shadow-sm mb-6">
        <div class="flex space-x-4 overflow-x-auto">
            <button @click="activeTab = 'general'" :class="{'text-pink-600 border-pink-600': activeTab === 'general'}" class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-pink-600 hover:border-pink-600">
                General
            </button>
            <button @click="activeTab = 'appearance'" :class="{'text-pink-600 border-pink-600': activeTab === 'appearance'}" class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-pink-600 hover:border-pink-600">
                Appearance
            </button>
            <button @click="activeTab = 'services'" :class="{'text-pink-600 border-pink-600': activeTab === 'services'}" class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-pink-600 hover:border-pink-600">
                Services
            </button>
            <button @click="activeTab = 'booking'" :class="{'text-pink-600 border-pink-600': activeTab === 'booking'}" class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-pink-600 hover:border-pink-600">
                Booking
            </button>
            <button @click="activeTab = 'notifications'" :class="{'text-pink-600 border-pink-600': activeTab === 'notifications'}" class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-pink-600 hover:border-pink-600">
                Notifications
            </button>
            <button @click="activeTab = 'payment'" :class="{'text-pink-600 border-pink-600': activeTab === 'payment'}" class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-pink-600 hover:border-pink-600">
                Payment
            </button>
            <button @click="activeTab = 'integrations'" :class="{'text-pink-600 border-pink-600': activeTab === 'integrations'}" class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-pink-600 hover:border-pink-600">
                Integrations
            </button>
        </div>
    </div>

    <!-- General Settings -->
    <div x-show="activeTab === 'general'" class="space-y-6">
        <!-- Business Information -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Business Information</h2>
            <form class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Business Name</label>
                        <input type="text" value="GlamGo Salon" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Website Title</label>
                        <input type="text" value="GlamGo - Beauty & Wellness" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                    <div class="flex items-center space-x-4">
                        <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                            <img src="/logo.png" alt="Logo" class="max-w-full max-h-full p-2">
                        </div>
                        <div>
                            <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                                Change Logo
                            </button>
                            <p class="text-xs text-gray-500 mt-1">Recommended size: 200x200px (PNG, SVG)</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" rows="3">123 Beauty Street, Fashion District, City</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="tel" value="+1 234 567 890" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" value="contact@glamgo.com" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Business Hours</label>
                    <div class="space-y-3">
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                        <div class="flex items-center space-x-4">
                            <div class="w-28">
                                <span class="text-gray-700">{{ $day }}</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                            </label>
                            <div class="flex items-center space-x-2">
                                <input type="time" value="09:00" class="px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                                <span class="text-gray-500">to</span>
                                <input type="time" value="18:00" class="px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>

        <!-- Social Media Links -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Social Media</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                    <input type="url" placeholder="https://facebook.com/yourbusiness" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                    <input type="url" placeholder="https://instagram.com/yourbusiness" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Twitter</label>
                    <input type="url" placeholder="https://twitter.com/yourbusiness" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">SEO Settings</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                    <input type="text" placeholder="GlamGo - Beauty & Wellness Salon" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                    <textarea class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" rows="3" placeholder="Experience luxury beauty treatments at GlamGo..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keywords</label>
                    <input type="text" placeholder="beauty, salon, spa, wellness" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
            </div>
        </div>
    </div>

    <!-- Appearance Settings -->
    <div x-show="activeTab === 'appearance'" class="space-y-6">
        <!-- Theme Colors -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Theme Colors</h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Primary Color</label>
                    <div class="flex items-center space-x-4">
                        <input type="color" value="#EC4899" class="w-12 h-12 rounded-lg border-0 p-0 cursor-pointer">
                        <input type="text" value="#EC4899" class="w-32 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Color</label>
                    <div class="flex items-center space-x-4">
                        <input type="color" value="#8B5CF6" class="w-12 h-12 rounded-lg border-0 p-0 cursor-pointer">
                        <input type="text" value="#8B5CF6" class="w-32 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gradient Preview</label>
                    <div class="h-20 rounded-lg bg-gradient-to-r from-pink-500 to-purple-600"></div>
                </div>
            </div>
        </div>

        <!-- Typography -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Typography</h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Primary Font</label>
                    <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <option>Poppins</option>
                        <option>Inter</option>
                        <option>Roboto</option>
                        <option>Open Sans</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Font Size Scale</label>
                    <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <option>Default</option>
                        <option>Compact</option>
                        <option>Large</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Homepage Sections -->
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Homepage Sections</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <h3 class="font-medium text-gray-800">Hero Section</h3>
                        <p class="text-sm text-gray-500">Main banner with promotional content</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <h3 class="font-medium text-gray-800">Featured Services</h3>
                        <p class="text-sm text-gray-500">Showcase your top services</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <h3 class="font-medium text-gray-800">Testimonials</h3>
                        <p class="text-sm text-gray-500">Customer reviews and feedback</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <h3 class="font-medium text-gray-800">Gallery</h3>
                        <p class="text-sm text-gray-500">Portfolio of your work</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                    </label>
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
