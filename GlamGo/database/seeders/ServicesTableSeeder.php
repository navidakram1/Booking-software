<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First create service categories
        $categories = [
            [
                'name' => 'Hair Services',
                'slug' => 'hair-services',
                'description' => 'Professional hair care services',
                'image' => 'images/categories/hair.jpg',
                'order' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Nail Services',
                'slug' => 'nail-services',
                'description' => 'Professional nail care services',
                'image' => 'images/categories/nails.jpg',
                'order' => 2,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Spa Services',
                'slug' => 'spa-services',
                'description' => 'Relaxing spa treatments',
                'image' => 'images/categories/spa.jpg',
                'order' => 3,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($categories as $category) {
            DB::table('service_categories')->insert($category);
        }

        // Then create services with proper category_id references
        $services = [
            [
                'name' => 'Classic Hair Cut & Style',
                'description' => 'Professional haircut and styling service tailored to your preferences. Includes consultation, wash, cut, and blow-dry.',
                'price' => 65.00,
                'duration' => 60,
                'category_id' => 1, // Hair Services
                'image' => 'images/services/haircut.jpg',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Hair Coloring & Highlights',
                'description' => 'Full hair coloring service with premium products. Includes consultation and style.',
                'price' => 120.00,
                'duration' => 120,
                'category_id' => 1, // Hair Services
                'image' => 'images/services/coloring.jpg',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Classic Manicure',
                'description' => 'Professional nail care service including nail shaping, cuticle care, and polish.',
                'price' => 35.00,
                'duration' => 45,
                'category_id' => 2, // Nail Services
                'image' => 'images/services/manicure.jpg',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Gel Nail Extension',
                'description' => 'Professional gel nail extension service including nail prep, application, shaping, and design.',
                'price' => 75.00,
                'duration' => 90,
                'category_id' => 2, // Nail Services
                'image' => 'images/services/gel-nails.jpg',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Aromatherapy Massage',
                'description' => 'Relaxing massage using essential oils to promote physical and mental well-being.',
                'price' => 95.00,
                'duration' => 75,
                'category_id' => 3, // Spa Services
                'image' => 'images/services/aromatherapy.jpg',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($services as $service) {
            DB::table('services')->insert($service);
        }
    }
}
