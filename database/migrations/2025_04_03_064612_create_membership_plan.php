<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->id(); // Auto-incremented primary key
            // $table->string('plan_id')->unique(); // Unique plan identifier
            $table->string('name'); // Plan name
            $table->string('currency_type')->default('IN');
            $table->decimal('amount', 10, 2)->default(0.00); // Plan cost
            $table->integer('duration'); // Duration in days
            $table->text('description')->nullable(); // Optional description
            $table->text('benefits')->nullable(); // Optional benefits
            $table->boolean('is_active')->default(1); //
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    public function down() {
        Schema::dropIfExists('membership_plans');
    }
};
