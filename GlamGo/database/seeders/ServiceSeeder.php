<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $hairCategory = Category::where('name', 'Hair Services')->first();
        $nailCategory = Category::where('name', 'Nail Services')->first();
        $facialCategory = Category::where('name', 'Facial Treatments')->first();
        $massageCategory = Category::where('name', 'Massage')->first();

        $services = [
            // Hair Services
            [
                'category_id' => $hairCategory->id,
                'name' => 'Haircut & Styling',
                'description' => 'Professional haircut and styling service customized to your preferences',
                'duration' => 60,
                'price' => 50.00,
                'is_active' => true,
            ],
            [
                'category_id' => $hairCategory->id,
                'name' => 'Hair Coloring',
                'description' => 'Full hair coloring service with premium products',
                'duration' => 120,
                'price' => 100.00,
                'is_active' => true,
            ],
            // Nail Services
            [
                'category_id' => $nailCategory->id,
                'name' => 'Classic Manicure',
                'description' => 'Basic nail care and polish application',
                'duration' => 45,
                'price' => 35.00,
                'is_active' => true,
            ],
            [
                'category_id' => $nailCategory->id,
                'name' => 'Deluxe Pedicure',
                'description' => 'Luxurious foot care treatment with massage',
                'duration' => 60,
                'price' => 45.00,
                'is_active' => true,
            ],
            // Facial Treatments
            [
                'category_id' => $facialCategory->id,
                'name' => 'Deep Cleansing Facial',
                'description' => 'Thorough facial cleansing and treatment',
                'duration' => 60,
                'price' => 75.00,
                'is_active' => true,
            ],
            [
                'category_id' => $facialCategory->id,
                'name' => 'Anti-Aging Facial',
                'description' => 'Premium facial treatment targeting signs of aging',
                'duration' => 75,
                'price' => 90.00,
                'is_active' => true,
            ],
            // Massage Services
            [
                'category_id' => $massageCategory->id,
                'name' => 'Swedish Massage',
                'description' => 'Relaxing full body massage',
                'duration' => 60,
                'price' => 80.00,
                'is_active' => true,
            ],
            [
                'category_id' => $massageCategory->id,
                'name' => 'Deep Tissue Massage',
                'description' => 'Therapeutic massage targeting deep muscle tension',
                'duration' => 60,
                'price' => 90.00,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create([
                'category_id' => $service['category_id'],
                'name' => $service['name'],
                'slug' => Str::slug($service['name']),
                'description' => $service['description'],
                'duration' => $service['duration'],
                'price' => $service['price'],
                'is_active' => $service['is_active'],
            ]);
        }
    }
}

