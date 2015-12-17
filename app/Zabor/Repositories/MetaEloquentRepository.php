<?php namespace App\Zabor\Repositories;

use App\Zabor\Mysql\Category;
use App\Zabor\Mysql\Meta;
use App\Zabor\Repositories\Contracts\MetaInterface;

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