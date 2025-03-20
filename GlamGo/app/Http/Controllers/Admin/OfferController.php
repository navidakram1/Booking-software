<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::latest()->paginate(10);
        return view('admin.offers.index', compact('offers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_type' => ['required', Rule::in(['percentage', 'fixed'])],
            'discount_value' => 'required|numeric|min:0',
            'valid_until' => 'required|date|after:today',
            'services' => 'sometimes|array',
            'services.*' => 'exists:services,id'
        ]);

        DB::beginTransaction();
        try {
            $offer = Offer::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'discount_type' => $validated['discount_type'],
                'discount_value' => $validated['discount_value'],
                'valid_until' => $validated['valid_until'],
                'is_active' => true
            ]);

            if (isset($validated['services'])) {
                $offer->services()->sync($validated['services']);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Offer created successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create offer'
            ], 500);
        }
    }

    public function edit(Offer $offer)
    {
        return response()->json($offer->load('services'));
    }

    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_type' => ['required', Rule::in(['percentage', 'fixed'])],
            'discount_value' => 'required|numeric|min:0',
            'valid_until' => 'required|date|after:today',
            'services' => 'sometimes|array',
            'services.*' => 'exists:services,id'
        ]);

        DB::beginTransaction();
        try {
            $offer->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'discount_type' => $validated['discount_type'],
                'discount_value' => $validated['discount_value'],
                'valid_until' => $validated['valid_until']
            ]);

            if (isset($validated['services'])) {
                $offer->services()->sync($validated['services']);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Offer updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update offer'
            ], 500);
        }
    }

    public function toggleStatus(Offer $offer)
    {
        $offer->update(['is_active' => !$offer->is_active]);
        
        return response()->json([
            'success' => true,
            'message' => 'Offer status updated successfully'
        ]);
    }

    public function destroy(Offer $offer)
    {
        try {
            $offer->delete();
            return response()->json([
                'success' => true,
                'message' => 'Offer deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete offer'
            ], 500);
        }
    }
} 
