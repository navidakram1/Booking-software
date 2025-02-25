<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->get();
        $categories = Category::all();
        
        return view('services', compact('services', 'categories'));
    }

    public function show($id)
    {
        $service = Service::with('category')->findOrFail($id);
        return view('services.show', compact('service'));
    }
}
