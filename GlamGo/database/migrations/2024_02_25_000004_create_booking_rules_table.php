<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('booking_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rule_type');
            $table->string('value');
            $table->string('description');
            $table->boolean('is_active')->default(true);
            $table->string('applies_to');
            $table->integer('priority')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_rules');
    }
};
