<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('admins')) {
            Schema::create('admins', function ($table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // Always ensure admin exists
        DB::table('admins')->updateOrInsert(
            ['email' => 'admin@glamgo.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@glamgo.com',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function down()
    {
        // No down migration needed
    }
}; 