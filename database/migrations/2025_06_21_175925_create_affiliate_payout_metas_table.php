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
        Schema::create('affiliate_payout_metas', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->longText('value');
            $table->foreignId('affiliate_payout_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['key', 'affiliate_payout_id'], 'unique_key_affiliate_payout_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affiliate_payout_metas', function (Blueprint $table) {
            $table->dropUnique('unique_key_affiliate_payout_id');
        });
        
        Schema::dropIfExists('affiliate_payout_metas');
    }
};
