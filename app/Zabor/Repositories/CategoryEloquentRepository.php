<?php namespace App\Zabor\Repositories;

use App\Zabor\Mysql\Category;
use App\Zabor\Repositories\Contracts\CategoryInterface;

class CategoryEloquentRepository implements CategoryInterface
{
	public function getRootCategories()
	{
		return Category::whereNull('fk_i_parent_id')
				->with(['description', 'stats'])
				->where('b_enabled', 1)
				->orderBy('i_position')
				->get();
	}

	public function allWithDescription()
	{
		return Category::with(['description'])
				->where('b_enabled', 1)
				->orderBy('i_position')
				->get();
	}

	public function getById($category_id)
	{
		return Category::with(['description', 'stats'])
					->where('b_enabled',1)
					->find($category_id);
	}
}