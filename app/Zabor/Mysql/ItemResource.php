<?php namespace App\Zabor\Mysql;

class ItemResource extends ZaborModel
{
    protected $table = "item_resource";

    protected $appends = ['image_url', 'path', 'name'];

    protected $fillable = ['fk_i_item_id', 's_name', 's_extension', 's_content_type', 's_path'];

    public function getImageUrlAttribute($value)
    {
        return "{$this->s_path}{$this->pk_i_id}.{$this->s_extension}";
    }

    public function imageThumbUrl()
    {
        return "{$this->s_path}{$this->pk_i_id}_thumbnail.{$this->s_extension}";
    }
    
    public function imageUrl()
    {
        return "{$this->s_path}{$this->pk_i_id}.{$this->s_extension}";
    }

    public function thumbnailUrl()
    {
        return "{$this->s_path}{$this->pk_i_id}_thumbnail.{$this->s_extension}";
    }

    public function getNameAttribute()
    {
        return (int) $this->pk_i_id;
    }

    public function getPathAttribute()
    {
        return asset("{$this->s_path}{$this->pk_i_id}_thumbnail.{$this->s_extension}");
    }
}
