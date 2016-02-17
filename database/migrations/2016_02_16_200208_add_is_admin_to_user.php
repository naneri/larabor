<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Zabor\Mysql\User;

class AddIsAdminToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function(Blueprint $table){
            $table->integer('is_admin')->nullable();
        });

        $user = User::firstOrCreate(['s_email' => 'naneri@mail.ru']);

        $user->update(['is_admin' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function(Blueprint $table){
            $table->dropColumn('is_admin');
        });
    }
}
