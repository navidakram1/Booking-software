<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaitlistController extends Controller
{
    public function index()
    {
        return view('admin.waitlist.index');
    }

    public function store(Request $request)
    {
        // Validate and store waitlist entry
    }

    public function update(Request $request, $id)
    {
        // Update waitlist entry status
    }

    public function destroy($id)
    {
        // Remove from waitlist
    }

    public function convert($id)
    {
        // Convert waitlist entry to actual booking
        return view('admin.waitlist.convert');
    }
}
