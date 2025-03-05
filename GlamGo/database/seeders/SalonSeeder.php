<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SalonSeeder extends Seeder
{
    public function run()
    {
        // Categories
        DB::table('categories')->insert([
            [
                'name' => 'Hair Care',
                'slug' => 'hair-care',
                'description' => 'All hair related services including cutting, styling, and coloring',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nail Care',
                'slug' => 'nail-care',
                'description' => 'Manicure, pedicure, and nail art services',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Facial',
                'slug' => 'facial',
                'description' => 'Facial treatments and skincare services',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Massage',
                'slug' => 'massage',
                'description' => 'Various types of massage therapies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Services
        DB::table('services')->insert([
            [
                'category_id' => 1,
                'name' => 'Haircut',
                'slug' => 'haircut',
                'description' => 'Professional haircut and styling',
                'price' => 50.00,
                'duration' => 45,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Hair Coloring',
                'slug' => 'hair-coloring',
                'description' => 'Full hair coloring service',
                'price' => 150.00,
                'duration' => 120,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Manicure',
                'slug' => 'manicure',
                'description' => 'Basic manicure service',
                'price' => 35.00,
                'duration' => 30,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Pedicure',
                'slug' => 'pedicure',
                'description' => 'Basic pedicure service',
                'price' => 45.00,
                'duration' => 45,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Staff
        DB::table('staff')->insert([
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.j@glamgo.com',
                'phone' => '555-0101',
                'specialization' => 'Hair Stylist',
                'working_hours' => json_encode([
                    'monday' => ['start' => '09:00', 'end' => '17:00'],
                    'tuesday' => ['start' => '09:00', 'end' => '17:00'],
                    'wednesday' => ['start' => '09:00', 'end' => '17:00'],
                    'thursday' => ['start' => '09:00', 'end' => '17:00'],
                    'friday' => ['start' => '09:00', 'end' => '17:00'],
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael.c@glamgo.com',
                'phone' => '555-0102',
                'specialization' => 'Massage Therapist',
                'working_hours' => json_encode([
                    'monday' => ['start' => '10:00', 'end' => '18:00'],
                    'tuesday' => ['start' => '10:00', 'end' => '18:00'],
                    'wednesday' => ['start' => '10:00', 'end' => '18:00'],
                    'thursday' => ['start' => '10:00', 'end' => '18:00'],
                    'friday' => ['start' => '10:00', 'end' => '18:00'],
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Service Staff relationships
        DB::table('service_staff')->insert([
            ['service_id' => 1, 'staff_id' => 1], // Sarah - Haircut
            ['service_id' => 2, 'staff_id' => 1], // Sarah - Hair Coloring
        ]);
    }
}
