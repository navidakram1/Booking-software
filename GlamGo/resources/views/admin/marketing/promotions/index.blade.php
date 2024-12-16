@extends('layouts.admin')

@section('title', 'Promotions - GlamGo Admin')
@section('page-title', 'Promotions')

@section('content')
<div class="bg-white rounded-2xl p-6 shadow-sm">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Promotions</h2>
        <a href="{{ route('admin.marketing.promotions.create') }}" class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition-colors duration-200">
            Create Promotion
        </a>
    </div>

    <!-- Promotions List -->
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="text-left text-sm text-gray-500 border-b">
                    <th class="pb-4">Promotion Name</th>
                    <th class="pb-4">Type</th>
                    <th class="pb-4">Discount</th>
                    <th class="pb-4">Duration</th>
                    <th class="pb-4">Status</th>
                    <th class="pb-4">Redemptions</th>
                    <th class="pb-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($promotions as $promotion)
                <tr class="text-sm">
                    <td class="py-4">{{ $promotion->name }}</td>
                    <td class="py-4">{{ ucfirst($promotion->type) }}</td>
                    <td class="py-4">{{ $promotion->discount }}</td>
                    <td class="py-4">
                        @if($promotion->start_date && $promotion->end_date)
                            {{ $promotion->start_date->format('M d') }} - {{ $promotion->end_date->format('M d, Y') }}
                        @else
                            Ongoing
                        @endif
                    </td>
                    <td class="py-4">
                        <span class="px-3 py-1 text-sm rounded-full {{ $promotion->status === 'active' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                            {{ ucfirst($promotion->status) }}
                        </span>
                    </td>
                    <td class="py-4">{{ $promotion->redemptions }}</td>
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
                    <td colspan="7" class="py-6 text-center text-gray-500">No promotions found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
