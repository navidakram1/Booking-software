<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with('category')->where('is_active', true);

        // Apply category filter
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Apply search filter
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Apply price filter
        if ($request->has('price')) {
            switch ($request->price) {
                case 'low':
                    $query->where('price', '<', 50);
                    break;
                case 'medium':
                    $query->whereBetween('price', [50, 100]);
                    break;
                case 'high':
                    $query->where('price', '>', 100);
                    break;
            }
        }

        // Apply duration filter
        if ($request->has('duration')) {
            switch ($request->duration) {
                case 'short':
                    $query->where('duration', '<', 60);
                    break;
                case 'medium':
                    $query->whereBetween('duration', [60, 120]);
                    break;
                case 'long':
                    $query->where('duration', '>', 120);
                    break;
            }
        }

        $services = $query->latest()->paginate(9);
        $categories = Category::where('is_active', true)->get();

        return view('services', compact('services', 'categories'));
    }

    public function show(Service $service)
    {
        if (!$service->is_active) {
            abort(404);
        }
        
        return view('services.show', compact('service'));
    }
}
