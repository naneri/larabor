<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Zabor\Mysql\Item;
use Carbon\Carbon;

class AddUpdateDateToItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item', function (Blueprint $table) {
            $table->dateTime('dt_update_date')->after('dt_mod_date');
        });

        Item::where('dt_expiration', '>', Carbon::now())->chunk(100, function ($items) {
            foreach ($items as $item) {
                $item->update(['dt_update_date' => $item->dt_pub_date]);
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
        Schema::table('item', function (Blueprint $table) {
            $table->dropColumn('dt_update_date');
        });
    }
}
