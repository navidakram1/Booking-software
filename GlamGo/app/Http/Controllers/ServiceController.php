<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->get();
        $categories = Category::all();
        
        return view('services.index', compact('services', 'categories'));
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function getServicesByCategory($categoryId)
    {
        $services = Service::where('category_id', $categoryId)->get();
        return response()->json($services);
    }
}
