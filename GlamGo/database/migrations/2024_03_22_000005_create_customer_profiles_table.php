<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable();
            $table->json('preferences')->nullable();
            $table->json('communication_preferences')->nullable();
            $table->integer('loyalty_points')->default(0);
            $table->string('loyalty_tier')->default('bronze');
            $table->timestamps();
        });

        Schema::create('customer_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customer_profiles')->onDelete('cascade');
            $table->morphs('historyable');
            $table->string('action');
            $table->json('details')->nullable();
            $table->timestamps();
        });

        Schema::create('loyalty_rewards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('points_required');
            $table->string('reward_type');
            $table->json('reward_details');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('loyalty_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customer_profiles')->onDelete('cascade');
            $table->integer('points');
            $table->string('transaction_type');
            $table->string('description');
            $table->morphs('transactionable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loyalty_transactions');
        Schema::dropIfExists('loyalty_rewards');
        Schema::dropIfExists('customer_history');
        Schema::dropIfExists('customer_profiles');
    }
}; 