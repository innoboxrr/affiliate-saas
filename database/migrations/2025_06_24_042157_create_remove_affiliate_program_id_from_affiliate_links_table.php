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
        Schema::table('affiliate_links', function (Blueprint $table) {
            $table->dropForeign(['affiliate_program_id']);
            $table->dropColumn('affiliate_program_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affiliate_links', function (Blueprint $table) {
            $table->unsignedBigInteger('affiliate_program_id')->nullable()->after('affiliate_id');
            $table->foreign('affiliate_program_id')->references('id')->on('affiliate_programs')->onDelete('cascade');
        });
    }
};
