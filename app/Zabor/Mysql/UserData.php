<?php namespace App\Zabor\Mysql;

use Illuminate\Database\Eloquent\Model;

class UserData extends ZaborModel
{
    public $primaryKey = 'fk_i_user_id';

    protected $table = "user_data";

    protected $fillable = ['fk_i_user_id', 'activate_attempts', 'info'];


}
