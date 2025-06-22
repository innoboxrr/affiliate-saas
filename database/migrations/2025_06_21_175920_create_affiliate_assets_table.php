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
        Schema::create('affiliate_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('url'); 
            $table->json('payload')->nullable();
            $table->foreignId('affiliate_program_id')->constrained('affiliate_programs')->onDelete('cascade'); 
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
        Schema::dropIfExists('affiliate_assets');
    }
};
