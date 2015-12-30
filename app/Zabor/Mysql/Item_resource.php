<?php namespace App\Zabor\Mysql;

class Item_resource extends ZaborModel
{
	protected $table = "item_resource";

	protected $appends = ['image_url'];

	protected $fillable = ['fk_i_item_id', 's_name', 's_extension', 's_content_type', 's_path'];

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

	public function thumbnailUrl()
	{
		return "{$this->s_path}{$this->s_name}_thumbnail.{$this->s_extension}";
	}

}