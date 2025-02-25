<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Drop the category column if it exists
            if (Schema::hasColumn('services', 'category')) {
                $table->dropColumn('category');
            }

            // Add category_id if it doesn't exist
            if (!Schema::hasColumn('services', 'category_id')) {
                $table->foreignId('category_id')->nullable()->after('id')->constrained()->onDelete('set null');
            }

            // Rename image_url to image if needed
            if (Schema::hasColumn('services', 'image_url') && !Schema::hasColumn('services', 'image')) {
                $table->renameColumn('image_url', 'image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }

            if (Schema::hasColumn('services', 'image')) {
                $table->renameColumn('image', 'image_url');
            }

            if (!Schema::hasColumn('services', 'category')) {
                $table->string('category')->nullable();
            }
        });
    }
};
