<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('special_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('discount_type', ['fixed', 'percentage']);
            $table->decimal('discount_value', 10, 2);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('is_active')->default(true);
            $table->integer('max_uses')->nullable();
            $table->integer('used_count')->default(0);
            $table->string('code')->unique()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['service_id', 'is_active']);
            $table->index(['start_date', 'end_date']);
            $table->index('code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('special_offers');
    }
}; 