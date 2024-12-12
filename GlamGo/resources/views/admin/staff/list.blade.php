@extends('layouts.admin')

@section('title', 'Staff Management - GlamGo Admin')
@section('page-title', 'Staff Management')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Staff Management</h1>
            <p class="mt-1 text-sm text-gray-600">Manage your salon's staff and specialists</p>
        </div>
        <a href="{{ route('admin.staff.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
            <lord-icon src="https://cdn.lordicon.com/hbvyhtse.json" trigger="hover" colors="primary:#ffffff" style="width:18px;height:18px" class="mr-2"></lord-icon>
            Add New Staff
        </a>
    </div>

    <!-- Staff Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                </div>
                <div class="ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Staff</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalStaff }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <lord-icon src="https://cdn.lordicon.com/uukerzzv.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                </div>
                <div class="ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Appointments</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalAppointments }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                </div>
                <div class="ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Active Services</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalServices }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <lord-icon src="https://cdn.lordicon.com/vaeagfzc.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                </div>
                <div class="ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Avg. Rating</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($averageRating, 1) }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Staff List -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-medium text-gray-900">Staff Members</h2>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" id="search" placeholder="Search staff..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="hover" colors="primary:#9ca3af" style="width:18px;height:18px"></lord-icon>
                        </div>
                    </div>
                    <select id="role" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm rounded-md">
                        <option value="">All Roles</option>
                        <option value="stylist">Stylist</option>
                        <option value="colorist">Colorist</option>
                        <option value="therapist">Therapist</option>
                        <option value="assistant">Assistant</option>
                    </select>
                    <select id="status" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm rounded-md">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff Member</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Services</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Performance</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($staff as $member)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($member->photo)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                                            <span class="text-pink-600 font-medium text-sm">{{ strtoupper(substr($member->name, 0, 2)) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $member->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $member->role }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $member->email }}</div>
                            <div class="text-sm text-gray-500">{{ $member->phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-wrap gap-1">
                                @foreach($member->services as $service)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                        {{ $service->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $member->appointments_count }} appointments</div>
                            <div class="flex items-center">
                                <div class="text-sm text-gray-500 mr-2">Rating:</div>
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($member->rating))
                                            <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @else
                                            <svg class="h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $member->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $member->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.staff.show', $member->id) }}" class="text-gray-500 hover:text-gray-700" title="View Details">
                                    <lord-icon src="https://cdn.lordicon.com/tyounuzx.json" trigger="hover" colors="primary:#111827" style="width:24px;height:24px"></lord-icon>
                                </a>
                                <a href="{{ route('admin.staff.edit', $member->id) }}" class="text-blue-500 hover:text-blue-700" title="Edit">
                                    <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover" colors="primary:#3b82f6" style="width:24px;height:24px"></lord-icon>
                                </a>
                                <button type="button" onclick="confirmDelete({{ $member->id }})" class="text-red-500 hover:text-red-700" title="Delete">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="hover" colors="primary:#ef4444" style="width:24px;height:24px"></lord-icon>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No staff members found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($staff->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $staff->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div x-data="{ open: false, staffId: null }" x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#ef4444" style="width:48px;height:48px"></lord-icon>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Delete Staff Member</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Are you sure you want to remove this staff member? All of their data will be permanently removed. This action cannot be undone.</p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <form :action="'/admin/staff/' + staffId" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                </form>
                <button type="button" @click="open = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(staffId) {
        const modal = document.querySelector('[x-data]').__x.$data;
        modal.staffId = staffId;
        modal.open = true;
    }

    // Initialize search functionality
    const searchInput = document.getElementById('search');
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            // Implement search logic here
        }, 500);
    });

    // Initialize filters
    document.getElementById('role').addEventListener('change', function() {
        // Implement role filter logic
    });

    document.getElementById('status').addEventListener('change', function() {
        // Implement status filter logic
    });
</script>
@endpush
