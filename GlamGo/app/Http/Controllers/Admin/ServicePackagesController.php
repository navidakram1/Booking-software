<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicePackagesController extends Controller
{
    public function index()
    {
        return view('admin.service-packages.index');
    }

    public function create()
    {
        return view('admin.service-packages.create');
    }

    public function store(Request $request)
    {
        // Store new package
    }

    public function edit($id)
    {
        return view('admin.service-packages.edit');
    }

    public function update(Request $request, $id)
    {
        // Update package
    }

    public function destroy($id)
    {
        // Delete package
    }

    public function toggleStatus($id)
    {
        // Toggle package availability
    }

    public function updateServices(Request $request, $id)
    {
        // Update services in package
    }
}
