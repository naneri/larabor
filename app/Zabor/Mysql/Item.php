<?php namespace App\Zabor\Mysql;

use Carbon\Carbon;

class Item extends ZaborModel
{
	protected $table = "item";

	protected $guarded = [];
	
	public function images()
	{
		return $this->hasMany('App\Zabor\Mysql\Item_resource', 'fk_i_item_id', 'pk_i_id');
	}

	public function lastImage()
	{
		return $this->hasOne('App\Zabor\Mysql\Item_resource', 'fk_i_item_id', 'pk_i_id');
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

	public function user()
	{
		return $this->belongsTo('App\Zabor\Mysql\User', 'fk_i_user_id', 'pk_i_id');
	}

	public function metas()
	{
		return $this->hasMany('App\Zabor\Mysql\Item_meta', 'fk_i_item_id', 'pk_i_id');
	}

	public function getIPriceAttribute($value)
	{
		if(!empty($value)){
			return number_format($value/1000000, 0, ',', ' ');
		}
		
		return null;
	}

	public function getDtPubDateAttribute($value)
	{
		$time = new Carbon($value);

		return $time->toDateString();
	}

	public function setIPriceAttribute($value)
	{
		$this->attributes['i_price'] = $value * 1000000;
	}


}