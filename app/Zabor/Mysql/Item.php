<?php namespace App\Zabor\Mysql;

use Carbon\Carbon;

class Item extends ZaborModel
{
	protected $table = "item";

	public function images()
	{
		return $this->hasMany('App\Zabor\Mysql\Item_resource', 'fk_i_item_id', 'pk_i_id');
	}

	public function description()
	{
		return $this->hasOne('App\Zabor\Mysql\Item_description', 'fk_i_item_id', 'pk_i_id')->where('fk_c_locale_code', 'ru_Ru');
	}

	public function location()
	{
		return $this->hasOne('App\Zabor\Mysql\Item_location', 'fk_i_item_id', 'pk_i_id');
	}

	public function stats()
	{
		return $this->hasMany('App\Zabor\Mysql\Item_stats', 'fk_i_item_id', 'pk_i_id');
	}

	public function category()
	{
		return $this->belongsTo('App\Zabor\Mysql\Category', 'fk_i_category_id', 'pk_i_id');
	}

	public function currency()
	{
		return $this->belongsTo('App\Zabor\Mysql\Currency', 'fk_c_currency_code', 'pk_c_code');
	}

	public function getIPriceAttribute($value)
	{
		if($value != 0){
			return $value/1000000;
		}
		
		return null;
	}

	public function getDtPubDateAttribute($value)
	{
		$time = new Carbon($value);

		return $time->toDateString();
	}
}