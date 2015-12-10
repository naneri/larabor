<?php namespace App\Zabor\Mysql;

class Category extends ZaborModel
{
	protected $table = "category";

	public function description()
	{
		return $this->hasOne('App\Zabor\Mysql\Category_description', 'fk_i_category_id', 'pk_i_id');
	}

	public function stats()
	{
		return $this->hasOne('App\Zabor\Mysql\Category_stats', 'fk_i_category_id', 'pk_i_id');
	}

	public function metas()
	{
		return $this->belongsToMany('App\Zabor\Mysql\Meta', 'meta_categories', 'fk_i_category_id', 'fk_i_field_id');
	}
}