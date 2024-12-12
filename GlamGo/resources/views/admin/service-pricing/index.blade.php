@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Service Pricing</h2>
        <div class="flex gap-3">
            <button onclick="openBulkUpdateModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Bulk Update
            </button>
            <button onclick="openDiscountModal()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                Apply Discount
            </button>
            <button onclick="exportPricing()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Export Pricing
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <!-- Filters -->
            <div class="mb-6">
                <div class="flex gap-4">
                    <input type="text" placeholder="Search services..." class="border rounded-lg px-4 py-2 w-64">
                    <select class="border rounded-lg px-4 py-2">
                        <option>All Categories</option>
                        <option>Hair Services</option>
                        <option>Nail Services</option>
                        <option>Spa Services</option>
                        <option>Makeup Services</option>
                    </select>
                    <select class="border rounded-lg px-4 py-2">
                        <option>Price Range</option>
                        <option>Under $50</option>
                        <option>$50 - $100</option>
                        <option>$100 - $200</option>
                        <option>Over $200</option>
                    </select>
                </div>
            </div>

            <!-- Pricing Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                <input type="checkbox" class="rounded" onchange="toggleAllServices(this)">
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Service Name</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Category</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Base Price</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Special Price</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Discount</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Valid Until</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <!-- Sample row, will be replaced with actual data -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <input type="checkbox" class="rounded service-checkbox">
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <img src="/images/services/haircut.jpg" alt="Haircut" class="w-10 h-10 rounded-lg object-cover mr-3">
                                    <div>
                                        <div class="font-medium">Haircut & Styling</div>
                                        <div class="text-sm text-gray-500">45 mins</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">Hair Services</td>
                            <td class="px-4 py-3 text-sm">$45.00</td>
                            <td class="px-4 py-3 text-sm">$38.00</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">15% OFF</span>
                            </td>
                            <td class="px-4 py-3 text-sm">2024-12-31</td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex gap-2">
                                    <button onclick="editPrice(1)" class="text-blue-500 hover:text-blue-700">Edit</button>
                                    <button onclick="resetPrice(1)" class="text-yellow-500 hover:text-yellow-700">Reset</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Showing 1 to 10 of 45 services
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

<!-- Bulk Update Modal -->
<div id="bulkUpdateModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Bulk Update Prices</h3>
            <div class="mt-2 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Update Type</label>
                    <select class="mt-1 w-full border rounded-lg px-3 py-2">
                        <option>Fixed Amount</option>
                        <option>Percentage</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Value</label>
                    <input type="number" class="mt-1 w-full border rounded-lg px-3 py-2" placeholder="Enter amount or percentage">
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-3">
                <button onclick="closeBulkUpdateModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</button>
                <button onclick="saveBulkUpdate()" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Discount Modal -->
<div id="discountModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Apply Discount</h3>
            <div class="mt-2 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Discount Type</label>
                    <select class="mt-1 w-full border rounded-lg px-3 py-2">
                        <option>Percentage Off</option>
                        <option>Fixed Amount Off</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Value</label>
                    <input type="number" class="mt-1 w-full border rounded-lg px-3 py-2" placeholder="Enter discount value">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Valid Until</label>
                    <input type="date" class="mt-1 w-full border rounded-lg px-3 py-2">
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-3">
                <button onclick="closeDiscountModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</button>
                <button onclick="saveDiscount()" class="px-4 py-2 bg-green-500 text-white rounded-lg">Apply</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleAllServices(checkbox) {
        document.querySelectorAll('.service-checkbox').forEach(cb => {
            cb.checked = checkbox.checked;
        });
    }

    function openBulkUpdateModal() {
        document.getElementById('bulkUpdateModal').classList.remove('hidden');
    }

    function closeBulkUpdateModal() {
        document.getElementById('bulkUpdateModal').classList.add('hidden');
    }

    function saveBulkUpdate() {
        // Handle bulk price update
        closeBulkUpdateModal();
    }

    function openDiscountModal() {
        document.getElementById('discountModal').classList.remove('hidden');
    }

    function closeDiscountModal() {
        document.getElementById('discountModal').classList.add('hidden');
    }

    function saveDiscount() {
        // Handle discount application
        closeDiscountModal();
    }

    function editPrice(id) {
        // Handle price editing
    }

    function resetPrice(id) {
        if (confirm('Are you sure you want to reset this price to base price?')) {
            // Handle price reset
        }
    }

    function exportPricing() {
        // Handle pricing export
    }
</script>
@endpush
@endsection
