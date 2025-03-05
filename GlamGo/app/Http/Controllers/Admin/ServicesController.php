<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        return view('admin.services.index');
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        // Store new service
    }

    public function edit($id)
    {
        return view('admin.services.edit');
    }

    public function update(Request $request, $id)
    {
        // Update service
    }

    public function destroy($id)
    {
        // Delete service
    }

    public function toggleStatus($id)
    {
        // Toggle service availability
    }

    public function updateOrder(Request $request)
    {
        // Update service display order
    }
}
