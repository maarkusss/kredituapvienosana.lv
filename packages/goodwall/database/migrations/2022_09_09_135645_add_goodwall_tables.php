<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoodwallTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goodwall_whitelist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_address', 63);
            $table->timestamps();

            $table->index('ip_address', 'goodwall_ip_ix');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goodwall_whitelist');
    }
}
