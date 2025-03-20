<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        // Create admin in users table
        User::create([
            'name' => 'Admin',
            'email' => 'admin@glamgo.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'email_verified_at' => now()
        ]);

        // Create admin in admins table
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@glamgo.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);
    }
}
