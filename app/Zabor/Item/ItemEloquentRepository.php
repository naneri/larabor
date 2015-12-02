<?php namespace App\Zabor\Item;

use App\Zabor\Mysql\Item;
use App\Zabor\Contracts\ItemInterface;

class ItemEloquentRepository implements ItemInterface
{

	public static function check()
	{
		echo "<pre>"; print_r(23); echo "</pre>";
		exit;
	}

	/**
	 * Gets Last Items
	 * 
	 * @return Item|null 
	 */
	public function getLast()
	{
		return Item::take(5)->with([
            'images' => function($query){
                $query->first();
            }, 'category.description', 'description', 'currency'])
		->orderBy('pk_i_id', 'DESC')
		->get();
	}
}