<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecialistSeeder extends Seeder
{
    public function run(): void
    {
        $specialists = [
            [
                'name' => 'Sarah Johnson',
                'title' => 'Senior Hair Stylist',
                'bio' => 'Experienced hair stylist specializing in modern cuts and coloring techniques',
                'is_active' => true,
            ],
            [
                'name' => 'Emily Chen',
                'title' => 'Nail Art Specialist',
                'bio' => 'Creative nail artist with expertise in intricate designs and nail health',
                'is_active' => true,
            ],
            [
                'name' => 'Maria Rodriguez',
                'title' => 'Skincare Expert',
                'bio' => 'Licensed esthetician with advanced training in facial treatments',
                'is_active' => true,
            ],
            [
                'name' => 'David Kim',
                'title' => 'Massage Therapist',
                'bio' => 'Certified massage therapist specializing in therapeutic and relaxation techniques',
                'is_active' => true,
            ],
        ];

        foreach ($specialists as $specialist) {
            Specialist::create([
                'name' => $specialist['name'],
                'slug' => Str::slug($specialist['name']),
                'title' => $specialist['title'],
                'bio' => $specialist['bio'],
                'is_active' => $specialist['is_active'],
            ]);
        }
    }
} 