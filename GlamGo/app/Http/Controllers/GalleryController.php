<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Define categories for gallery filtering
        $categories = [
            'Hair',
            'Nails',
            'Makeup',
            'Facial',
            'Spa',
            'Bridal'
        ];

        // For development, using dummy gallery items
        $galleryItems = [
            [
                'id' => 1,
                'category' => 'Hair',
                'image' => 'https://ui-avatars.com/api/?name=Hair+Style&background=FF69B4&color=fff',
                'title' => 'Modern Hair Styling',
                'description' => 'Professional hair styling and coloring'
            ],
            [
                'id' => 2,
                'category' => 'Nails',
                'image' => 'https://ui-avatars.com/api/?name=Nail+Art&background=FF69B4&color=fff',
                'title' => 'Creative Nail Art',
                'description' => 'Artistic nail designs and treatments'
            ],
            [
                'id' => 3,
                'category' => 'Makeup',
                'image' => 'https://ui-avatars.com/api/?name=Makeup&background=FF69B4&color=fff',
                'title' => 'Professional Makeup',
                'description' => 'Stunning makeup for all occasions'
            ],
            [
                'id' => 4,
                'category' => 'Facial',
                'image' => 'https://ui-avatars.com/api/?name=Facial&background=FF69B4&color=fff',
                'title' => 'Facial Treatment',
                'description' => 'Rejuvenating facial treatments'
            ],
            [
                'id' => 5,
                'category' => 'Spa',
                'image' => 'https://ui-avatars.com/api/?name=Spa&background=FF69B4&color=fff',
                'title' => 'Relaxing Spa',
                'description' => 'Luxurious spa experiences'
            ],
            [
                'id' => 6,
                'category' => 'Bridal',
                'image' => 'https://ui-avatars.com/api/?name=Bridal&background=FF69B4&color=fff',
                'title' => 'Bridal Beauty',
                'description' => 'Complete bridal beauty services'
            ]
        ];

        return view('gallery', compact('categories', 'galleryItems'));
    }
}
