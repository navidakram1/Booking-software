<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query()->active();

        // Apply search filter
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Apply price filter
        if ($request->filled('price')) {
            $query->priceRange($request->price);
        }

        // Apply duration filter
        if ($request->filled('duration')) {
            $query->durationRange($request->duration);
        }

        // Get categories for filter
        $categories = Service::select('category')
            ->distinct()
            ->pluck('category');

        $services = $query->latest()->paginate(9);

        return view('services', compact('services', 'categories'));
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    // API endpoint for filtering services
    public function filter(Request $request)
    {
        $query = Service::query()->active();

        // Apply filters
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('price')) {
            $query->priceRange($request->price);
        }

        if ($request->filled('duration')) {
            $query->durationRange($request->duration);
        }

        $services = $query->latest()->paginate(9);

        return view('components.services-grid', compact('services'))->render();
    }
}
