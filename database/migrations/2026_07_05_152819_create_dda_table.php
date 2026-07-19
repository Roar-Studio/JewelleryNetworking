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
            | Participant Information
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
            | Entry 1
            |--------------------------------------------------------------------------
            */

            $table->string('deity_category_a');
            $table->string('jewellery_piece_a');
            $table->string('material_a');
            $table->longText('statement_a');
            $table->json('images_a')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Entry 2
            |--------------------------------------------------------------------------
            */

            $table->string('deity_category_b')->nullable();
            $table->string('jewellery_piece_b')->nullable();
            $table->string('material_b')->nullable();
            $table->longText('statement_b')->nullable();
            $table->json('images_b')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Declaration
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
};