<?php namespace App\Zabor\Mysql;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ItemComment extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'pk_i_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'pk_i_id');
    }
}
