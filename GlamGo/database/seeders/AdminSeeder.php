<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@glamgo.com',
            'password' => Hash::make('Admin@123'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);
    }
}
