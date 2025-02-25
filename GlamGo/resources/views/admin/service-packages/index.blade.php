@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Service Packages</h2>
        <div class="flex gap-3">
            <a href="{{ route('admin.service-packages.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
                Create Package
            </a>
            <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg" onclick="exportPackages()">
                Export Packages
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <!-- Filters -->
            <div class="mb-6">
                <div class="flex gap-4">
                    <input type="text" placeholder="Search packages..." class="border rounded-lg px-4 py-2 w-64">
                    <select class="border rounded-lg px-4 py-2">
                        <option>All Categories</option>
                        <option>Bridal Packages</option>
                        <option>Spa Packages</option>
                        <option>Hair Packages</option>
                        <option>Special Occasions</option>
                    </select>
                    <select class="border rounded-lg px-4 py-2">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Packages Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Sample Package Card -->
                <div class="border rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="/images/packages/bridal.jpg" alt="Bridal Package" class="w-full h-48 object-cover">
                        <span class="absolute top-2 right-2 px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-medium mb-2">Bridal Beauty Package</h3>
                        <p class="text-gray-600 text-sm mb-4">Complete bridal beauty treatment including hair, makeup, and spa services</p>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Duration:</span>
                                <span class="font-medium">4 hours</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Services Included:</span>
                                <span class="font-medium">5 services</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Regular Price:</span>
                                <span class="font-medium line-through">$500</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Package Price:</span>
                                <span class="font-medium text-pink-500">$400</span>
                            </div>
                        </div>

                        <div class="flex gap-2 pt-4 border-t">
                            <a href="{{ route('admin.service-packages.edit', 1) }}" class="flex-1 text-center py-2 text-blue-500 hover:bg-blue-50 rounded">
                                Edit
                            </a>
                            <button onclick="togglePackageStatus(1)" class="flex-1 text-center py-2 text-yellow-500 hover:bg-yellow-50 rounded">
                                Toggle
                            </button>
                            <button onclick="deletePackage(1)" class="flex-1 text-center py-2 text-red-500 hover:bg-red-50 rounded">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add more package cards here -->
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Showing 1 to 9 of 18 packages
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">Previous</button>
                    <button class="px-3 py-1 border rounded bg-pink-500 text-white">1</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">2</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-50">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function exportPackages() {
        // Handle packages export
    }

    function togglePackageStatus(id) {
        fetch(`/admin/service-packages/${id}/toggle`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(() => window.location.reload());
    }

    function deletePackage(id) {
        if (confirm('Are you sure you want to delete this package?')) {
            fetch(`/admin/service-packages/${id}`, {
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
