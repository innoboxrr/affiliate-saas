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
        Schema::table('affiliate_programs', function (Blueprint $table) {
            $table->string('server_token', 64)
                ->nullable()
                ->after('description')
                ->comment('Server token for the affiliate program');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affiliate_programs', function (Blueprint $table) {
            $table->dropColumn('server_token');
        });
    }
};
