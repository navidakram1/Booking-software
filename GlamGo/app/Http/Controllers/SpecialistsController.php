<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistsController extends Controller
{
    public function index(Request $request)
    {
        $query = Specialist::query()->where('is_active', true);

        // Apply search filter
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('specialization', 'like', "%{$search}%")
                  ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        // Apply specialization filter
        if ($request->has('specialization')) {
            $query->where('specialization', $request->specialization);
        }

        // Apply rating filter
        if ($request->has('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        $specialists = $query->with(['services', 'reviews'])
                           ->withCount('reviews')
                           ->orderBy('rating', 'desc')
                           ->paginate(8);

        $specializations = Specialist::distinct('specialization')
                                   ->pluck('specialization');

        return view('specialists.index', compact('specialists', 'specializations'));
    }

    public function show(Specialist $specialist)
    {
        if (!$specialist->is_active) {
            abort(404);
        }

        $specialist->load([
            'services',
            'reviews' => function($query) {
                $query->latest()->with('user')->take(5);
            }
        ]);

        return view('specialists.show', compact('specialist'));
    }

    public function filter(Request $request)
    {
        $query = Specialist::query()->where('is_active', true);

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('specialization', 'like', "%{$search}%")
                  ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        // Apply specialization filter
        if ($request->filled('specialization')) {
            $query->where('specialization', $request->specialization);
        }

        // Apply rating filter
        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        // Apply service filter
        if ($request->filled('service')) {
            $query->whereHas('services', function($q) use ($request) {
                $q->where('services.id', $request->service);
            });
        }

        $specialists = $query->with(['services', 'reviews'])
                           ->withCount('reviews')
                           ->orderBy('rating', 'desc')
                           ->paginate(8);

        return view('components.specialists-grid', compact('specialists'))->render();
    }
}
