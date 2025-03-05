<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.content.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.content.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Page::create($validated);

        return redirect()
            ->route('admin.content.pages.index')
            ->with('success', 'Page created successfully');
    }

    public function edit(Page $page)
    {
        return view('admin.content.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $page->update($validated);

        return redirect()
            ->route('admin.content.pages.index')
            ->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json(['message' => 'Page deleted successfully']);
    }

    public function toggleStatus(Page $page)
    {
        $page->update(['is_active' => !$page->is_active]);
        return response()->json(['message' => 'Page status updated successfully']);
    }
} 