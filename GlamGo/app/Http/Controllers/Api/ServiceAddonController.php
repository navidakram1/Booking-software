<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceAddon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceAddonController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $serviceId = $request->query('service_id');
        
        $addons = ServiceAddon::query()
            ->when($serviceId, function ($query) use ($serviceId) {
                $query->where('service_id', $serviceId);
            })
            ->active()
            ->orderBy('name')
            ->get()
            ->map(function ($addon) {
                return [
                    'id' => $addon->id,
                    'name' => $addon->name,
                    'description' => $addon->description,
                    'duration' => $addon->duration,
                    'price' => $addon->price
                ];
            });

        return response()->json($addons);
    }
} 