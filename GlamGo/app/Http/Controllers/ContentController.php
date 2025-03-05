<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function blog()
    {
        $posts = Post::latest()->paginate(10);
        return view('content.blog.index', compact('posts'));
    }

    public function createBlog()
    {
        return view('content.blog.create');
    }

    public function storeBlog(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $post = Post::create($validated);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog', 'public');
            $post->update(['image' => $path]);
        }

        return redirect()->route('admin.content.blog.index')->with('success', 'Post created successfully');
    }

    public function editBlog(Post $post)
    {
        return view('content.blog.edit', compact('post'));
    }

    public function updateBlog(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $post->update($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog', 'public');
            $post->update(['image' => $path]);
        }

        return redirect()->route('admin.content.blog.index')->with('success', 'Post updated successfully');
    }

    public function destroyBlog(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.content.blog.index')->with('success', 'Post deleted successfully');
    }

    public function gallery()
    {
        $images = Image::latest()->paginate(20);
        return view('content.gallery.index', compact('images'));
    }

    public function createGallery()
    {
        return view('content.gallery.create');
    }

    public function storeGallery(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'required|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $validated['path'] = $path;
            Image::create($validated);
        }

        return redirect()->route('admin.content.gallery.index')->with('success', 'Image uploaded successfully');
    }

    public function editGallery(Image $image)
    {
        return view('content.gallery.edit', compact('image'));
    }

    public function updateGallery(Request $request, Image $image)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048'
        ]);

        $image->update($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $image->update(['path' => $path]);
        }

        return redirect()->route('admin.content.gallery.index')->with('success', 'Image updated successfully');
    }

    public function destroyGallery(Image $image)
    {
        $image->delete();
        return redirect()->route('admin.content.gallery.index')->with('success', 'Image deleted successfully');
    }
} 