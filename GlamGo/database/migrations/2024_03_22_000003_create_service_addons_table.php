<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_addons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('duration')->comment('Duration in minutes');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('service_addon_compatibility', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('addon_id')->references('id')->on('service_addons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_addon_compatibility');
        Schema::dropIfExists('service_addons');
    }
}; 