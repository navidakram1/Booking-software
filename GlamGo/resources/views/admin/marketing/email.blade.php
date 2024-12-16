@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Email Marketing</h1>
        <button class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">
            Create New Campaign
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Campaign List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h2 class="text-xl font-semibold">Email Campaigns</h2>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        @forelse($campaigns ?? [] as $campaign)
                        <div class="border rounded p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="font-semibold">{{ $campaign->subject }}</h3>
                                    <p class="text-sm text-gray-600">{{ $campaign->description }}</p>
                                </div>
                                <span class="px-2 py-1 text-sm rounded {{ $campaign->status === 'sent' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($campaign->status) }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center text-sm text-gray-600">
                                <div>
                                    <span>Sent to: {{ $campaign->recipient_count }} recipients</span>
                                    <span class="mx-2">|</span>
                                    <span>Opens: {{ $campaign->open_rate }}%</span>
                                    <span class="mx-2">|</span>
                                    <span>Clicks: {{ $campaign->click_rate }}%</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-800">Edit</button>
                                    <button class="text-red-600 hover:text-red-800">Delete</button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-gray-600">
                            No email campaigns found
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics -->
        <div>
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h2 class="text-xl font-semibold">Campaign Analytics</h2>
                </div>
                <div class="p-4">
                    <div class="space-y-6">
                        <!-- Overall Stats -->
                        <div>
                            <h3 class="font-semibold mb-2">Overall Performance</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-3 rounded">
                                    <div class="text-sm text-gray-600">Total Sent</div>
                                    <div class="text-xl font-semibold">{{ $totalSent ?? 0 }}</div>
                                </div>
                                <div class="bg-gray-50 p-3 rounded">
                                    <div class="text-sm text-gray-600">Avg. Open Rate</div>
                                    <div class="text-xl font-semibold">{{ $avgOpenRate ?? '0%' }}</div>
                                </div>
                                <div class="bg-gray-50 p-3 rounded">
                                    <div class="text-sm text-gray-600">Avg. Click Rate</div>
                                    <div class="text-xl font-semibold">{{ $avgClickRate ?? '0%' }}</div>
                                </div>
                                <div class="bg-gray-50 p-3 rounded">
                                    <div class="text-sm text-gray-600">Subscribers</div>
                                    <div class="text-xl font-semibold">{{ $subscriberCount ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div>
                            <h3 class="font-semibold mb-2">Recent Activity</h3>
                            <div class="space-y-2">
                                @forelse($recentActivity ?? [] as $activity)
                                <div class="text-sm">
                                    <span class="text-gray-600">{{ $activity->time }}</span>
                                    <p>{{ $activity->description }}</p>
                                </div>
                                @empty
                                <div class="text-sm text-gray-600">
                                    No recent activity
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
