<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicePricingController extends Controller
{
    public function index()
    {
        return view('admin.service-pricing.index');
    }

    public function store(Request $request)
    {
        // Store new pricing rule
    }

    public function update(Request $request, $id)
    {
        // Update pricing rule
    }

    public function destroy($id)
    {
        // Delete pricing rule
    }

    public function toggleStatus($id)
    {
        // Toggle pricing rule status
    }

    public function bulkUpdate(Request $request)
    {
        // Update multiple prices at once
    }

    public function applyDiscount(Request $request)
    {
        // Apply discount to selected services
    }
}
