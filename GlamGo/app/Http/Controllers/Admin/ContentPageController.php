<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentPageController extends Controller
{
    public function index()
    {
        $pages = ContentPage::latest()->paginate(10);
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
            'content' => 'required|string',
            'slug' => 'nullable|string|max:255|unique:content_pages',
            'meta_description' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        ContentPage::create($validated);

        return redirect()
            ->route('admin.content.pages.index')
            ->with('success', 'Page created successfully.');
    }

    public function edit(ContentPage $page)
    {
        return view('admin.content.pages.edit', compact('page'));
    }

    public function update(Request $request, ContentPage $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'nullable|string|max:255|unique:content_pages,slug,' . $page->id,
            'meta_description' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $page->update($validated);

        return redirect()
            ->route('admin.content.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(ContentPage $page)
    {
        $page->delete();

        return redirect()
            ->route('admin.content.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
} 