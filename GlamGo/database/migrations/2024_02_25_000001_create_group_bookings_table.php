<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('group_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('number_of_people');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->dateTime('booking_date');
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_bookings');
    }
};
