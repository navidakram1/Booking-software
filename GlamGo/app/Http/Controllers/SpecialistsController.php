<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecialistsController extends Controller
{
    public function index()
    {
        // Sample specialists data - later this will come from database
        $specialists = [
            [
                'id' => 1,
                'name' => 'Sarah Johnson',
                'role' => 'Senior Hair Stylist',
                'experience' => '8 years',
                'specialties' => ['Haircuts', 'Coloring', 'Styling'],
                'bio' => 'Sarah is our master stylist with expertise in modern cutting techniques and color trends.',
                'image' => 'images/specialists/specialist1.jpg',
                'rating' => 4.9
            ],
            [
                'id' => 2,
                'name' => 'Michael Chen',
                'role' => 'Color Specialist',
                'experience' => '6 years',
                'specialties' => ['Balayage', 'Highlights', 'Color Correction'],
                'bio' => 'Michael specializes in creating stunning, natural-looking color transformations.',
                'image' => 'images/specialists/specialist2.jpg',
                'rating' => 4.8
            ],
            [
                'id' => 3,
                'name' => 'Emily Rodriguez',
                'role' => 'Nail Artist',
                'experience' => '5 years',
                'specialties' => ['Manicure', 'Pedicure', 'Nail Art'],
                'bio' => 'Emily is our creative nail artist known for her intricate designs and attention to detail.',
                'image' => 'images/specialists/specialist3.jpg',
                'rating' => 4.9
            ],
            [
                'id' => 4,
                'name' => 'David Kim',
                'role' => 'Skincare Expert',
                'experience' => '7 years',
                'specialties' => ['Facials', 'Skin Treatments', 'Anti-aging'],
                'bio' => 'David is passionate about helping clients achieve their best skin through customized treatments.',
                'image' => 'images/specialists/specialist4.jpg',
                'rating' => 4.7
            ]
        ];

        return view('specialists', compact('specialists'));
    }
}
