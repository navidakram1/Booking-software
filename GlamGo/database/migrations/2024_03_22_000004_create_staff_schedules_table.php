<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('staff_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('day_of_week'); // 0 = Sunday, 6 = Saturday
            $table->time('start_time');
            $table->time('end_time');
            $table->json('break_times')->nullable();
            $table->boolean('is_working_day')->default(true);
            $table->timestamps();
        });

        Schema::create('staff_time_off', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('reason');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });

        Schema::create('staff_performance_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('bookings_completed')->default(0);
            $table->decimal('revenue_generated', 10, 2)->default(0);
            $table->decimal('average_rating', 3, 2)->nullable();
            $table->integer('customer_satisfaction_score')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_performance_metrics');
        Schema::dropIfExists('staff_time_off');
        Schema::dropIfExists('staff_schedules');
    }
}; 