@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Staff Shift Management</h2>
        <div class="flex gap-3">
            <button onclick="openShiftTemplateModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Manage Templates
            </button>
            <button onclick="copyWeekShifts()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                Copy Week
            </button>
            <button onclick="exportShifts()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Export Schedule
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <!-- Week Selection -->
            <div class="mb-6 flex justify-between items-center">
                <div class="flex gap-4 items-center">
                    <button class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <h3 class="text-lg font-medium">Week of December 10, 2024</h3>
                    <button class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <div class="flex gap-4">
                    <select class="border rounded-lg px-4 py-2">
                        <option>All Staff</option>
                        <option>Hair Stylists</option>
                        <option>Nail Artists</option>
                        <option>Makeup Artists</option>
                    </select>
                    <button onclick="applyShiftTemplate()" class="text-blue-500 hover:text-blue-700">
                        Apply Template
                    </button>
                </div>
            </div>

            <!-- Weekly Schedule Grid -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 w-48">Staff Member</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Monday</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Tuesday</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Wednesday</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Thursday</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Friday</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Saturday</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Sunday</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <!-- Sample Staff Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <img src="/images/staff/stylist1.jpg" alt="Sarah Johnson" class="w-8 h-8 rounded-full object-cover mr-3">
                                    <div>
                                        <div class="font-medium">Sarah Johnson</div>
                                        <div class="text-sm text-gray-500">Hair Stylist</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="shift-cell" onclick="editShift(1, 'monday')">
                                    <div class="bg-pink-100 text-pink-800 rounded p-2 text-sm">
                                        <div class="font-medium">Morning Shift</div>
                                        <div>9:00 AM - 2:00 PM</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="shift-cell" onclick="editShift(1, 'tuesday')">
                                    <div class="bg-blue-100 text-blue-800 rounded p-2 text-sm">
                                        <div class="font-medium">Evening Shift</div>
                                        <div>2:00 PM - 8:00 PM</div>
                                    </div>
                                </div>
                            </td>
                            <!-- Add cells for other days -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Shift Edit Modal -->
<div id="shiftModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Shift</h3>
            <div class="mt-2 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Shift Type</label>
                    <select class="mt-1 w-full border rounded-lg px-3 py-2">
                        <option>Morning Shift (9:00 AM - 2:00 PM)</option>
                        <option>Evening Shift (2:00 PM - 8:00 PM)</option>
                        <option>Full Day (9:00 AM - 8:00 PM)</option>
                        <option>Custom Hours</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="time" class="mt-1 w-full border rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="time" class="mt-1 w-full border rounded-lg px-3 py-2">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Break Time</label>
                    <input type="number" class="mt-1 w-full border rounded-lg px-3 py-2" placeholder="Minutes">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea class="mt-1 w-full border rounded-lg px-3 py-2" rows="2"></textarea>
                </div>
            </div>
            <div class="mt-4 flex justify-between">
                <button onclick="deleteShift()" class="px-4 py-2 bg-red-500 text-white rounded-lg">Delete</button>
                <div class="flex gap-3">
                    <button onclick="closeShiftModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancel</button>
                    <button onclick="saveShift()" class="px-4 py-2 bg-pink-500 text-white rounded-lg">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template Management Modal -->
<div id="templateModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-[800px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Shift Templates</h3>
            <div class="mt-2">
                <div class="mb-4">
                    <button onclick="createTemplate()" class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                        Create New Template
                    </button>
                </div>
                <div class="space-y-4">
                    <!-- Template List -->
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-medium">Standard Week Template</h4>
                            <div class="flex gap-2">
                                <button class="text-blue-500">Edit</button>
                                <button class="text-red-500">Delete</button>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">Default working hours for regular week</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-3">
                <button onclick="closeTemplateModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function editShift(staffId, day) {
        document.getElementById('shiftModal').classList.remove('hidden');
    }

    function closeShiftModal() {
        document.getElementById('shiftModal').classList.add('hidden');
    }

    function saveShift() {
        // Handle saving shift
        closeShiftModal();
    }

    function deleteShift() {
        if (confirm('Are you sure you want to delete this shift?')) {
            // Handle shift deletion
            closeShiftModal();
        }
    }

    function openShiftTemplateModal() {
        document.getElementById('templateModal').classList.remove('hidden');
    }

    function closeTemplateModal() {
        document.getElementById('templateModal').classList.add('hidden');
    }

    function createTemplate() {
        // Handle template creation
    }

    function copyWeekShifts() {
        // Handle week copying
    }

    function applyShiftTemplate() {
        // Handle template application
    }

    function exportShifts() {
        // Handle shifts export
    }
</script>
@endpush
@endsection
