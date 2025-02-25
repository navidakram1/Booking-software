<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::orderBy('order')->paginate(10);
        return view('admin.service-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.service-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        ServiceCategory::create($validated);

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Service category created successfully.');
    }

    public function edit(ServiceCategory $category)
    {
        return view('admin.service-categories.edit', compact('category'));
    }

    public function update(Request $request, ServiceCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Service category updated successfully.');
    }

    public function destroy(ServiceCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Service category deleted successfully.');
    }

    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'required|exists:service_categories,id'
        ]);

        foreach ($validated['categories'] as $index => $id) {
            ServiceCategory::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }
}
