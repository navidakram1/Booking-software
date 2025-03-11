<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\LandingPageSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\SalonSeeder;
use Database\Seeders\DashboardDemoSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\ServiceCategorySeeder;
use Database\Seeders\SpecialistSeeder;
use Database\Seeders\TestimonialSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            DashboardDemoSeeder::class,
            ServiceCategorySeeder::class,
            ServiceSeeder::class,
            SpecialistSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
