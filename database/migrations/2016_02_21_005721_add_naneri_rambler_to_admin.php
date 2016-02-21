<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Zabor\Mysql\User;

class AddNaneriRamblerToAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = User::where('s_email', 'naneri@rambler.ru')->first();

        if(!is_null($user)){
            User::where('s_email', 'naneri@rambler.ru')->update(['is_admin' => 1]);
        }
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
