<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dda_transactions', function (Blueprint $table) {

            $table->id();

            // Relation
            $table->foreignId('dda_id')->constrained('dda')->cascadeOnDelete();

            // Payment Details
            $table->string('gateway'); // razorpay / paypal

            $table->string('gateway_order_id')->nullable();

            $table->string('gateway_payment_id')->nullable();

            $table->string('gateway_signature')->nullable();

            $table->string('transaction_no')->unique();

            $table->decimal('amount',10,2);

            $table->string('currency')->default('INR');

            $table->enum('status',[
                'Pending',
                'Completed',
                'Failed'
            ])->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dda_transactions');
    }
};