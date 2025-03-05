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
                'title' => 'Latest Hair Trends for 2025',
                'excerpt' => 'Discover the hottest hair trends that are taking the beauty world by storm this year.',
                'image' => 'https://images.unsplash.com/photo-1605497788044-5a32c7078486?ixlib=rb-4.0.3',
                'date' => '2025-02-20',
                'category' => 'Hair',
                'author' => 'Sarah Johnson'
            ],
            [
                'id' => 2,
                'title' => 'The Ultimate Guide to Skin Care',
                'excerpt' => 'Learn the essential steps for maintaining healthy, glowing skin all year round.',
                'image' => 'https://images.unsplash.com/photo-1598440947619-2c35fc9aa908?ixlib=rb-4.0.3',
                'date' => '2025-02-15',
                'category' => 'Skincare',
                'author' => 'Emily Davis'
            ],
            [
                'id' => 3,
                'title' => 'Benefits of Regular Massage Therapy',
                'excerpt' => 'Explore how regular massage sessions can improve your physical and mental well-being.',
                'image' => 'https://images.unsplash.com/photo-1600334089648-b0d9d3028eb2?ixlib=rb-4.0.3',
                'date' => '2025-02-10',
                'category' => 'Wellness',
                'author' => 'Michael Chen'
            ],
            [
                'id' => 4,
                'title' => 'Nail Art Inspirations',
                'excerpt' => 'Get inspired by these creative and trendy nail art designs for any occasion.',
                'image' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?ixlib=rb-4.0.3',
                'date' => '2025-02-05',
                'category' => 'Nails',
                'author' => 'Lisa Anderson'
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
