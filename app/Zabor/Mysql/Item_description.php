<?php namespace App\Zabor\Mysql;

class Item_description extends ZaborModel
{
    public $primaryKey = 'fk_i_item_id';

    protected $table = "item_description";

    protected $fillable = ['fk_i_item_id', 's_title', 's_description', 'fk_c_locale_code'];
}
