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
        Schema::create('affiliate_clicks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->string('url')->nullable();
            $table->foreignId('affiliate_link_id')->constrained('affiliate_links')->onDelete('cascade');
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
        Schema::dropIfExists('affiliate_clicks');
    }
};
