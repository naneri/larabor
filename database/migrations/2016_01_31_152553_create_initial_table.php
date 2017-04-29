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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach (\DB::select('SHOW TABLES') as $table) {

            $table_array = get_object_vars($table);

            if(!strpos($table_array[key($table_array)], 'migrations')){
                DB::statement('DROP TABLE ' . $table_array[key($table_array)]);
            }

        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
