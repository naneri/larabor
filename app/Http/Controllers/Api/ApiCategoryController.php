<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Zabor\Repositories\Contracts\CategoryInterface;
use App\Zabor\Repositories\Contracts\MetaInterface;

class ApiCategoryController extends Controller{

	public function __construct(MetaInterface $meta)
	{
		$this->meta = $meta;
	}

	/**
	 * [getCategoryMeta description]
	 * @param  [type] $category_id [description]
	 * @return [type]              [description]
	 */
	public function getCategoryMeta($category_id){

		return $this->meta->getCategoryMeta($category_id);

	}
}