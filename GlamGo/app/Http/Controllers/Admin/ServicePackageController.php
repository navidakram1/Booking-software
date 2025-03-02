<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePackage;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicePackageController extends Controller
{
    /**
     * Display a listing of service packages.
     */
    public function index()
    {
        $packages = ServicePackage::with('services')->latest()->paginate(10);
        return view('admin.service-packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new service package.
     */
    public function create()
    {
        $services = Service::active()->get();
        return view('admin.service-packages.create', compact('services'));
    }

    /**
     * Store a newly created service package.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
            'is_active' => 'boolean',
            'image_url' => 'nullable|string'
        ]);

        $package = ServicePackage::create($validated);
        $package->services()->attach($request->services);

        return redirect()->route('admin.service-packages.index')
            ->with('success', 'Service package created successfully.');
    }

    /**
     * Show the form for editing the specified service package.
     */
    public function edit(ServicePackage $package)
    {
        $services = Service::active()->get();
        return view('admin.service-packages.edit', compact('package', 'services'));
    }

    /**
     * Update the specified service package.
     */
    public function update(Request $request, ServicePackage $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
            'is_active' => 'boolean',
            'image_url' => 'nullable|string'
        ]);

        $package->update($validated);
        $package->services()->sync($request->services);

        return redirect()->route('admin.service-packages.index')
            ->with('success', 'Service package updated successfully.');
    }

    /**
     * Remove the specified service package.
     */
    public function destroy(ServicePackage $package)
    {
        $package->services()->detach();
        $package->delete();

        return redirect()->route('admin.service-packages.index')
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
