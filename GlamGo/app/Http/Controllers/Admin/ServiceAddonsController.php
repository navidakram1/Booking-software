<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceAddonsController extends Controller
{
    public function index()
    {
        return view('admin.service-addons.index');
    }

    public function create()
    {
        return view('admin.service-addons.create');
    }

    public function store(Request $request)
    {
        // Store new addon
    }

    public function edit($id)
    {
        return view('admin.service-addons.edit');
    }

    public function update(Request $request, $id)
    {
        // Update addon
    }

    public function destroy($id)
    {
        // Delete addon
    }

    public function toggleStatus($id)
    {
        // Toggle addon availability
    }

    public function assignToService(Request $request, $id)
    {
        // Assign addon to specific services
    }
}
