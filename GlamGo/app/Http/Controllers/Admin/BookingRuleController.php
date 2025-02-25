<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingRule;
use Illuminate\Http\Request;

class BookingRuleController extends Controller
{
    /**
     * Display a listing of booking rules.
     */
    public function index()
    {
        $rules = BookingRule::latest()->paginate(10);
        return view('admin.booking-rules.index', compact('rules'));
    }

    /**
     * Show the form for creating a new booking rule.
     */
    public function create()
    {
        return view('admin.booking-rules.create');
    }

    /**
     * Store a newly created booking rule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'conditions' => 'required|array',
            'actions' => 'required|array',
            'priority' => 'required|integer',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ]);

        BookingRule::create($validated);

        return redirect()->route('admin.booking-rules.index')
            ->with('success', 'Booking rule created successfully.');
    }

    /**
     * Show the form for editing the specified booking rule.
     */
    public function edit(BookingRule $rule)
    {
        return view('admin.booking-rules.edit', compact('rule'));
    }

    /**
     * Update the specified booking rule.
     */
    public function update(Request $request, BookingRule $rule)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'conditions' => 'required|array',
            'actions' => 'required|array',
            'priority' => 'required|integer',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ]);

        $rule->update($validated);

        return redirect()->route('admin.booking-rules.index')
            ->with('success', 'Booking rule updated successfully.');
    }

    /**
     * Remove the specified booking rule.
     */
    public function destroy(BookingRule $rule)
    {
        $rule->delete();

        return redirect()->route('admin.booking-rules.index')
            ->with('success', 'Booking rule deleted successfully.');
    }
}
