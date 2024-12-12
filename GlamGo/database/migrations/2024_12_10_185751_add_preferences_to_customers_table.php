<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('date_of_birth');
            $table->boolean('email_notifications')->default(false)->after('is_active');
            $table->boolean('sms_notifications')->default(false)->after('email_notifications');
            $table->boolean('marketing_emails')->default(false)->after('sms_notifications');
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'email_notifications',
                'sms_notifications',
                'marketing_emails',
            ]);
        });
    }
};
