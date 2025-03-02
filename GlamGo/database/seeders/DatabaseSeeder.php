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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DashboardDemoSeeder::class,
            ServicesTableSeeder::class,
        ]);
    }
}
