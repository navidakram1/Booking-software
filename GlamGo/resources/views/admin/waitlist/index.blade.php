@extends('layouts.admin')

@section('title', 'Waitlist Management - GlamGo Admin')
@section('page-title', 'Waitlist Management')

@section('content')
<div class="bg-white rounded-2xl p-6 shadow-sm">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Waitlist</h2>
        <button type="button" class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition-colors duration-200" onclick="openAddEntryModal()">
            Add Entry
        </button>
    </div>

    <!-- Waitlist Entries -->
    <div class="space-y-4">
        @foreach($entries as $entry)
        <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-gray-800">{{ $entry->customer_name }}</h3>
                    <p class="text-gray-600">{{ $entry->service }}</p>
                    <div class="mt-2 space-y-1 text-sm">
                        <p class="text-gray-500">Preferred Date: {{ $entry->preferred_date->format('M d, Y') }}</p>
                        <p class="text-gray-500">Waiting since: {{ $entry->created_at->diffForHumans() }}</p>
                        <p class="text-gray-500">Contact attempts: {{ $entry->contact_attempts }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 rounded-full text-sm 
                        @if($entry->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif($entry->status === 'contacted') bg-blue-100 text-blue-700
                        @elseif($entry->status === 'scheduled') bg-green-100 text-green-700
                        @else bg-gray-100 text-gray-700
                        @endif">
                        {{ ucfirst($entry->status) }}
                    </span>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="p-2 hover:bg-gray-100 rounded-lg">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10">
                            <form action="{{ route('admin.waitlist.contact-attempt', $entry->id) }}" method="POST" class="border-b">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-50">Record Contact Attempt</button>
                            </form>
                            <form action="{{ route('admin.waitlist.update-status', $entry->id) }}" method="POST" class="border-b">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="scheduled">
                                <button type="submit" class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-50">Mark as Scheduled</button>
                            </form>
                            <form action="{{ route('admin.waitlist.destroy', $entry->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-gray-50">Remove Entry</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Add Entry Modal -->
<div id="addEntryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Add to Waitlist</h3>
                    <button type="button" onclick="closeAddEntryModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('admin.waitlist.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" required class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="service" class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                        <select name="service" id="service" required class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                            <option value="">Select a service</option>
                            <option value="Hair Coloring">Hair Coloring</option>
                            <option value="Hair Cut">Hair Cut</option>
                            <option value="Makeup">Makeup</option>
                            <option value="Manicure">Manicure</option>
                            <option value="Pedicure">Pedicure</option>
                        </select>
                    </div>
                    <div>
                        <label for="preferred_date" class="block text-sm font-medium text-gray-700 mb-1">Preferred Date</label>
                        <input type="date" name="preferred_date" id="preferred_date" required class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeAddEntryModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition-colors duration-200">Add Entry</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openAddEntryModal() {
        document.getElementById('addEntryModal').classList.remove('hidden');
    }

    function closeAddEntryModal() {
        document.getElementById('addEntryModal').classList.add('hidden');
    }
</script>
@endpush
@endsection
