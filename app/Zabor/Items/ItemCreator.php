<?php namespace App\Zabor\Items;

use Carbon\Carbon;

use App\Zabor\Mysql\Item;
use App\Zabor\Mysql\Item_description as Description;
use App\Zabor\Mysql\Item_location 	 as Location;
use App\Zabor\Mysql\Item_comment 	 as Comment;
use App\Zabor\Mysql\Item_stats 		 as Stats;
use App\Zabor\Mysql\Item_meta 		 as Meta;
use App\Zabor\Images\ImageCreator;
use App\Zabor\Services\CategoryStatsManager;
class ItemCreator
{

	public function __construct(
		ImageCreator $imageCreator,
		CategoryStatsManager $catManager
		)
	{
		$this->imageCreator 	= $imageCreator;
		$this->categoryManager 	= $catManager;
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
		$item->fk_i_user_id		 	= !is_null($user) ? intval($user->pk_i_id) : null;
		$item->fk_i_category_id		= $item_data['category_id'];
		$item->dt_pub_date		 	= Carbon::now()->toDateTimeString();
		$item->i_price 			  	= isset($item_data['price']) ? $item_data['price'] : null;
		$item->fk_c_currency_code 	= $item_data['currency'];
		$item->s_contact_name		= isset($user->s_name) ? $user->s_name : null;
		$item->s_contact_email		= $item_data['seller-email'];
		$item->s_secret 			= str_random(8);
		$item->dt_expiration		= Carbon::now()->addDays($days)->toDateTimeString();
		$item->b_active 			= !is_null($user) ? 1 : 0 ;


		$item->save();

		$this->storeOrUpdateDescription($item->pk_i_id, $item_data);
				
		$this->storeMetas($item->pk_i_id, $item_data['meta']);

		$this->categoryManager->increaseCategoryStats(
			$item->fk_i_category_id, null, $item->b_active);

		return $item->pk_i_id;
	}

	/**
	 * edit item
	 * @param  [type] $item_data [description]
	 * @param  [type] $user      [description]
	 * @return [type]            [description]
	 */
	public function edit($item_data, $user, $id)
	{
		$item =  Item::findOrFail($id);
		$item->fk_i_category_id		= $item_data['category_id'];
		$item->dt_mod_date		 	= Carbon::now()->toDateTimeString();
		$item->i_price 			  	= isset($item_data['price']) ? $item_data['price'] : null;
		$item->fk_c_currency_code 	= $item_data['currency'];
		$item->s_contact_name		= isset($user->s_name) ? $user->s_name : null;
		$item->s_contact_email		= $item_data['seller-email'];
		

		$item->save();

		$this->storeOrUpdateDescription($item->pk_i_id, $item_data);
		
		$this->storeMetas($item->pk_i_id, $item_data['meta']);


		return $item->pk_i_id;
	}

	/**
	 * [storeOrUpdateDescription description]
	 * @param  [int] $item_id   [description]
	 * @param  [array] $item_data [description]
	 * @return [type]            [description]
	 */
	public function storeOrUpdateDescription($item_id,	$item_data)
	{
		$description = Description::where('fk_i_item_id', $item_id)->first();

		if(empty($description)){

			$description = new Description;

			$description->fk_i_item_id = $item_id;
			$description->fk_c_locale_code = 'ru_Ru';
		}

		$description->s_title		= $item_data['title'];
		$description->s_description	= $item_data['description'];

		$description->save();

		return true;
	}

	/**
	 * [storeMetas description]
	 * @param  [type] $item_id     [description]
	 * @param  [type] $meta_values [description]
	 * @return [type]              [description]
	 */
	public function storeMetas($item_id, $meta_values)
	{
		$metas = Meta::where('fk_i_item_id', $item_id)->get();

		foreach($meta_values as $key => $value){

			// checking if record exists or creating a new
			if(!$metas->where('fk_i_field_id', (int) $key)->isEmpty()){
				$meta = Meta::where('fk_i_field_id', (int) $key)
							->where('fk_i_item_id', $item_id)
							->update(['s_value' => $value]);
			}else{
				Meta::create([
					'fk_i_item_id' 	=> $item_id,
					'fk_i_field_id'	=> $key,
					's_value' 		=> $value
					]);
			}

		}
	}

	/**
	 * [prolong description]
	 * 
	 * @param  [type] $item_id [description]
	 * @param  [type] $days    [description]
	 * 
	 * @return [type]          [description]
	 */
	public function prolong($item, $days)
	{
		$old_date = $item->dt_expiration;

		$item->dt_pub_date		= Carbon::now()->toDateTimeString();
		$item->dt_expiration	= Carbon::now()->addDays($days)->toDateTimeString();
		$item->save();

		$this->categoryManager->increaseCategoryStats(
			$item->fk_i_category_id, $old_date, $item->b_active);

		return $item;
	}

	public function delete($item)
	{
		$item_id = $item->pk_i_id;
		foreach($item->images as $image)
		{
			$this->imageCreator->delete($image->pk_i_id);
		}

		Description::where('fk_i_item_id', $item_id)->delete();
		Location::where('fk_i_item_id', $item_id)->delete();
		Stats::where('fk_i_item_id', $item_id)->delete();
		Comment::where('fk_i_item_id', $item_id)->delete();
		Meta::where('fk_i_item_id', $item_id)->delete();

		Item::where('pk_i_id', $item_id)->delete();

		return true;
	}

}