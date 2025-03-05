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
                'name' => 'Hair Services',
                'description' => 'Professional hair care and styling services',
                'is_active' => true,
            ],
            [
                'name' => 'Nail Services',
                'description' => 'Manicure, pedicure and nail art services',
                'is_active' => true,
            ],
            [
                'name' => 'Facial Treatments',
                'description' => 'Skincare and facial treatment services',
                'is_active' => true,
            ],
            [
                'name' => 'Massage',
                'description' => 'Relaxing and therapeutic massage services',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => $category['is_active'],
            ]);
        }
    }
}
