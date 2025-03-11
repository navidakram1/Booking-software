<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        // Check if admin exists
        $adminExists = DB::table('admins')->where('email', 'admin@glamgo.com')->exists();

        if (!$adminExists) {
            // Create default admin user
            DB::table('admins')->insert([
                'name' => 'Admin',
                'email' => 'admin@glamgo.com',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        // No need for down migration
    }
}; 