<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('bookings')) {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('service_id')->constrained();
                $table->foreignId('specialist_id')->constrained();
                $table->dateTime('start_time');
                $table->dateTime('end_time');
                $table->string('status');
                $table->string('confirmation_code')->unique();
                $table->json('customer_details');
                $table->text('notes')->nullable();
                $table->string('timezone');
                $table->decimal('total_price', 10, 2);
                $table->string('payment_status')->default('pending');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('booking_addons')) {
            Schema::create('booking_addons', function (Blueprint $table) {
                $table->id();
                $table->foreignId('booking_id')->constrained()->onDelete('cascade');
                $table->foreignId('service_addon_id')->constrained()->onDelete('cascade');
                $table->decimal('price', 10, 2);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_addons');
        Schema::dropIfExists('bookings');
    }
}; 