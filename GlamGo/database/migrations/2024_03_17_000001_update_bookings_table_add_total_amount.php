<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'total_amount')) {
                $table->decimal('total_amount', 10, 2)->default(0.00)->after('status');
            }
            if (!Schema::hasColumn('bookings', 'scheduled_at')) {
                $table->timestamp('scheduled_at')->nullable()->after('total_amount');
            }
            if (!Schema::hasColumn('bookings', 'duration')) {
                $table->integer('duration')->default(60)->after('scheduled_at');
            }
            // Ensure status column exists and has the correct type
            if (!Schema::hasColumn('bookings', 'status')) {
                $table->string('status')->default('pending')->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'scheduled_at', 'duration']);
        });
    }
}; 