<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;
use App\Models\ServiceCategory;
use Illuminate\Http\JsonResponse;

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

    public function categories(): JsonResponse
    {
        $categories = ServiceCategory::with(['services' => function ($query) {
            $query->active()->orderBy('name');
        }])->get();

        return response()->json($categories);
    }
}
