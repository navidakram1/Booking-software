<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\GalleryItem;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::pluck('name');
        $query = GalleryItem::with('category');

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by tag if provided
        if ($request->has('tag')) {
            $query->where('tags', 'like', '%' . $request->tag . '%');
        }

        $galleryItems = $query->latest()->paginate(12);

        if ($request->ajax()) {
            return view('components.gallery-grid', compact('galleryItems'));
        }

        return view('gallery', compact('categories', 'galleryItems'));
    }

    public function show($id)
    {
        $item = GalleryItem::with('category')->findOrFail($id);
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('components.gallery-modal', compact('item'))->render()
            ]);
        }

        return view('gallery.show', compact('item'));
    }
}
