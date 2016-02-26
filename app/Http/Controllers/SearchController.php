<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Zabor\Mysql\Currency;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Repositories\Contracts\CategoryInterface;
use App\Zabor\Repositories\Contracts\MetaInterface;

class SearchController extends Controller
{
	protected $category;
	protected $meta;
	protected $item;
	protected $currency;

	public function __construct(
		ItemInterface $item,
		CategoryInterface $category,
		MetaInterface $meta,
		Currency $currency
	)
	{
		$this->item = $item;
		$this->category = $category;
		$this->meta = $meta;
		$this->currency = $currency;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		// getting the category id | tried to fix issue with string input
		$cat_id = (int)$request->input('category') ?: null;
		if ($cat_id) {
			$category = $this->category->getById($cat_id);
		} else {
			$category = null;
		}

		$cat_id_list = null;
		$ancestor_list = null;
		$metas = null;
		$parameters = $request->all();

		if (!empty($cat_id)) {
			// getting ids of all children and childrens children for item search
			$cat_id_list = $this->category->getIdWithChildrenIds($cat_id);

			// getting all ancestor categories with description
			$ancestor_list = $this->category->getAncestors($cat_id);

			// geting category meta data
			$metas = $this->meta->getCategorySearchMeta($cat_id);

			// removing the meta params that don't exist in current category
			if(isset($parameters['meta'])){
				foreach($parameters['meta'] as $key => $value){
					if(!$metas->keyBy('pk_i_id')->has($key)){
						unset($parameters['meta'][$key]);
					}
				}
			}
		}

		$cat_children = $this->category->getDirectChildrenWithDescription($cat_id);

		$currencies = $this->currency->all();

		// performing the search
		$items = $this->item->searchItems(array_except($parameters ,['category']), $cat_id_list);

		$searchParams = array_except($parameters ,['page']);


		return view('search', [
			'items' => $items->appends($request->except('page')),
			'cat_ancestors' => $ancestor_list,
			'cat_children' => $cat_children,
			'searchParams' => $searchParams,
			'metas' => $metas,
			'currencies' => $currencies,
			'category' => $category
		]);
	}


}
