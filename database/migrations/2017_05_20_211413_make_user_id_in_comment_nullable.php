<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUserIdInCommentNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            // change() tells the Schema builder that we are altering a table
            $table->unsignedInteger('user_id')->nullable()->change();

            $table->foreign('user_id')->references('pk_i_id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
