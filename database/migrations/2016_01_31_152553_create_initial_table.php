<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared(File::get(database_path('zabor.sql')));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach(\DB::select('SHOW TABLES') as $table) {
            $table_array = get_object_vars($table);
            DB::raw('DROP ' . $table_array[key($table_array)]);
        }
    }
}
