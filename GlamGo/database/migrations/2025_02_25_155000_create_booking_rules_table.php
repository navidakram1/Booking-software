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
        Schema::create('booking_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('type', ['time_slot', 'capacity', 'interval', 'blackout']);
            $table->json('days');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_bookings')->nullable();
            $table->integer('interval_minutes')->nullable();
            $table->integer('priority')->default(1);
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_rules');
    }
};
