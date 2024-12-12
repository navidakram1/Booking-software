@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Service Add-ons</h2>
        <div class="flex gap-3">
            <a href="{{ route('admin.services.addons.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
                Create Add-on
            </a>
            <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg" onclick="exportAddons()">
                Export Add-ons
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <!-- Filters -->
            <div class="mb-6">
                <div class="flex gap-4">
                    <input type="text" placeholder="Search add-ons..." class="border rounded-lg px-4 py-2 w-64">
                    <select class="border rounded-lg px-4 py-2">
                        <option>All Categories</option>
                        <option>Hair Add-ons</option>
                        <option>Nail Add-ons</option>
                        <option>Spa Add-ons</option>
                        <option>Makeup Add-ons</option>
                    </select>
                    <select class="border rounded-lg px-4 py-2">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Add-ons Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Add-on Name</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Category</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Duration</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Price</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Compatible Services</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <!-- Sample row, will be replaced with actual data -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <img src="/images/addons/hair-treatment.jpg" alt="Hair Treatment" class="w-10 h-10 rounded-lg object-cover mr-3">
                                    <div>
                                        <div class="font-medium">Deep Conditioning</div>
                                        <div class="text-sm text-gray-500">Intensive hair treatment</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">Hair Add-ons</td>
                            <td class="px-4 py-3 text-sm">15 mins</td>
                            <td class="px-4 py-3 text-sm">$25.00</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100">Haircut</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100">Hair Color</span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.services.addons.edit', 1) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <button onclick="assignServices(1)" class="text-purple-500 hover:text-purple-700">Assign</button>
                                    <button onclick="toggleStatus(1)" class="text-yellow-500 hover:text-yellow-700">Toggle</button>
                                    <button onclick="deleteAddon(1)" class="text-red-500 hover:text-red-700">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Showing 1 to 10 of 24 add-ons
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

<!-- Service Assignment Modal -->
<div id="assignModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Assign to Services</h3>
            <div class="mt-2 space-y-3">
                <div class="flex items-center">
                    <input type="checkbox" class="mr-2"> Haircut
                </div>
                <div class="flex items-center">
                    <input type="checkbox" class="mr-2"> Hair Color
                </div>
                <div class="flex items-center">
                    <input type="checkbox" class="mr-2"> Hair Styling
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-3">
                <button onclick="closeAssignModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</button>
                <button onclick="saveAssignments()" class="px-4 py-2 bg-pink-500 text-white rounded-lg">Save</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function exportAddons() {
        // Handle addons export
    }

    function assignServices(id) {
        document.getElementById('assignModal').classList.remove('hidden');
    }

    function closeAssignModal() {
        document.getElementById('assignModal').classList.add('hidden');
    }

    function saveAssignments() {
        // Handle saving service assignments
        closeAssignModal();
    }

    function toggleStatus(id) {
        fetch(`/admin/services/addons/${id}/toggle`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(() => window.location.reload());
    }

    function deleteAddon(id) {
        if (confirm('Are you sure you want to delete this add-on?')) {
            fetch(`/admin/services/addons/${id}`, {
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
