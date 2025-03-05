<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupBooking;
use Illuminate\Http\Request;

class GroupBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupBookings = GroupBooking::with(['service', 'staff'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.group-bookings.index', compact('groupBookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.group-bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:100',
            'contact_name' => 'required|string|max:100',
            'contact_email' => 'required|email|max:100',
            'contact_phone' => 'required|string|max:20',
            'number_of_people' => 'required|integer|min:2',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required',
            'service_id' => 'required|exists:services,id',
            'special_requests' => 'nullable|string',
        ]);

        GroupBooking::create($validated);

        return redirect()
            ->route('admin.group-bookings.index')
            ->with('success', 'Group booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupBooking $groupBooking)
    {
        return view('admin.group-bookings.show', compact('groupBooking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupBooking $groupBooking)
    {
        return view('admin.group-bookings.edit', compact('groupBooking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupBooking $groupBooking)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:100',
            'contact_name' => 'required|string|max:100',
            'contact_email' => 'required|email|max:100',
            'contact_phone' => 'required|string|max:20',
            'number_of_people' => 'required|integer|min:2',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'service_id' => 'required|exists:services,id',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'special_requests' => 'nullable|string',
        ]);

        $groupBooking->update($validated);

        return redirect()
            ->route('admin.group-bookings.index')
            ->with('success', 'Group booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupBooking $groupBooking)
    {
        $groupBooking->delete();

        return redirect()
            ->route('admin.group-bookings.index')
            ->with('success', 'Group booking deleted successfully.');
    }
}
