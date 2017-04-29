<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveUserDataToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_data', function (Blueprint $table) {
            $table->dropColumn('info');
        });

        Schema::table('user', function (Blueprint $table) {
            $table->text('info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('info');
         });

         Schema::table('user_data', function (Blueprint $table) {
            $table->text('info')->nullable();
         });
    }
}
