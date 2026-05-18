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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile_no')->nullable();
            $table->string('mobile_no_cc')->nullable();
            $table->string('mobile_no_ic')->nullable();
            $table->string('category_id')->nullable();
            $table->string('plan_type')->default(1);
            $table->date('plan_started_at')->nullable();
            $table->date('plan_expired_at')->nullable();
            $table->string('specialization')->nullable();
            $table->string('username');
            $table->string('profile_photo')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_video')->nullable();
            $table->string('trn_no')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('google_map_link')->nullable();
            $table->string('business_description')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('website')->nullable();
            $table->string('specialisation')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('x_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('is_deleted')->default(0);
            $table->string('is_active')->default(1);
            $table->integer('otp_attempts')->default(0);
            $table->timestamp('first_failed_attempt_at')->nullable();
            $table->string('session_id')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('desktop_device_id')->nullable();
            $table->string('mobile_device_id')->nullable();

            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
