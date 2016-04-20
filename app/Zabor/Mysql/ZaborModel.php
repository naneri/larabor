<?php namespace App\Zabor\Mysql;

use Illuminate\Database\Eloquent\Model;

class ZaborModel extends Model
{
	protected $primaryKey = 'pk_i_id';

	public $timestamps = false;

	protected $guarded = [];
	
}