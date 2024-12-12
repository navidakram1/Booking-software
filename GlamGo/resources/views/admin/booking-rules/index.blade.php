@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Booking Rules</h2>
        <button onclick="openNewRuleModal()" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
            Add New Rule
        </button>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <!-- Rules Categories -->
            <div class="mb-6">
                <div class="flex gap-4">
                    <button class="px-4 py-2 bg-pink-500 text-white rounded-lg">Time Slots</button>
                    <button class="px-4 py-2 hover:bg-gray-100 rounded-lg">Service Limits</button>
                    <button class="px-4 py-2 hover:bg-gray-100 rounded-lg">Booking Window</button>
                    <button class="px-4 py-2 hover:bg-gray-100 rounded-lg">Special Days</button>
                    <button class="px-4 py-2 hover:bg-gray-100 rounded-lg">Cancellation</button>
                </div>
            </div>

            <!-- Rules List -->
            <div class="space-y-4">
                <!-- Time Slot Rules -->
                <div class="border rounded-lg p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium">Operating Hours</h3>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                        </label>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Monday - Friday</label>
                            <div class="mt-1 flex gap-2">
                                <input type="time" class="border rounded px-3 py-1" value="09:00">
                                <span class="self-center">to</span>
                                <input type="time" class="border rounded px-3 py-1" value="18:00">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Saturday - Sunday</label>
                            <div class="mt-1 flex gap-2">
                                <input type="time" class="border rounded px-3 py-1" value="10:00">
                                <span class="self-center">to</span>
                                <input type="time" class="border rounded px-3 py-1" value="16:00">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Window Rule -->
                <div class="border rounded-lg p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium">Advance Booking Window</h3>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                        </label>
                    </div>
                    <div class="flex gap-4 items-center">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700">Minimum Hours Before</label>
                            <input type="number" class="mt-1 border rounded px-3 py-1 w-full" value="24">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700">Maximum Days Ahead</label>
                            <input type="number" class="mt-1 border rounded px-3 py-1 w-full" value="30">
                        </div>
                    </div>
                </div>

                <!-- Service Limit Rule -->
                <div class="border rounded-lg p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium">Service Booking Limits</h3>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                        </label>
                    </div>
                    <div class="space-y-2">
                        <div class="flex gap-4 items-center">
                            <select class="border rounded px-3 py-1 flex-1">
                                <option>Hair Styling</option>
                                <option>Hair Coloring</option>
                                <option>Spa Services</option>
                            </select>
                            <input type="number" placeholder="Max bookings per day" class="border rounded px-3 py-1 flex-1">
                            <button class="text-pink-500 hover:text-pink-600">
                                <i class="fas fa-plus-circle"></i> Add Limit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Changes Button -->
            <div class="mt-6">
                <button class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-lg">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openNewRuleModal() {
        // Handle opening new rule modal
    }

    function saveRules() {
        // Handle saving all rules
    }
</script>
@endpush
@endsection
