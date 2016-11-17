<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteUnusedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('alerts');
        Schema::dropIfExists('alerts_sent');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('ban_rule');
        Schema::dropIfExists('city_area');
        Schema::dropIfExists('city_stats');
        Schema::dropIfExists('city');
        Schema::dropIfExists('region_stats');
        Schema::dropIfExists('region');
        Schema::dropIfExists('country_stats');
        Schema::dropIfExists('country');
        Schema::dropIfExists('cron');
        Schema::dropIfExists('facebook_connect');
        Schema::dropIfExists('latest_searches');
        Schema::dropIfExists('locations_tmp');
        Schema::dropIfExists('log');
        Schema::dropIfExists('multicurrency');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('pages_description');
        Schema::dropIfExists('plugin_category');
        Schema::dropIfExists('preference');
        Schema::dropIfExists('user_email_tmp');
        Schema::dropIfExists('widget');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
