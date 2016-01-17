<?php namespace App\Zabor\Mysql;

class Item_meta extends ZaborModel
{
	public $primaryKey = "fk_i_item_id";

	protected $table = "item_meta";

	public function meta()
	{
		return $this->belongsTo('App\Zabor\Mysql\Meta', 'fk_i_field_id', 'pk_i_id');
	}

	public function getFkIFieldIdAttribute($value)
	{
		return (int) $value;
	}
	
}