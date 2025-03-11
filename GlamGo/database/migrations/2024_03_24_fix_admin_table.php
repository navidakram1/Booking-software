<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        // Drop and recreate admins table
        Schema::dropIfExists('admins');
        
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('admin');
            $table->rememberToken();
            $table->timestamps();
        });

        // Create admin user with correct structure
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@glamgo.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}; 