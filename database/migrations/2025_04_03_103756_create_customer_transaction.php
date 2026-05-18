<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id(); // Auto-incremented primary key
            $table->string('transaction_id')->nullable()->unique(); // Unique transaction identifier
            $table->string('order_id')->nullable()->unique(); // Unique transaction identifier
            $table->foreignId('customer_id')->nullable()->constrained('costumers')->nullOnDelete(); // User who made the transaction

            // Polymorphic Relationship: Handles both Plan & Event Transactions
            $table->string('transactionable_type');
            $table->unsignedBigInteger('transactionable_id');
            $table->index(['transactionable_type', 'transactionable_id'], 'txn_details_txnable_idx'); // Custom index name

            $table->string('currency_type')->default('IN');
            
            $table->string('payer_first_name')->nullable(); 
            $table->string('payer_last_name')->nullable(); 
            $table->string('payer_mobile_no')->nullable(); 
            $table->string('payer_mobile_no_cc')->nullable(); 
            $table->string('payer_mobile_no_ic')->nullable(); 
            $table->string('payer_email')->nullable(); 
            $table->string('payer_taxid')->nullable();
            $table->string('payer_company_name')->nullable();
            $table->string('payer_company_address')->nullable();

            $table->decimal('price', 10, 2)->default(0.00); 
            $table->decimal('gst', 10, 2)->default(0.00); 
            $table->decimal('discount', 10, 2)->default(0.00); 
            $table->string('coupon_id')->nullable(); // Transaction amount
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending'); // Payment status
            $table->string('payment_method')->nullable(); // Payment method (Card, PayPal, etc.)
            $table->string('transaction_reference')->nullable(); // Reference ID from payment gateway
            $table->timestamp('transaction_date')->nullable(); // Timestamp of payment
            $table->date('start_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->string('note')->nullable();
            $table->string('updated_by_admin')->default(0); // Set to 1 if manually added by admin
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    public function down() {
        Schema::dropIfExists('transaction_details');
    }
};
