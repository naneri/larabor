<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Zabor\Mysql\User;
use App\Zabor\Mysql\UserData;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->integer('fk_i_user_id');
            $table->integer('activate_attempts')->default(0);
            $table->text('info')->nullable();
        });

        User::chunk(100, function ($users) {
            foreach ($users as $user) {
                UserData::create(['fk_i_user_id'    => $user->pk_i_id]);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_data');
    }
}
