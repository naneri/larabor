<?php namespace App\Zabor\Mysql;

class Meta extends ZaborModel
{
    protected $table = "meta_fields";

    protected $appends = ['options_list'];

    public function categories()
    {
        return $this->belongsToMany('App\Zabor\Mysql\Category', 'meta_categories', 'fk_i_field_id', 'fk_i_category_id');
    }

    public function getOptionsListAttribute()
    {
        return explode(',', $this->attributes['s_options']);
    }
}
