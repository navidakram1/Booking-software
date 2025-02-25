<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = [
            [
                'id' => 1,
                'title' => '2025 Hair Trends You Need to Know',
                'slug' => '2025-hair-trends',
                'excerpt' => 'Discover the hottest hair trends that will dominate 2025...',
                'image' => 'images/blog/hair-trends.jpg',
                'category' => 'Hair',
                'author' => 'Sarah Johnson',
                'date' => '2025-02-20',
                'read_time' => '5 min'
            ],
            [
                'id' => 2,
                'title' => 'Skincare Secrets for Glowing Skin',
                'slug' => 'skincare-secrets',
                'excerpt' => 'Expert tips for maintaining healthy, glowing skin...',
                'image' => 'images/blog/skincare.jpg',
                'category' => 'Skincare',
                'author' => 'Emily Davis',
                'date' => '2025-02-18',
                'read_time' => '4 min'
            ],
            [
                'id' => 3,
                'title' => 'Bridal Beauty Guide',
                'slug' => 'bridal-beauty-guide',
                'excerpt' => 'Complete guide to looking your best on your special day...',
                'image' => 'images/blog/bridal.jpg',
                'category' => 'Bridal',
                'author' => 'Michael Chen',
                'date' => '2025-02-15',
                'read_time' => '7 min'
            ]
        ];

        return view('blog', compact('posts'));
    }

    public function show($slug)
    {
        // In a real application, we would fetch the post from database
        // For now, return a 404 if post not found
        return view('blog.show');
    }
}
