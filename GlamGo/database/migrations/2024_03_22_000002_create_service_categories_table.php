<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->string('color_code', 7)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('slug');
            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_categories');
    }
}; 