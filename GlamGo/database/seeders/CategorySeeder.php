<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Hair Care',
                'description' => 'Professional hair care services including cuts, styling, and treatments',
                'icon' => 'https://cdn.lordicon.com/dqxvvqzi.json',
                'is_active' => true
            ],
            [
                'name' => 'Skin Care',
                'description' => 'Facial treatments and skin care services for all skin types',
                'icon' => 'https://cdn.lordicon.com/msetysan.json',
                'is_active' => true
            ],
            [
                'name' => 'Nail Care',
                'description' => 'Manicure, pedicure, and nail art services',
                'icon' => 'https://cdn.lordicon.com/nocovwne.json',
                'is_active' => true
            ],
            [
                'name' => 'Massage',
                'description' => 'Relaxing massage services for stress relief and wellness',
                'icon' => 'https://cdn.lordicon.com/kqnbvtqz.json',
                'is_active' => true
            ],
            [
                'name' => 'Makeup',
                'description' => 'Professional makeup services for all occasions',
                'icon' => 'https://cdn.lordicon.com/vixtkkbk.json',
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'icon' => $category['icon'],
                'is_active' => $category['is_active']
            ]);
        }
    }
}
