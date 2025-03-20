<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;
use App\Models\ServiceCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceCollection;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = 'services_' . md5(json_encode($request->all()));
        
        return Cache::remember($cacheKey, now()->addHours(1), function () use ($request) {
            $query = Service::query();

            // Apply filters
            if ($request->has('category')) {
                $query->where('category', $request->category);
            }

            if ($request->has('price_range')) {
                [$min, $max] = explode('-', $request->price_range);
                $query->whereBetween('price', [$min, $max]);
            }

            if ($request->has('rating')) {
                $query->where('rating', '>=', $request->rating);
            }

            // Apply search
            if ($request->has('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', "%{$request->search}%")
                      ->orWhere('description', 'like', "%{$request->search}%");
                });
            }

            // Eager load relationships
            $query->with(['specialists' => function ($q) {
                $q->select('id', 'name', 'image_url', 'rating')
                  ->where('is_active', true);
            }]);

            // Apply sorting
            $sortField = $request->get('sort_by', 'created_at');
            $sortDirection = $request->get('sort_direction', 'desc');
            $query->orderBy($sortField, $sortDirection);

            $perPage = $request->get('per_page', 12);
            $services = $query->paginate($perPage);

            return new ServiceCollection($services);
        });
    }

    public function show(Service $service)
    {
        $cacheKey = 'service_' . $service->id;
        
        return Cache::remember($cacheKey, now()->addHours(1), function () use ($service) {
            $service->load([
                'specialists' => function ($query) {
                    $query->select('id', 'name', 'image_url', 'rating', 'specialization')
                          ->where('is_active', true);
                },
                'reviews' => function ($query) {
                    $query->latest()
                          ->take(5)
                          ->with('user:id,name,avatar');
                }
            ]);

            return new ServiceResource($service);
        });
    }

    public function featured()
    {
        return Cache::remember('featured_services', now()->addHours(6), function () {
            $services = Service::where('is_featured', true)
                ->with(['specialists' => function ($query) {
                    $query->select('id', 'name', 'image_url', 'rating')
                          ->where('is_active', true);
                }])
                ->take(6)
                ->get();

            return new ServiceCollection($services);
        });
    }

    public function popular()
    {
        return Cache::remember('popular_services', now()->addHours(6), function () {
            $services = Service::orderBy('booking_count', 'desc')
                ->with(['specialists' => function ($query) {
                    $query->select('id', 'name', 'image_url', 'rating')
                          ->where('is_active', true);
                }])
                ->take(6)
                ->get();

            return new ServiceCollection($services);
        });
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $cacheKey = 'service_search_' . md5($query);

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($query) {
            $services = Service::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->orWhere('category', 'like', "%{$query}%")
                ->with(['specialists' => function ($q) {
                    $q->select('id', 'name', 'image_url', 'rating')
                      ->where('is_active', true);
                }])
                ->take(10)
                ->get();

            return new ServiceCollection($services);
        });
    }

    public function clearCache()
    {
        Cache::tags(['services'])->flush();
        return response()->json(['message' => 'Service cache cleared successfully']);
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
