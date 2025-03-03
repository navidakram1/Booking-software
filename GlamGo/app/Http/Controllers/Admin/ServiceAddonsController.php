<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceAddon;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceAddonsController extends Controller
{
    public function index()
    {
        $addons = ServiceAddon::with(['services'])->get();
        $categories = ['Hair Add-ons', 'Nail Add-ons', 'Spa Add-ons', 'Makeup Add-ons'];
        return view('admin.service-addons.index', compact('addons', 'categories'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.service-addons.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'category' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $addon = ServiceAddon::create($validated);

        if ($request->has('services')) {
            $addon->services()->sync($request->services);
        }

        return redirect()
            ->route('admin.service-addons.index')
            ->with('success', 'Service add-on created successfully');
    }

    public function edit($id)
    {
        $addon = ServiceAddon::with('services')->findOrFail($id);
        $services = Service::all();
        return view('admin.service-addons.edit', compact('addon', 'services'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'category' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $addon = ServiceAddon::findOrFail($id);
        $addon->update($validated);

        if ($request->has('services')) {
            $addon->services()->sync($request->services);
        }

        return redirect()
            ->route('admin.service-addons.index')
            ->with('success', 'Service add-on updated successfully');
    }

    public function destroy($id)
    {
        $addon = ServiceAddon::findOrFail($id);
        $addon->delete();

        return redirect()
            ->route('admin.service-addons.index')
            ->with('success', 'Service add-on deleted successfully');
    }

    public function toggleStatus($id)
    {
        $addon = ServiceAddon::findOrFail($id);
        $addon->is_active = !$addon->is_active;
        $addon->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status updated successfully',
            'is_active' => $addon->is_active
        ]);
    }

    public function assignToService(Request $request, $id)
    {
        $addon = ServiceAddon::findOrFail($id);
        $addon->services()->sync($request->services);

        return response()->json([
            'status' => 'success',
            'message' => 'Services assigned successfully'
        ]);
    }
}
