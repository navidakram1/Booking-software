<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index()
    {
        // Dummy data for reviews
        $reviews = [
            [
                'id' => 1,
                'service' => [
                    'name' => 'Haircut & Styling',
                    'image' => 'https://ui-avatars.com/api/?name=Hair+Cut&background=FF69B4&color=fff'
                ],
                'stylist' => [
                    'name' => 'Sarah Johnson'
                ],
                'rating' => 5,
                'comment' => 'Amazing service! Sarah really understood what I wanted and delivered perfectly. My hair looks fantastic!',
                'created_at' => now()->subDays(2)
            ],
            [
                'id' => 2,
                'service' => [
                    'name' => 'Manicure',
                    'image' => 'https://ui-avatars.com/api/?name=Manicure&background=FF69B4&color=fff'
                ],
                'stylist' => [
                    'name' => 'Emma Davis'
                ],
                'rating' => 4,
                'comment' => 'Great attention to detail. The nail art was exactly what I wanted. Will definitely come back!',
                'created_at' => now()->subWeek()
            ],
            [
                'id' => 3,
                'service' => [
                    'name' => 'Facial Treatment',
                    'image' => 'https://ui-avatars.com/api/?name=Facial&background=FF69B4&color=fff'
                ],
                'stylist' => [
                    'name' => 'Michael Smith'
                ],
                'rating' => 5,
                'comment' => 'The facial was so relaxing and my skin looks radiant! Michael\'s expertise really shows.',
                'created_at' => now()->subWeeks(2)
            ]
        ];

        // Dummy data for stats
        $stats = [
            'total_reviews' => 12,
            'average_rating' => 4.8,
            'services_reviewed' => 8,
            'stylists_reviewed' => 5
        ];

        // Dummy data for available services and stylists
        $services = [
            ['id' => 1, 'name' => 'Haircut & Styling'],
            ['id' => 2, 'name' => 'Manicure'],
            ['id' => 3, 'name' => 'Pedicure'],
            ['id' => 4, 'name' => 'Facial Treatment'],
            ['id' => 5, 'name' => 'Massage']
        ];

        $stylists = [
            ['id' => 1, 'name' => 'Sarah Johnson'],
            ['id' => 2, 'name' => 'Emma Davis'],
            ['id' => 3, 'name' => 'Michael Smith'],
            ['id' => 4, 'name' => 'Jessica Brown']
        ];

        return view('customer.reviews', compact('reviews', 'stats', 'services', 'stylists'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'service_id' => 'required|integer',
            'stylist_id' => 'required|integer',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500'
        ]);

        // In development, just return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Review submitted successfully',
            'data' => array_merge($validated, [
                'id' => rand(100, 999),
                'created_at' => now()
            ])
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500'
        ]);

        // In development, just return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Review updated successfully',
            'data' => array_merge($validated, [
                'id' => $id,
                'updated_at' => now()
            ])
        ]);
    }

    public function destroy($id)
    {
        // In development, just return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Review deleted successfully'
        ]);
    }
}
