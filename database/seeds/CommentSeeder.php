<?php

use App\Zabor\Mysql\Item;
use App\Zabor\Mysql\ItemComment;
use App\Zabor\Mysql\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();
        $users = User::all();

        foreach ($items as $item){
            factory(ItemComment::class)->create([
                'item_id' => $item->pk_i_id,
                'user_id' => $users->random()->pk_i_id
            ]);
            factory(ItemComment::class)->create([
                'item_id' => $item->pk_i_id,
                'user_id' => $users->random()->pk_i_id
            ]);
            factory(ItemComment::class)->create([
                'item_id' => $item->pk_i_id,
                'user_id' => $users->random()->pk_i_id
            ]);
        }
    }
}
