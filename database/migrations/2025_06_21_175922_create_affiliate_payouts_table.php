<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_payouts', function (Blueprint $table) {
            $table->id();
            $table->string('processor')->default('manual'); // e.g., 'manual', 'stripe', 'paypal'
            $table->string('status')->default('pending'); // e.g., 'pending', 'completed', 'failed'
            $table->decimal('amount', 10, 2); // Amount to be paid
            $table->string('currency', 3)->default('USD'); // Currency code, e.g., 'USD', 'EUR'
            $table->json('payload')->nullable(); // Additional data for the payout processor
            $table->timestamp('paid_at')->nullable(); // Timestamp when the payout was made
            $table->foreignId('affiliate_id')->constrained('affiliates')->onDelete('cascade'); // Foreign key to the affiliate
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliate_payouts');
    }
};
