<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with(['category', 'author'])
            ->latest()
            ->paginate(10);
        
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'required_if:status,published|nullable|date'
        ]);

        try {
            if ($request->hasFile('featured_image')) {
                $path = $request->file('featured_image')->store('blog', 'public');
                $validated['featured_image'] = $path;
            }

            $validated['author_id'] = auth()->id();
            $validated['slug'] = Str::slug($validated['title']);
            $validated['tags'] = array_map('trim', explode(',', $validated['tags'] ?? ''));

            $post = BlogPost::create($validated);

            return redirect()->route('admin.blog.index')
                ->with('success', 'Blog post created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to create blog post. ' . $e->getMessage());
        }
    }

    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::all();
        return view('admin.blog.edit', compact('post', 'categories'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'required_if:status,published|nullable|date'
        ]);

        try {
            if ($request->hasFile('featured_image')) {
                // Delete old image
                if ($post->featured_image) {
                    Storage::disk('public')->delete($post->featured_image);
                }
                $path = $request->file('featured_image')->store('blog', 'public');
                $validated['featured_image'] = $path;
            }

            $validated['slug'] = Str::slug($validated['title']);
            $validated['tags'] = array_map('trim', explode(',', $validated['tags'] ?? ''));

            $post->update($validated);

            return redirect()->route('admin.blog.index')
                ->with('success', 'Blog post updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to update blog post. ' . $e->getMessage());
        }
    }

    public function destroy(BlogPost $post)
    {
        try {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $post->delete();
            return redirect()->route('admin.blog.index')
                ->with('success', 'Blog post deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete blog post.');
        }
    }

    public function toggleStatus(BlogPost $post)
    {
        $newStatus = $post->status === 'published' ? 'draft' : 'published';
        $post->update([
            'status' => $newStatus,
            'published_at' => $newStatus === 'published' ? now() : null
        ]);
        return back()->with('success', 'Blog post status updated successfully.');
    }
} 