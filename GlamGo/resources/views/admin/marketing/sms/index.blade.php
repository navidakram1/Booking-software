@extends('layouts.admin')

@section('title', 'SMS Marketing - GlamGo Admin')
@section('page-title', 'SMS Marketing')

@section('content')
<div class="bg-white rounded-2xl p-6 shadow-sm">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">SMS Campaigns</h2>
        <a href="{{ route('admin.marketing.sms.create') }}" class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition-colors duration-200">
            Create Campaign
        </a>
    </div>

    <!-- Campaigns List -->
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="text-left text-sm text-gray-500 border-b">
                    <th class="pb-4">Campaign Name</th>
                    <th class="pb-4">Message</th>
                    <th class="pb-4">Status</th>
                    <th class="pb-4">Recipients</th>
                    <th class="pb-4">Schedule</th>
                    <th class="pb-4">Performance</th>
                    <th class="pb-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($campaigns as $campaign)
                <tr class="text-sm">
                    <td class="py-4">{{ $campaign->name }}</td>
                    <td class="py-4 max-w-xs truncate">{{ $campaign->message }}</td>
                    <td class="py-4">
                        <span class="px-3 py-1 text-sm rounded-full {{ $campaign->status === 'sent' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                            {{ ucfirst($campaign->status) }}
                        </span>
                    </td>
                    <td class="py-4">{{ $campaign->recipients }}</td>
                    <td class="py-4">{{ $campaign->scheduled_at ? $campaign->scheduled_at->format('M d, Y H:i') : 'Not scheduled' }}</td>
                    <td class="py-4">
                        <div class="text-gray-600">
                            Sent: {{ $campaign->sent }}<br>
                            Delivered: {{ $campaign->delivered }}
                        </div>
                    </td>
                    <td class="py-4">
                        <div class="flex items-center space-x-3">
                            <button class="text-gray-500 hover:text-pink-500">
                                <lord-icon src="https://cdn.lordicon.com/dnmvmpfk.json" trigger="hover" colors="primary:#ec4899" style="width:24px;height:24px"></lord-icon>
                            </button>
                            <button class="text-gray-500 hover:text-pink-500">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="hover" colors="primary:#ec4899" style="width:24px;height:24px"></lord-icon>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-6 text-center text-gray-500">No SMS campaigns found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
