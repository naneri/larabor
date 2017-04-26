<?php namespace App\Zabor\Mysql;

class Category extends ZaborModel
{
    protected $table = "category";

    public function description()
    {
        return $this->hasOne('App\Zabor\Mysql\CategoryDescription', 'fk_i_category_id', 'pk_i_id');
    }

    public function stats()
    {
        return $this->hasOne('App\Zabor\Mysql\Category_stats', 'fk_i_category_id', 'pk_i_id');
    }

    public function metas()
    {
        return $this->belongsToMany('App\Zabor\Mysql\Meta', 'meta_categories', 'fk_i_category_id', 'fk_i_field_id');
    }


    public function getShortNameAttribute()
    {
        if (!empty($this->attributes['s_name'])) {
            return str_limit($this->attributes['s_name'], 27);
        }

        return null;
    }

    public function getPkIIdAttribute($value)
    {
        return (int) $value;
    }

    public function getFkIParentIdAttribute($value)
    {
        if ($value != null) {
            return (int) $value;
        } else {
            return $value;
        }
    }
}
