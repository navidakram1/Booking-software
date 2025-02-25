<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')
            ->where('is_active', true)
            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $services
        ]);
    }

    public function getByCategory($categoryId)
    {
        $services = Service::where('category_id', $categoryId)
            ->where('is_active', true)
            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $services
        ]);
    }

    public function categories()
    {
        $categories = Category::with('services')
            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }
}
