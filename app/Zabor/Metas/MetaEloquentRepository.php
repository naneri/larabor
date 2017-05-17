<?php namespace App\Zabor\Metas;

use App\Zabor\Mysql\Category;
use App\Zabor\Mysql\Meta;
use App\Zabor\Metas\Contracts\MetaInterface;

class MetaEloquentRepository implements MetaInterface
{
    
    public static function getCategoryMeta($category_id)
    {
        return Category::find($category_id)->metas()->get();
    }

    public static function getCategorySearchMeta($category_id)
    {
        return Category::find($category_id)->metas()->where('b_searchable', 1)->get();
    }
}
