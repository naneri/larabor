<?php namespace App\Zabor\Repositories;

use Carbon\Carbon;

use App\Zabor\Mysql\Item;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Mysql\Item_meta as Meta;

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
		return Item::take(10)->with([
	            'category.description', 
	            'description', 
	            'currency', 
	            'lastImage',
	            'stats'
            ])->orderBy('pk_i_id', 'DESC')
			  ->get();
	}

	public function getById($id)
	{
		return Item::with([
			'images', 
			'category.description', 
			'description', 
			'currency', 
			'user',
			'metas.meta'
			])->find($id);
	}

	public function store($item_data, $user, $days)
	{
		$item = new Item;
		$item->fk_i_user_id		 	= isset($item_data['user_id']) ? intval($item['user_id']) : null;
		$item->fk_i_category_id		= $item_data['category_id'];
		$item->dt_pub_date		 	= Carbon::now()->toDateTimeString();
		$item->i_price 			  	= isset($item_data['price']) ? $item_data['price'] : null;
		$item->fk_c_currency_code 	= $item_data['currency'];
		$item->s_contact_name		= isset($user->s_name) ? $user->s_name : null;
		$item->s_contact_email		= $item_data['seller-email'];
		$item->s_secret 			= str_random(8);
		$item->dt_expiration		= Carbon::now()->addDays($days)->toDateTimeString();
echo "<pre>"; print_r($item); echo "</pre>";
exit;
		$item->save();
	}
}