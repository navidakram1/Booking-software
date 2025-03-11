<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('revenue_analytics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('total_revenue', 10, 2);
            $table->decimal('service_revenue', 10, 2);
            $table->decimal('product_revenue', 10, 2)->default(0);
            $table->decimal('tax_collected', 10, 2);
            $table->integer('total_bookings');
            $table->integer('completed_bookings');
            $table->json('revenue_by_service')->nullable();
            $table->json('revenue_by_staff')->nullable();
            $table->timestamps();
        });

        Schema::create('booking_analytics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('total_bookings');
            $table->integer('completed_bookings');
            $table->integer('cancelled_bookings');
            $table->integer('rescheduled_bookings');
            $table->json('popular_services')->nullable();
            $table->json('popular_time_slots')->nullable();
            $table->json('booking_sources')->nullable();
            $table->decimal('average_booking_value', 10, 2);
            $table->timestamps();
        });

        Schema::create('customer_analytics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('new_customers');
            $table->integer('returning_customers');
            $table->decimal('average_customer_value', 10, 2);
            $table->json('customer_demographics')->nullable();
            $table->json('service_preferences')->nullable();
            $table->json('booking_frequency')->nullable();
            $table->decimal('customer_satisfaction_score', 3, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('export_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('report_type');
            $table->json('filters')->nullable();
            $table->string('file_format');
            $table->string('file_path');
            $table->timestamp('generated_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('export_logs');
        Schema::dropIfExists('customer_analytics');
        Schema::dropIfExists('booking_analytics');
        Schema::dropIfExists('revenue_analytics');
    }
}; 