<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Jennifer Smith',
                'content' => 'Amazing service! My hair has never looked better. Sarah is truly talented and professional.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'client_name' => 'Michael Brown',
                'content' => 'The massage with David was exactly what I needed. Very professional and attentive to problem areas.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'client_name' => 'Lisa Chen',
                'content' => 'Emily did an incredible job with my nails. The designs were beautiful and lasted for weeks!',
                'rating' => 5,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'client_name' => 'Amanda Wilson',
                'content' => 'The facial treatment with Maria was so relaxing and my skin is glowing. Highly recommend!',
                'rating' => 5,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
} 