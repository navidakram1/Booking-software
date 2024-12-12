@extends('layouts.admin')

@section('title', 'Customers - GlamGo Admin')
@section('page-title', 'Customers')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Customers</h1>
            <p class="mt-1 text-sm text-gray-600">Manage your salon's customer base</p>
        </div>
        <a href="{{ route('admin.customers.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
            <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ffffff" style="width:18px;height:18px" class="mr-2"></lord-icon>
            Add New Customer
        </a>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="hover" colors="primary:#9ca3af" style="width:18px;height:18px"></lord-icon>
                    </div>
                    <input type="text" name="search" id="search" class="focus:ring-pink-500 focus:border-pink-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search customers...">
                </div>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm rounded-md">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div>
                <label for="sort" class="block text-sm font-medium text-gray-700">Sort By</label>
                <select id="sort" name="sort" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm rounded-md">
                    <option value="latest">Latest First</option>
                    <option value="name">Name</option>
                    <option value="visits">Most Visits</option>
                    <option value="last_visit">Last Visit</option>
                </select>
            </div>
            <div>
                <label for="perPage" class="block text-sm font-medium text-gray-700">Show</label>
                <select id="perPage" name="perPage" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm rounded-md">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Customer Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                </div>
                <div class="ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Customers</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalCustomers }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <lord-icon src="https://cdn.lordicon.com/hbvyhtse.json" trigger="hover" colors="primary:#ec4899" style="width:48px;height:48px"></lord-icon>
                </div>
                <div class="ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Active Customers</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $activeCustomers }}</dd>
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
                        <dt class="text-sm font-medium text-gray-500 truncate">New This Month</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $newCustomers }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visits</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Visit</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                                        <span class="text-pink-600 font-medium text-sm">{{ strtoupper(substr($customer->name, 0, 2)) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $customer->name }}</div>
                                    <div class="text-sm text-gray-500">Customer since {{ $customer->created_at->format('M Y') }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $customer->email }}</div>
                            <div class="text-sm text-gray-500">{{ $customer->phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $customer->appointments_count }} visits</div>
                            <div class="text-sm text-gray-500">
                                @if($customer->appointments_count > 0)
                                    {{ number_format($customer->total_spent, 2) }} spent
                                @else
                                    No visits yet
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $customer->last_appointment ? $customer->last_appointment->format('M d, Y') : 'Never' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $customer->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $customer->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.customers.show', $customer->id) }}" class="text-gray-500 hover:text-gray-700" title="View Details">
                                    <lord-icon src="https://cdn.lordicon.com/tyounuzx.json" trigger="hover" colors="primary:#111827" style="width:24px;height:24px"></lord-icon>
                                </a>
                                <a href="{{ route('admin.customers.edit', $customer->id) }}" class="text-blue-500 hover:text-blue-700" title="Edit">
                                    <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover" colors="primary:#3b82f6" style="width:24px;height:24px"></lord-icon>
                                </a>
                                <button type="button" onclick="confirmDelete({{ $customer->id }})" class="text-red-500 hover:text-red-700" title="Delete">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="hover" colors="primary:#ef4444" style="width:24px;height:24px"></lord-icon>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No customers found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $customers->links() }}
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div x-data="{ open: false, customerId: null }" x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#ef4444" style="width:48px;height:48px"></lord-icon>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Delete Customer</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Are you sure you want to delete this customer? All of their data will be permanently removed. This action cannot be undone.</p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <form :action="'/admin/customers/' + customerId" method="POST" class="inline-block">
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
    function confirmDelete(customerId) {
        const modal = document.querySelector('[x-data]').__x.$data;
        modal.customerId = customerId;
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
    document.getElementById('status').addEventListener('change', function() {
        // Implement status filter logic
    });

    document.getElementById('sort').addEventListener('change', function() {
        // Implement sort logic
    });

    document.getElementById('perPage').addEventListener('change', function() {
        // Implement per page logic
    });
</script>
@endpush
