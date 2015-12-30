<?php namespace App\Zabor\Items;

use Carbon\Carbon;

use App\Zabor\Mysql\Item;
use App\Zabor\Mysql\Item_description as Description;
use App\Zabor\Mysql\Item_meta as Meta;

class ItemCreator
{

	public function __construct()
	{
		
	}

	/**
	 * Item store logic
	 * 
	 * @param  [type] $item_data [description]
	 * @param  [type] $user      [description]
	 * @param  [type] $days      [description]
	 * @return [type]            [description]
	 */
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

		$item->save();

		$description = Description::where('fk_i_item_id', $item->pk_i_id)->first();

		if(empty($description)){

			$description = new Description;

			$description->fk_i_item_id = $item->pk_i_id;
			$description->fk_c_locale_code = 'ru_Ru';
		}

		$description->s_title		= $item_data['title'];
		$description->s_description	= $item_data['description'];

		$description->save();

		return $item->pk_i_id;
	}

	public function storeMetas($item_id, $meta_values)
	{
		$metas = Meta::where('fk_i_item_id', $item_id)->get()->toArray();

		foreach($meta_values as $key => $value){
			if(!empty($metas)){
				
			}
		}
	}

}