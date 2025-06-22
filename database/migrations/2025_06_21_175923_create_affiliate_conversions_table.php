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
        Schema::create('affiliate_conversions', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending'); // pending, completed, rejected
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->string('currency', 3)->default('USD');
            $table->decimal('commission', 10, 2)->default(0.00);
            $table->string('event_type'); // e.g., 'online_purchase', 'online_subscription', 'offline_purchase', etc.
            $table->json('payload')->nullable();
            $table->boolean('is_test')->default(false); // Indicates if the conversion is a test entry
            $table->foreignId('approved_by')->nullable(); // User who approved the conversion, Null means not approved or system-generated
            $table->timestamp('approved_at')->nullable(); // Timestamp when the conversion was approved
            $table->unsignedBigInteger('external_order_id')->nullable(); // ID from the external system
            $table->unsignedBigInteger('external_user_id')->nullable(); // ID from the external system
            $table->foreignId('affiliate_link_id')->constrained('affiliate_links')->onDelete('cascade');
            $table->foreignId('affiliate_click_id')->constrained('affiliate_clicks')->onDelete('cascade');
            $table->foreignId('affiliate_payout_id')->nullable()->constrained('affiliate_payouts')->onDelete('set null');
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
        Schema::dropIfExists('affiliate_conversions');
    }
};
