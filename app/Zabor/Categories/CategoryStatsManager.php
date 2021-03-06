<?php namespace App\Zabor\Categories;

use App\Zabor\Mysql\Category;
use App\Zabor\Mysql\CategoryStats as Stats;
use App\Zabor\Categories\Contracts\CategoryInterface;
use Carbon\Carbon;

//ToDo break the tight coupling between CatEloquent repo and this Service

class CategoryStatsManager
{

    protected $catRepo;

    /**
     * CategoryStatsManager constructor.
     * @param CategoryInterface $catRepo
     */
    public function __construct(
        CategoryInterface $catRepo
    )
    {
        $this->catRepo = $catRepo;
    }

    /**
     * @param $cat_id
     * @param null $expiration_date
     * @param int $active
     *
     * @return bool
     */
    public function increaseCategoryStats($cat_id, $expiration_date = null, $active = 0)
    {
        if ($active == 0) {
            return false;
        }

        if (!is_null($expiration_date) && $expiration_date > Carbon::now()) {
            return false;
        }

        $categoryArray = $this->catRepo->getWithAncestorsArray($cat_id);

        Stats::whereIn('fk_i_category_id', $categoryArray)->increment('i_num_items');

        return true;
    }
}
