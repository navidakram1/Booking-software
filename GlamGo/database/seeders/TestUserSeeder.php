<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@glamgo.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'is_active' => true,
            'email_verified_at' => now(),
            'is_admin' => false
        ]);
    }
} 