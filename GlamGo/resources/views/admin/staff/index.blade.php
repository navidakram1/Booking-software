@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Staff Management</h2>
        <div class="flex gap-3">
            <a href="{{ route('admin.staff.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
                Add Staff Member
            </a>
            <button onclick="exportStaff()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Export Staff List
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <!-- Filters -->
            <div class="mb-6">
                <div class="flex gap-4">
                    <input type="text" placeholder="Search staff..." class="border rounded-lg px-4 py-2 w-64">
                    <select class="border rounded-lg px-4 py-2">
                        <option>All Roles</option>
                        <option>Hair Stylist</option>
                        <option>Nail Artist</option>
                        <option>Makeup Artist</option>
                        <option>Spa Therapist</option>
                    </select>
                    <select class="border rounded-lg px-4 py-2">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>On Leave</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Staff Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Sample Staff Card -->
                <div class="border rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="/images/staff/stylist1.jpg" alt="Sarah Johnson" class="w-full h-48 object-cover">
                        <span class="absolute top-2 right-2 px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-lg font-medium">Sarah Johnson</h3>
                                <p class="text-gray-600 text-sm">Senior Hair Stylist</p>
                            </div>
                            <div class="flex -space-x-2">
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-pink-100 text-pink-500 rounded-full font-medium text-sm">4.8</span>
                            </div>
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="far fa-calendar-alt w-5"></i>
                                <span>Joined Jan 2023</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="far fa-clock w-5"></i>
                                <span>Full-time</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="far fa-gem w-5"></i>
                                <span>156 Services Completed</span>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">Haircuts</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">Coloring</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">Styling</span>
                        </div>

                        <div class="flex gap-2 pt-4 border-t">
                            <a href="{{ route('admin.staff.show', 1) }}" class="flex-1 text-center py-2 text-blue-500 hover:bg-blue-50 rounded">
                                View
                            </a>
                            <a href="{{ route('admin.staff.edit', 1) }}" class="flex-1 text-center py-2 text-yellow-500 hover:bg-yellow-50 rounded">
                                Edit
                            </a>
                            <button onclick="toggleStaffStatus(1)" class="flex-1 text-center py-2 text-green-500 hover:bg-green-50 rounded">
                                Toggle
                            </button>
                            <button onclick="deleteStaff(1)" class="flex-1 text-center py-2 text-red-500 hover:bg-red-50 rounded">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add more staff cards here -->
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Showing 1 to 9 of 24 staff members
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
    function exportStaff() {
        // Handle staff export
    }

    function toggleStaffStatus(id) {
        fetch(`/admin/staff/${id}/toggle`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(() => window.location.reload());
    }

    function deleteStaff(id) {
        if (confirm('Are you sure you want to delete this staff member?')) {
            fetch(`/admin/staff/${id}`, {
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
