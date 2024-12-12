<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingRulesController extends Controller
{
    public function index()
    {
        return view('admin.booking-rules.index');
    }

    public function store(Request $request)
    {
        // Store new booking rule
    }

    public function update(Request $request, $id)
    {
        // Update existing booking rule
    }

    public function destroy($id)
    {
        // Delete booking rule
    }

    public function toggleStatus($id)
    {
        // Toggle rule active status
    }
}
