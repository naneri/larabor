<?php namespace App\Zabor\Mysql;

class Item_resource extends ZaborModel
{
	protected $table = "item_resource";

	protected $appends = ['image_url'];

	public function getImageUrlAttribute($value)
	{
		return "{$value->s_path}{$value->name}.{$value->s_extension}";
	}

	public function imageThumbUrl()
	{
		return "{$this->s_path}{$this->pk_i_id}_thumbnail.{$this->s_extension}";
	}
	
	public function imageUrl()
	{
		return "{$this->s_path}{$this->pk_i_id}.{$this->s_extension}";
	}

}