<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupBookingController extends Controller
{
    public function index()
    {
        return view('admin.group-bookings.index');
    }

    public function create()
    {
        return view('admin.group-bookings.create');
    }

    public function store(Request $request)
    {
        // Validate and store group booking
    }

    public function show($id)
    {
        return view('admin.group-bookings.show');
    }

    public function edit($id)
    {
        return view('admin.group-bookings.edit');
    }

    public function update(Request $request, $id)
    {
        // Validate and update group booking
    }

    public function destroy($id)
    {
        // Delete group booking
    }
}
