<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Zabor\Mysql\User;

class AddNaneriRamblerToAdmin extends Migration
{

    public function __construct()
    {
        $this->user = User::where('s_email', 'naneri@rambler.ru')->first();
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!is_null($this->user)){
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
        if(!is_null($this->user)){
            User::where('s_email', 'naneri@rambler.ru')->update(['is_admin' => 0]);
        }
    }
}
