<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Service;
use App\Models\Stylist;

class FavoritesController extends Controller
{
    public function index()
    {
        $favorites = [
            'services' => Favorite::where('user_id', auth()->id())
                ->where('favorable_type', Service::class)
                ->with('favorable')
                ->get(),
            'stylists' => Favorite::where('user_id', auth()->id())
                ->where('favorable_type', Stylist::class)
                ->with('favorable')
                ->get()
        ];

        return view('customer.favorites', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'favorable_type' => 'required|in:service,stylist',
            'favorable_id' => 'required|integer'
        ]);

        $type = $validated['favorable_type'] === 'service' ? Service::class : Stylist::class;
        $model = $type::findOrFail($validated['favorable_id']);

        $favorite = Favorite::where('user_id', auth()->id())
            ->where('favorable_type', $type)
            ->where('favorable_id', $model->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = ucfirst($validated['favorable_type']) . ' removed from favorites.';
        } else {
            Favorite::create([
                'user_id' => auth()->id(),
                'favorable_type' => $type,
                'favorable_id' => $model->id
            ]);
            $message = ucfirst($validated['favorable_type']) . ' added to favorites.';
        }

        return back()->with('success', $message);
    }
}
