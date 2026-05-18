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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('coupon_code', 255)->unique();
            $table->string('coupon_name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('marketing_text', 255)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('discount_type', 255)->nullable();
            $table->decimal('discount_flat_inr', 10, 2)->default(0); // Adjust precision if needed
            $table->decimal('discount_flat_usd', 10, 2)->default(0); // Adjust precision if needed
            $table->decimal('discount_percent_inr', 10, 2)->default(0); // Adjust precision if needed
            $table->decimal('discount_percent_usd', 10, 2)->default(0); // Adjust precision if needed
            $table->decimal('maximum_discount_inr', 10, 2)->default(0);
            $table->decimal('maximum_discount_usd', 10, 2)->default(0);
            $table->decimal('minimum_purchase_inr', 10, 2)->default(0);
            $table->decimal('minimum_purchase_usd', 10, 2)->default(0);
            
            $table->string('coupon_type')->default('generic');
            $table->string('membership_type')->nullable();
            $table->string('event_type')->nullable();
            $table->string('user_specific')->nullable();
            $table->string('max_use_per_user')->default(0);
            $table->integer('is_active')->default(1);
            $table->integer('is_deleted')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
