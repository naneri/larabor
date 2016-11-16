<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Zabor\Mysql\Item::class, 50)->create()->each(function($item) {
            $item->description()->save(factory(App\Zabor\Mysql\Item_description::class)->make());
        });;
    }
}
