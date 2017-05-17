<?php namespace App\Zabor\Categories;

use Cache;
use App\Zabor\Mysql\Category;
use App\Zabor\Categories\Contracts\CategoryInterface;

class CategoryEloquentRepository implements CategoryInterface
{
    /**
     * @return mixed
     */
    public function getRootCategories()
    {
        return Cache::remember('root-categories', 10, function () {
            return Category::whereNull('fk_i_parent_id')
                ->with(['description', 'stats'])
                ->has('description')
                ->where('b_enabled', 1)
                ->orderBy('i_position')
                ->get();
        });
    }

    /**
     * @return mixed
     */
    public function allWithDescription()
    {
        return Cache::remember('all-categories-with-description', 10, function () {
            return Category::with(['description'])
                ->has('description')
                ->where('b_enabled', 1)
                ->orderBy('i_position')
                ->get();
        });
    }

    /**
     * @param $category_id
     * @return mixed
     */
    public function getById($category_id)
    {
        return Cache::remember('category-' . $category_id, 10, function () use ($category_id) {
            return Category::with(['description', 'stats'])
                    ->has('description')
                    ->where('b_enabled', 1)
                    ->findOrFail($category_id);
        });
    }

    /**
     * @param $category_ids
     */
    public function getMultipleByIds($category_ids)
    {
        Cache::remember('category-multiple-', implode('.', $category_ids), 10, function () use ($category_ids) {
            return Category::with(['description', 'stats'])
                    ->has('description')
                    ->whereIn('pk_i_id', $category_ids)
                    ->get();
        });
    }

    /**
     * @param $category_id
     * @return array
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
     * @param $category_id
     * @return array
     */
    public function getAncestors($category_id)
    {
        $categories = $this->allWithDescription();

        $array[] = $categories->where('pk_i_id', $category_id)
                        ->first();

        while ($array[0]->fk_i_parent_id != null) {
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

    /**
     * @param $cat_id
     *
     * @return array
     */
    public function getWithAncestorsArray($cat_id)
    {
        $array = collect($this->getAncestors($cat_id));

        return $array->map(function ($value, $key) {
            return $value->pk_i_id;
        })->toArray();
    }
}
