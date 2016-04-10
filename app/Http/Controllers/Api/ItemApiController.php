<?php namespace App\Http\Controllers\Api;

use Auth;
use Gate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Zabor\Repositories\Contracts\CategoryInterface;
use App\Zabor\Repositories\Contracts\MetaInterface;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Items\ItemManipulator;

class ItemApiController extends Controller{

	public function __construct(
		ItemInterface $item,
		ItemManipulator $manipulator,
		CategoryInterface $category
	)
	{
		$this->item 			= $item;
		$this->item_manipulator = $manipulator;
		$this->category 		= $category;
	}

	public function getUserItems(Request $request)
	{
		 return $this->item->getUserAds(Auth::id());
	}

	/**
	 * [destroy description]
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function destroy(Request $request, $id)
	{
		$item = $this->item->getById($id);

		if (Gate::denies('manage', $item)) {
            abort(403);
        }

        $result = $this->item_manipulator->delete($item);

        if($result){
        	return response()->json(['result' => true], 200);
        }else{
        	return response()->json([], 500);
        }
	}

	public function updatePrice(Request $request, $id)
	{
		$item = $this->item->getById($id);

		if (Gate::denies('manage', $item)) {
            abort(403);
        }

        if($this->item_manipulator->updatePrice($id, $request->input('i_price'))){
        	return $this->item->getById($id);
        }else{
        	return response()->json([], 500);
        }
	}

	/**
	 * [prolong description]
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function prolong(Request $request, $id)
	{
		$item = $this->item->getById($id);

		if (Gate::denies('manage', $item)) {
            abort(403);
        }

        if($item->recentlyProlonged()){
            return response()->json(['error' => 'prolonged'], 500);
        }

        $days = $this->category->getById($item->fk_i_category_id)->i_expiration_days;

        $this->item_manipulator->prolong($item, $days);

        return $this->item->getById($id);
	}

}