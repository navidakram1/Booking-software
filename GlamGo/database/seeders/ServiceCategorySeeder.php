<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Hair Styling',
                'description' => 'Professional hair styling services',
                'is_active' => true,
            ],
            [
                'name' => 'Hair Coloring',
                'description' => 'Professional hair coloring services',
                'is_active' => true,
            ],
            [
                'name' => 'Manicure',
                'description' => 'Professional nail care services',
                'is_active' => true,
            ],
            [
                'name' => 'Pedicure',
                'description' => 'Professional foot care services',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            ServiceCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => $category['is_active'],
            ]);
        }
    }
} 