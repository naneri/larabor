<?php namespace App\Zabor\Mysql;

use Illuminate\Database\Eloquent\Model;

class UserData extends ZaborModel
{
    public $primaryKey = 'fk_i_user_id';

    protected $table = "user_data";

    protected $guarded = [];

    protected $casts = [
        'comment_notification' => 'boolean'
    ];
}
