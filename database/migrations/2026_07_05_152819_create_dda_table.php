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
        Schema::create('dda', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Primary Key
            |--------------------------------------------------------------------------
            */
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Technical Information
            |--------------------------------------------------------------------------
            */
            $table->string('entry_id')->unique();

            /*
            |--------------------------------------------------------------------------
            | Step 1 - Participant Information
            |--------------------------------------------------------------------------
            */
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('organisation')->nullable();
            $table->string('participant_type');

            /*
            |--------------------------------------------------------------------------
            | Step 2 - Entry Details
            |--------------------------------------------------------------------------
            */
            $table->string('piece_name');
            $table->string('award_category');
            $table->string('materials');
            $table->string('year');
            $table->string('deity');
            $table->longText('statement');

            /*
            |--------------------------------------------------------------------------
            | Step 3 - Image Upload
            |--------------------------------------------------------------------------
            */
            // Stores uploaded image paths as JSON
            $table->json('images')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Step 4 - Declaration
            |--------------------------------------------------------------------------
            */
            $table->boolean('declaration')->default(false);

            /*
            |--------------------------------------------------------------------------
            | Submission Status
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [
                'Pending',
                'Under Review',
                'Approved',
                'Rejected'
            ])->default('Pending');

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dda');
    }
};