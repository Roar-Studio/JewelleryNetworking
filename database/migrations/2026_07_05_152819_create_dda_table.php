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
            $table->id();
            $table->timestamps();
            /* Technical Columns */
            $table->string("entry_id");
            /* Event Specific Columns */
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email");
            $table->string("phone_number");
            $table->string("city");
            $table->string("country");
            $table->string("organization_name");
            $table->string("participant_type");
            
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
