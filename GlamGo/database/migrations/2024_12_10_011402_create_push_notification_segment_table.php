<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('push_notification_segment', function (Blueprint $table) {
            $table->foreignId('push_notification_id')->constrained()->onDelete('cascade');
            $table->foreignId('segment_id')->constrained()->onDelete('cascade');
            $table->primary(['push_notification_id', 'segment_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('push_notification_segment');
    }
};
