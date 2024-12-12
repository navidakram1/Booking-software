<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('push_subscribers', function (Blueprint $table) {
            $table->id();
            $table->text('endpoint');
            $table->string('auth_token');
            $table->string('public_key');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('device_type')->nullable();
            $table->timestamp('last_active_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('push_subscribers');
    }
};
