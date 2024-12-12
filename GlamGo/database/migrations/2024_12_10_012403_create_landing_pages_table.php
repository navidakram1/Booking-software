<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title');
            $table->string('hero_subtitle');
            $table->string('hero_cta_text');
            $table->string('hero_cta_link');
            $table->string('hero_image')->nullable();
            $table->string('hero_video')->nullable();
            $table->string('about_title');
            $table->text('about_content');
            $table->string('about_image')->nullable();
            $table->string('about_video')->nullable();
            $table->json('features')->nullable();
            $table->json('stats')->nullable();
            $table->timestamps();
        });

        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('caption')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('landing_pages');
    }
};
