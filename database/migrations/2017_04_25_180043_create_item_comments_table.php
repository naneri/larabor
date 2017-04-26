<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('item_comment');

        Schema::create('item_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->text('text');
            $table->timestamps();

            $table->foreign('item_id')->references('pk_i_id')->on('item');
            $table->foreign('user_id')->references('pk_i_id')->on('user');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_comments');

        Schema::create('item_comment', function (Blueprint $table) {
            $table->increments('id');
        });
    }
}
