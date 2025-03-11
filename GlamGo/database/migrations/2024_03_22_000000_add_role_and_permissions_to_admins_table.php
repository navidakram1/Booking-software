<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            if (!Schema::hasColumn('admins', 'role')) {
                $table->string('role')->default('admin')->after('email');
            }
            if (!Schema::hasColumn('admins', 'permissions')) {
                $table->json('permissions')->nullable()->after('role');
            }
            if (!Schema::hasColumn('admins', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable();
            }
            if (!Schema::hasColumn('admins', 'last_login_ip')) {
                $table->string('last_login_ip', 45)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['role', 'permissions', 'last_login_at', 'last_login_ip']);
        });
    }
}; 