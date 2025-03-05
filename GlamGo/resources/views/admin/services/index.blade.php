@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Services Management</h2>
        <div class="flex gap-3">
            <a href="{{ route('admin.services.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
                Add New Service
            </a>
            <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg" onclick="exportServices()">
                Export List
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
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Services Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Service Name</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Category</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Duration</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Price</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <!-- Sample row, will be replaced with actual data -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <img src="/images/services/haircut.jpg" alt="Haircut" class="w-10 h-10 rounded-lg object-cover mr-3">
                                    <div>
                                        <div class="font-medium">Haircut & Styling</div>
                                        <div class="text-sm text-gray-500">Basic trim to complete makeover</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">Hair Services</td>
                            <td class="px-4 py-3 text-sm">45 mins</td>
                            <td class="px-4 py-3 text-sm">$45.00</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.services.edit', 1) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <button onclick="toggleStatus(1)" class="text-yellow-500 hover:text-yellow-700">Toggle</button>
                                    <button onclick="deleteService(1)" class="text-red-500 hover:text-red-700">Delete</button>
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

@push('scripts')
<script>
    function exportServices() {
        // Handle services export
    }

    function toggleStatus(id) {
        // Handle service status toggle
        fetch(`/admin/services/${id}/toggle`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(() => window.location.reload());
    }

    function deleteService(id) {
        if (confirm('Are you sure you want to delete this service?')) {
            fetch(`/admin/services/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(() => window.location.reload());
        }
    }
</script>
@endpush
@endsection
