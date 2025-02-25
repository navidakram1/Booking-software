<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Waitlist;
use App\Models\Service;
use Illuminate\Http\Request;

class WaitlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = Waitlist::with(['service'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.waitlist.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.waitlist.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        Waitlist::create($validated);

        return redirect()
            ->route('admin.waitlist.index')
            ->with('success', 'Customer added to waitlist successfully.');
    }

    /**
     * Record a contact attempt for the waitlist entry.
     */
    public function recordContactAttempt(Waitlist $waitlist)
    {
        $waitlist->increment('contact_attempts');
        $waitlist->status = 'contacted';
        $waitlist->save();

        return back()->with('success', 'Contact attempt recorded successfully.');
    }

    /**
     * Update the status of a waitlist entry.
     */
    public function updateStatus(Request $request, Waitlist $waitlist)
    {
        $validated = $request->validate([
            'status' => 'required|in:waiting,contacted,scheduled,cancelled'
        ]);

        $waitlist->update($validated);

        return back()->with('success', 'Status updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Waitlist $waitlist)
    {
        return view('admin.waitlist.show', compact('waitlist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Waitlist $waitlist)
    {
        $services = Service::all();
        return view('admin.waitlist.edit', compact('waitlist', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Waitlist $waitlist)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'status' => 'required|in:waiting,contacted,scheduled,cancelled',
            'notes' => 'nullable|string',
        ]);

        $waitlist->update($validated);

        return redirect()
            ->route('admin.waitlist.index')
            ->with('success', 'Waitlist entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Waitlist $waitlist)
    {
        $waitlist->delete();

        return redirect()
            ->route('admin.waitlist.index')
            ->with('success', 'Waitlist entry deleted successfully.');
    }
}
