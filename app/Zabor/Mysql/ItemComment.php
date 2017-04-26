<?php namespace App\Zabor\Mysql;

use Carbon\Carbon;

class ItemComment extends ZaborModel
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['publication_date'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'pk_i_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'pk_i_id');
    }

    public function getPublicationDateAttribute()
    {
        $time = new Carbon($this->created_at);

        return $time->toDateString();
    }
}
