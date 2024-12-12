@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Waitlist Management</h2>
        <div class="flex gap-3">
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg" onclick="exportWaitlist()">
                Export List
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <!-- Filters -->
            <div class="mb-6">
                <div class="flex gap-4">
                    <input type="text" placeholder="Search waitlist..." class="border rounded-lg px-4 py-2 w-64">
                    <select class="border rounded-lg px-4 py-2">
                        <option>All Services</option>
                        <option>Haircut</option>
                        <option>Hair Coloring</option>
                        <option>Styling</option>
                        <option>Spa</option>
                    </select>
                    <select class="border rounded-lg px-4 py-2">
                        <option>All Status</option>
                        <option>Waiting</option>
                        <option>Contacted</option>
                        <option>Converted</option>
                    </select>
                    <input type="date" class="border rounded-lg px-4 py-2">
                </div>
            </div>

            <!-- Waitlist Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Customer</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Service</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Preferred Date</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Time Slot</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Contact</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <!-- Sample row, will be replaced with actual data -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">Sarah Johnson</td>
                            <td class="px-4 py-3 text-sm">Hair Coloring</td>
                            <td class="px-4 py-3 text-sm">2024-12-15</td>
                            <td class="px-4 py-3 text-sm">Afternoon</td>
                            <td class="px-4 py-3 text-sm">+1 234-567-8900</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Waiting</span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex gap-2">
                                    <button onclick="convertToBooking(1)" class="text-green-500 hover:text-green-700">Convert</button>
                                    <button onclick="contactCustomer(1)" class="text-blue-500 hover:text-blue-700">Contact</button>
                                    <button onclick="removeFromWaitlist(1)" class="text-red-500 hover:text-red-700">Remove</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Showing 1 to 10 of 25 entries
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">Previous</button>
                    <button class="px-3 py-1 border rounded bg-pink-500 text-white">1</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">2</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">3</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function exportWaitlist() {
        // Handle waitlist export
    }

    function convertToBooking(id) {
        window.location.href = `/admin/waitlist/${id}/convert`;
    }

    function contactCustomer(id) {
        // Handle customer contact
    }

    function removeFromWaitlist(id) {
        if (confirm('Are you sure you want to remove this customer from the waitlist?')) {
            // Handle removal
        }
    }
</script>
@endpush
@endsection
