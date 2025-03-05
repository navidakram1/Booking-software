@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Promotions</h1>
        <button class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">
            Create New Promotion
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Active Promotions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h2 class="text-xl font-semibold">Active Promotions</h2>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        @forelse($activePromotions ?? [] as $promotion)
                        <div class="border rounded p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="font-semibold">{{ $promotion->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $promotion->description }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="px-2 py-1 text-sm bg-green-100 text-green-800 rounded">Active</span>
                                    <div class="text-sm text-gray-600 mt-1">
                                        {{ $promotion->start_date }} - {{ $promotion->end_date }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 my-4">
                                <div class="text-center">
                                    <div class="text-sm text-gray-600">Discount</div>
                                    <div class="font-semibold">{{ $promotion->discount }}%</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-sm text-gray-600">Used</div>
                                    <div class="font-semibold">{{ $promotion->usage_count }}</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-sm text-gray-600">Revenue</div>
                                    <div class="font-semibold">${{ $promotion->revenue }}</div>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button class="text-blue-600 hover:text-blue-800">Edit</button>
                                <button class="text-red-600 hover:text-red-800">End</button>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-gray-600">
                            No active promotions found
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Past Promotions -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="p-4 border-b">
                    <h2 class="text-xl font-semibold">Past Promotions</h2>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        @forelse($pastPromotions ?? [] as $promotion)
                        <div class="border rounded p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="font-semibold">{{ $promotion->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $promotion->description }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="px-2 py-1 text-sm bg-gray-100 text-gray-800 rounded">Ended</span>
                                    <div class="text-sm text-gray-600 mt-1">
                                        {{ $promotion->start_date }} - {{ $promotion->end_date }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 my-4">
                                <div class="text-center">
                                    <div class="text-sm text-gray-600">Total Used</div>
                                    <div class="font-semibold">{{ $promotion->total_usage }}</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-sm text-gray-600">Total Revenue</div>
                                    <div class="font-semibold">${{ $promotion->total_revenue }}</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-sm text-gray-600">ROI</div>
                                    <div class="font-semibold">{{ $promotion->roi }}%</div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-gray-600">
                            No past promotions found
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Promotion Analytics -->
        <div>
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h2 class="text-xl font-semibold">Analytics</h2>
                </div>
                <div class="p-4">
                    <div class="space-y-6">
                        <!-- Overall Stats -->
                        <div>
                            <h3 class="font-semibold mb-2">Overall Performance</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-3 rounded">
                                    <div class="text-sm text-gray-600">Active Promos</div>
                                    <div class="text-xl font-semibold">{{ $activeCount ?? 0 }}</div>
                                </div>
                                <div class="bg-gray-50 p-3 rounded">
                                    <div class="text-sm text-gray-600">Total Revenue</div>
                                    <div class="text-xl font-semibold">${{ $totalRevenue ?? 0 }}</div>
                                </div>
                                <div class="bg-gray-50 p-3 rounded">
                                    <div class="text-sm text-gray-600">Avg. Usage</div>
                                    <div class="text-xl font-semibold">{{ $avgUsage ?? 0 }}</div>
                                </div>
                                <div class="bg-gray-50 p-3 rounded">
                                    <div class="text-sm text-gray-600">Avg. ROI</div>
                                    <div class="text-xl font-semibold">{{ $avgRoi ?? '0%' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Popular Services -->
                        <div>
                            <h3 class="font-semibold mb-2">Most Popular Services</h3>
                            <div class="space-y-2">
                                @forelse($popularServices ?? [] as $service)
                                <div class="flex justify-between items-center text-sm">
                                    <span>{{ $service->name }}</span>
                                    <span class="font-semibold">{{ $service->usage_count }} uses</span>
                                </div>
                                @empty
                                <div class="text-sm text-gray-600">
                                    No data available
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Recent Redemptions -->
                        <div>
                            <h3 class="font-semibold mb-2">Recent Redemptions</h3>
                            <div class="space-y-2">
                                @forelse($recentRedemptions ?? [] as $redemption)
                                <div class="text-sm">
                                    <div class="flex justify-between">
                                        <span>{{ $redemption->customer_name ?? 'Unknown Customer' }}</span>
                                        <span class="text-gray-600">{{ $redemption->date ?? now()->format('Y-m-d') }}</span>
                                    </div>
                                    <p class="text-gray-600">{{ $redemption->promotion_name ?? 'Unknown Promotion' }}</p>
                                </div>
                                @empty
                                <div class="text-sm text-gray-600">
                                    No recent redemptions
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
