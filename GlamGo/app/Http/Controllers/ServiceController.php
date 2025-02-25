<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with('category');

        // Search filter
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->has('category') && $request->get('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->get('category'));
            });
        }

        // Price filter
        if ($request->has('price')) {
            switch ($request->get('price')) {
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

        // Duration filter
        if ($request->has('duration')) {
            switch ($request->get('duration')) {
                case 'short':
                    $query->where('duration', '<=', 30);
                    break;
                case 'medium':
                    $query->whereBetween('duration', [31, 60]);
                    break;
                case 'long':
                    $query->where('duration', '>', 60);
                    break;
            }
        }

        $services = $query->orderBy('created_at', 'desc')->paginate(9);
        $categories = Category::all();
        
        if ($request->ajax()) {
            return view('components.services-grid', compact('services'));
        }
        
        return view('services', compact('services', 'categories'));
    }

    public function show($id)
    {
        $service = Service::with('category')->findOrFail($id);
        return view('services.show', compact('service'));
    }
}
