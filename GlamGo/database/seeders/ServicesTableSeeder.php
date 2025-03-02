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
        $services = [
            [
                'name' => 'Classic Hair Cut & Style',
                'description' => 'Professional haircut and styling service tailored to your preferences. Includes consultation, wash, cut, and blow-dry.',
                'price' => 65.00,
                'duration' => 60,
                'category' => 'Hair Services',
                'image_url' => 'images/services/haircut.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Full Hair Coloring',
                'description' => 'Complete hair coloring service using premium products. Includes consultation, color application, processing time, wash, and style.',
                'price' => 120.00,
                'duration' => 120,
                'category' => 'Hair Services',
                'image_url' => 'images/services/hair-color.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Bridal Makeup',
                'description' => 'Complete bridal makeup service using high-end products. Includes skin prep, full makeup application, and touch-up kit.',
                'price' => 150.00,
                'duration' => 90,
                'category' => 'Makeup',
                'image_url' => 'images/services/bridal-makeup.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Spa Manicure',
                'description' => 'Luxurious manicure service including hand massage, cuticle care, nail shaping, and polish application.',
                'price' => 45.00,
                'duration' => 45,
                'category' => 'Nail Services',
                'image_url' => 'images/services/manicure.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Deep Tissue Massage',
                'description' => 'Therapeutic massage focusing on deep layers of muscle tissue. Perfect for relieving severe tension and muscle pain.',
                'price' => 90.00,
                'duration' => 60,
                'category' => 'Spa Services',
                'image_url' => 'images/services/massage.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Facial Treatment',
                'description' => 'Customized facial treatment including cleansing, exfoliation, mask, and moisturizing. Tailored to your skin type.',
                'price' => 85.00,
                'duration' => 60,
                'category' => 'Skin Care',
                'image_url' => 'images/services/facial.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Hair Highlights',
                'description' => 'Partial or full highlights to add dimension and depth to your hair. Includes consultation and style.',
                'price' => 130.00,
                'duration' => 120,
                'category' => 'Hair Services',
                'image_url' => 'images/services/highlights.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Gel Nail Extension',
                'description' => 'Professional gel nail extension service including nail prep, application, shaping, and design.',
                'price' => 75.00,
                'duration' => 90,
                'category' => 'Nail Services',
                'image_url' => 'images/services/gel-nails.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Aromatherapy Massage',
                'description' => 'Relaxing massage using essential oils to promote physical and mental well-being.',
                'price' => 95.00,
                'duration' => 75,
                'category' => 'Spa Services',
                'image_url' => 'images/services/aromatherapy.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            $service['created_at'] = Carbon::now();
            $service['updated_at'] = Carbon::now();
            DB::table('services')->insert($service);
        }
    }
}
