<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        // Sample services data - later this will come from database
        $services = [
            [
                'id' => 1,
                'name' => 'Haircut & Styling',
                'description' => 'Professional haircut and styling services for all hair types',
                'duration' => '60',
                'price' => '50.00',
                'image' => 'images/services/haircut.jpg'
            ],
            [
                'id' => 2,
                'name' => 'Hair Coloring',
                'description' => 'Full hair coloring services including highlights and balayage',
                'duration' => '120',
                'price' => '120.00',
                'image' => 'images/services/coloring.jpg'
            ],
            [
                'id' => 3,
                'name' => 'Facial Treatment',
                'description' => 'Rejuvenating facial treatments for all skin types',
                'duration' => '45',
                'price' => '75.00',
                'image' => 'images/services/facial.jpg'
            ],
            [
                'id' => 4,
                'name' => 'Manicure & Pedicure',
                'description' => 'Luxurious nail care services for hands and feet',
                'duration' => '90',
                'price' => '65.00',
                'image' => 'images/services/nails.jpg'
            ]
        ];

        return view('services', compact('services'));
    }
}
