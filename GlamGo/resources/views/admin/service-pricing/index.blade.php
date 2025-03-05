@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Service Pricing</h1>
        <button class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">
            Add New Price
        </button>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <!-- Service Categories -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Service Categories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($categories ?? [] as $category)
                <div class="border rounded p-4">
                    <h3 class="font-semibold mb-2">{{ $category->name }}</h3>
                    <div class="space-y-2">
                        @foreach($category->services ?? [] as $service)
                        <div class="flex justify-between items-center">
                            <span>{{ $service->name }}</span>
                            <span class="font-semibold">${{ $service->price }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Special Rates -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Special Rates</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($specialRates ?? [] as $rate)
                <div class="border rounded p-4">
                    <h3 class="font-semibold mb-2">{{ $rate->name }}</h3>
                    <p class="text-gray-600 mb-2">{{ $rate->description }}</p>
                    <div class="flex justify-between items-center">
                        <span>Discount</span>
                        <span class="font-semibold">{{ $rate->discount }}%</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pricing Tiers -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Pricing Tiers</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($pricingTiers ?? [] as $tier)
                <div class="border rounded p-4">
                    <h3 class="font-semibold mb-2">{{ $tier->name }}</h3>
                    <p class="text-gray-600 mb-2">{{ $tier->description }}</p>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span>Base Price</span>
                            <span class="font-semibold">${{ $tier->base_price }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Minimum Duration</span>
                            <span class="font-semibold">{{ $tier->min_duration }} min</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
