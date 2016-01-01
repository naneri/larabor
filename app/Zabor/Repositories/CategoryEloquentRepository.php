<?php namespace App\Zabor\Repositories;

use App\Zabor\Mysql\Category;
use App\Zabor\Repositories\Contracts\CategoryInterface;

class CategoryEloquentRepository implements CategoryInterface
{
	/**
	 * [getRootCategories description]
	 * @return [type] [description]
	 */
	public function getRootCategories()
	{
		return Category::whereNull('fk_i_parent_id')
				->with(['description', 'stats'])
				->has('description')
				->where('b_enabled', 1)
				->orderBy('i_position')
				->get();
	}

	/**
	 * [allWithDescription description]
	 * @return [type] [description]
	 */
	public function allWithDescription()
	{
		return Category::with(['description'])
				->has('description')
				->where('b_enabled', 1)
				->orderBy('i_position')
				->get();
	}

	/**
	 * [getById description]
	 * @param  [type] $category_id [description]
	 * @return [type]              [description]
	 */
	public function getById($category_id)
	{
		return Category::with(['description', 'stats'])
					->has('description')
					->where('b_enabled',1)
					->find($category_id);
	}

	/**
	 * [getMultipleByIds description]
	 * @param  [type] $category_ids [description]
	 * @return [type]               [description]
	 */
	public function getMultipleByIds($category_ids)
	{
		return Category::with(['description', 'stats'])
					->has('description')
					->whereIn('pk_i_id',$category_ids)
					->get();
					
	}

	/**
	 * [getChildren description]
	 * @param  [type] $category_id [description]
	 * @return [type]              [description]
	 */
	public function getIdWithChildrenIds($category_id)
	{
		$cat_ids = [$category_id];

		$sub_cat_ids = Category::where('fk_i_parent_id', $category_id)
				->get()
				->pluck('pk_i_id')
				->toArray();

		$sub_sub_cat_ids = Category::whereIn('fk_i_parent_id', $sub_cat_ids)
					->get()
					->pluck('pk_i_id')
					->toArray();

		$cat_ids = array_merge($cat_ids, $sub_cat_ids, $sub_sub_cat_ids);

		return $cat_ids;
	}

	/**
	 * gets array of ancestors of given Category
	 * 
	 * @param  [int] $category_id 
	 * @return [type]              
	 */
	public function getAncestors($category_id)
	{

		$categories = $this->allWithDescription();

		$array[] = $categories->where('pk_i_id', (int)$category_id)
						->first();

		while($array[0]->fk_i_parent_id != null){
			array_unshift($array, $categories->where('pk_i_id', $array[0]->fk_i_parent_id)->first());
		}

		return $array;
	}

	/**
	 * gets a first generation children array
	 * 
	 * @param  [int] $category_id 
	 * @return [type]              
	 */
	public function getDirectChildrenWithDescription($category_id)
	{
		return Category::where('fk_i_parent_id', $category_id)
					->with(['description'])
					->has('description')
					->orderBy('i_position')
					->get();
	}	
}