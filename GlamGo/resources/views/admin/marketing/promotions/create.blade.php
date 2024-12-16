@extends('layouts.admin')

@section('title', 'Create Promotion - GlamGo Admin')
@section('page-title', 'Create Promotion')

@section('content')
<div class="bg-white rounded-2xl p-6 shadow-sm">
    <form action="{{ route('admin.marketing.promotions.store-new') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Promotion Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Promotion Name</label>
                <input type="text" name="name" id="name" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Enter promotion name">
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Promotion Type</label>
                <select name="type" id="type" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                    <option value="">Select type</option>
                    <option value="service">Service Discount</option>
                    <option value="package">Package Discount</option>
                    <option value="seasonal">Seasonal Offer</option>
                    <option value="referral">Referral Reward</option>
                </select>
            </div>
        </div>

        <!-- Discount Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="discount_type" class="block text-sm font-medium text-gray-700 mb-2">Discount Type</label>
                <select name="discount_type" id="discount_type" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                    <option value="percentage">Percentage Off</option>
                    <option value="fixed">Fixed Amount Off</option>
                </select>
            </div>
            
            <div>
                <label for="discount_value" class="block text-sm font-medium text-gray-700 mb-2">Discount Value</label>
                <div class="relative">
                    <input type="number" name="discount_value" id="discount_value" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Enter value">
                    <span class="absolute right-3 top-2 text-gray-500" id="discount-symbol">%</span>
                </div>
            </div>
        </div>

        <!-- Validity Period -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Validity Period</label>
            <div class="space-y-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="validity" value="limited" class="text-pink-500 focus:ring-pink-500">
                    <span class="ml-2">Limited Time</span>
                </label>
                <br>
                <label class="inline-flex items-center">
                    <input type="radio" name="validity" value="ongoing" class="text-pink-500 focus:ring-pink-500">
                    <span class="ml-2">Ongoing</span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label for="start_date" class="block text-sm text-gray-600">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm text-gray-600">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- Usage Limits -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Usage Limits</label>
            <div class="space-y-4">
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="limit_per_customer" class="text-pink-500 focus:ring-pink-500">
                        <span class="ml-2">Limit uses per customer</span>
                    </label>
                    <input type="number" name="uses_per_customer" class="mt-2 w-full md:w-1/4 rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Number of uses">
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="limit_total" class="text-pink-500 focus:ring-pink-500">
                        <span class="ml-2">Limit total uses</span>
                    </label>
                    <input type="number" name="total_uses" class="mt-2 w-full md:w-1/4 rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500" placeholder="Total uses">
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.marketing.promotions') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition-colors duration-200">Create Promotion</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const discountType = document.getElementById('discount_type');
    const discountSymbol = document.getElementById('discount-symbol');

    discountType.addEventListener('change', function() {
        discountSymbol.textContent = this.value === 'percentage' ? '%' : '$';
    });
</script>
@endpush
@endsection
