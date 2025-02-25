<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Http\Request;

class ServicePackageController extends Controller
{
    /**
     * Display a listing of service packages.
     */
    public function index()
    {
        $packages = ServicePackage::with(['services'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $services = Service::all();
        
        return view('admin.services.packages.index', compact('packages', 'services'));
    }

    /**
     * Store a newly created service package.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
            'is_active' => 'boolean',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'validity_days' => 'nullable|integer|min:1',
        ]);

        $package = ServicePackage::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'is_active' => $request->boolean('is_active', true),
            'discount_percentage' => $validated['discount_percentage'],
            'validity_days' => $validated['validity_days'],
        ]);

        $package->services()->attach($validated['services']);

        return redirect()
            ->route('admin.services.packages.index')
            ->with('success', 'Service package created successfully.');
    }

    /**
     * Update the specified service package.
     */
    public function update(Request $request, ServicePackage $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
            'is_active' => 'boolean',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'validity_days' => 'nullable|integer|min:1',
        ]);

        $package->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'is_active' => $request->boolean('is_active', true),
            'discount_percentage' => $validated['discount_percentage'],
            'validity_days' => $validated['validity_days'],
        ]);

        $package->services()->sync($validated['services']);

        return redirect()
            ->route('admin.services.packages.index')
            ->with('success', 'Service package updated successfully.');
    }

    /**
     * Remove the specified service package.
     */
    public function destroy(ServicePackage $package)
    {
        $package->services()->detach();
        $package->delete();

        return redirect()
            ->route('admin.services.packages.index')
            ->with('success', 'Service package deleted successfully.');
    }

    /**
     * Toggle the active status of a service package.
     */
    public function toggleStatus(ServicePackage $package)
    {
        $package->is_active = !$package->is_active;
        $package->save();

        return back()->with('success', 'Package status updated successfully.');
    }
}
