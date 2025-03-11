<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\DashboardDemoSeeder;
use Database\Seeders\TestimonialSeeder;
use Database\Seeders\BookingRulesSeeder;
use Illuminate\Database\Seeder;

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
            TestimonialSeeder::class,
            BookingRulesSeeder::class,
        ]);
    }
}
