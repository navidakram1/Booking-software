<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::table('admins')
            ->where('email', 'admin@glamgo.com')
            ->update(['role' => 'admin']);
    }

    public function down()
    {
        // No down migration needed
    }
}; 