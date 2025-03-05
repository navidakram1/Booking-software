<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $serviceId = $request->query('service_id');
        
        $specialists = Specialist::query()
            ->when($serviceId, function ($query) use ($serviceId) {
                $query->whereHas('services', function ($q) use ($serviceId) {
                    $q->where('services.id', $serviceId);
                });
            })
            ->with(['reviews' => function ($query) {
                $query->latest()->limit(5);
            }])
            ->active()
            ->get()
            ->map(function ($specialist) {
                return [
                    'id' => $specialist->id,
                    'name' => $specialist->name,
                    'title' => $specialist->title,
                    'avatar' => $specialist->avatar_url,
                    'rating' => $specialist->average_rating,
                    'reviews_count' => $specialist->reviews_count,
                    'bio' => $specialist->bio
                ];
            });

        return response()->json($specialists);
    }
} 