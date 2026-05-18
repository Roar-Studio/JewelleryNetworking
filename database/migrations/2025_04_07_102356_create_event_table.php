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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Event Name
            $table->string('event_type')->nullable();
            $table->string('event_method')->nullable();
            $table->longText('description')->nullable(); // Event Description with formatting
            $table->string('currency_type')->default('IN');
            $table->decimal('amount_in_inr', 10, 2)->default(0.00); // Transaction amount
            $table->decimal('amount_in_usd', 10, 2)->default(0.00); // Transaction amount
            $table->dateTime('event_start_datetime')->nullable(); // Event Date and Time
            $table->dateTime('event_end_datetime')->nullable(); // Event Date and Time
            $table->string('venue_address')->nullable(); // Venue address
            $table->string('google_maps_link')->nullable(); // Google Maps link
            $table->string('google_meet_link')->nullable(); // Google Maps link
            $table->integer('total_seats')->unsigned()->default(0); // Open registration spots
            $table->string('banner')->nullable(); // Event Banner (path or URL)
            $table->date('display_start_date')->nullable(); // Display Start Date
            $table->date('display_end_date')->nullable(); // Display End Date
            $table->boolean('is_active')->default(1); // Status
            $table->boolean('is_deleted')->default(0); // Status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
