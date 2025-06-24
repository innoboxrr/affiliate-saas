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
        Schema::table('affiliates', function (Blueprint $table) {
            $table->dropColumn('workspace_id');
            $table->foreignId('affiliate_program_id')
                ->nullable()
                ->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->after('id')
                ->comment('Workspace ID for the affiliate');
            $table->dropColumn('affiliate_program_id');
        });
    }
};
