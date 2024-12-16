<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupBooking;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GroupBookingController extends Controller
{
    public function index()
    {
        $groupBookings = GroupBooking::with(['service', 'staff'])->latest()->paginate(10);
        return view('admin.group-bookings.index', compact('groupBookings'));
    }

    public function create()
    {
        $services = Service::all();
        $staff = Staff::all();
        return view('admin.group-bookings.create', compact('services', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date',
            'time' => 'required',
            'group_size' => 'required|integer|min:2',
            'group_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $groupBooking = GroupBooking::create([
            'service_id' => $validated['service_id'],
            'staff_id' => $validated['staff_id'],
            'booking_datetime' => Carbon::parse($validated['date'] . ' ' . $validated['time']),
            'group_size' => $validated['group_size'],
            'group_name' => $validated['group_name'],
            'contact_name' => $validated['contact_name'],
            'contact_email' => $validated['contact_email'],
            'contact_phone' => $validated['contact_phone'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending'
        ]);

        return redirect()->route('admin.group-bookings.index')
            ->with('success', 'Group booking created successfully.');
    }

    public function edit(GroupBooking $groupBooking)
    {
        $services = Service::all();
        $staff = Staff::all();
        return view('admin.group-bookings.edit', compact('groupBooking', 'services', 'staff'));
    }

    public function update(Request $request, GroupBooking $groupBooking)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date',
            'time' => 'required',
            'group_size' => 'required|integer|min:2',
            'group_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $groupBooking->update([
            'service_id' => $validated['service_id'],
            'staff_id' => $validated['staff_id'],
            'booking_datetime' => Carbon::parse($validated['date'] . ' ' . $validated['time']),
            'group_size' => $validated['group_size'],
            'group_name' => $validated['group_name'],
            'contact_name' => $validated['contact_name'],
            'contact_email' => $validated['contact_email'],
            'contact_phone' => $validated['contact_phone'],
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status']
        ]);

        return redirect()->route('admin.group-bookings.index')
            ->with('success', 'Group booking updated successfully.');
    }

    public function destroy(GroupBooking $groupBooking)
    {
        $groupBooking->delete();
        return redirect()->route('admin.group-bookings.index')
            ->with('success', 'Group booking deleted successfully.');
    }
}
