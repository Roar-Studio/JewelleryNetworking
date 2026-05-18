<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('otp_master')) {
            Schema::create('otp_master', function (Blueprint $table) {
                $table->id();
                $table->string('otp');
                $table->string('status');
                $table->string('token');
                $table->unsignedBigInteger('customer_id')->nullable();
                $table->timestamp('verified_at')->nullable();
                $table->timestamps();
    
                // Foreign key constraint
                $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otp_master');
    }
};
