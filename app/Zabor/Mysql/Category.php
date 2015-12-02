<?php namespace App\Zabor\Mysql;

class Category extends ZaborModel
{
	protected $table = "category";

	public function description()
	{
		return $this->hasOne('App\Zabor\Mysql\Category_description', 'fk_i_category_id', 'pk_i_id');
	}
}