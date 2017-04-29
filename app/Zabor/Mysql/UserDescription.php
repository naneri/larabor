<?php namespace App\Zabor\Mysql;

class UserDescription extends ZaborModel
{
    public $primaryKey = 'fk_i_user_id';

    protected $table = "user_description";

    protected $fillable = ['fk_i_user_id', 's_info', 'fk_c_locale_code'];
}
