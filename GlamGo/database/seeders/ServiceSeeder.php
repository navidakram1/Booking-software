<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $hairCategoryId = Category::where('name', 'Hair Care')->first()->id;
        $skinCategoryId = Category::where('name', 'Skin Care')->first()->id;
        $nailCategoryId = Category::where('name', 'Nail Care')->first()->id;
        $massageCategoryId = Category::where('name', 'Massage')->first()->id;
        $makeupCategoryId = Category::where('name', 'Makeup')->first()->id;

        $services = [
            [
                'name' => 'Haircut & Styling',
                'description' => 'Professional haircut and styling services for all hair types',
                'duration' => 60,
                'price' => 50.00,
                'image' => 'images/services/haircut.jpg',
                'category_id' => $hairCategoryId,
                'is_active' => true
            ],
            [
                'name' => 'Hair Coloring',
                'description' => 'Full hair coloring services including highlights and balayage',
                'duration' => 120,
                'price' => 120.00,
                'image' => 'images/services/coloring.jpg',
                'category_id' => $hairCategoryId,
                'is_active' => true
            ],
            [
                'name' => 'Facial Treatment',
                'description' => 'Rejuvenating facial treatments for all skin types',
                'duration' => 45,
                'price' => 75.00,
                'image' => 'images/services/facial.jpg',
                'category_id' => $skinCategoryId,
                'is_active' => true
            ],
            [
                'name' => 'Manicure & Pedicure',
                'description' => 'Luxurious nail care services for hands and feet',
                'duration' => 90,
                'price' => 65.00,
                'image' => 'images/services/nails.jpg',
                'category_id' => $nailCategoryId,
                'is_active' => true
            ],
            [
                'name' => 'Deep Tissue Massage',
                'description' => 'Therapeutic deep tissue massage for muscle relief',
                'duration' => 60,
                'price' => 85.00,
                'image' => 'images/services/massage.jpg',
                'category_id' => $massageCategoryId,
                'is_active' => true
            ],
            [
                'name' => 'Bridal Makeup',
                'description' => 'Complete bridal makeup package for your special day',
                'duration' => 120,
                'price' => 150.00,
                'image' => 'images/services/makeup.jpg',
                'category_id' => $makeupCategoryId,
                'is_active' => true
            ]
        ];

        foreach ($services as $service) {
            Service::create([
                'name' => $service['name'],
                'slug' => Str::slug($service['name']),
                'description' => $service['description'],
                'duration' => $service['duration'],
                'price' => $service['price'],
                'image' => $service['image'],
                'category_id' => $service['category_id'],
                'is_active' => $service['is_active']
            ]);
        }
    }
}
