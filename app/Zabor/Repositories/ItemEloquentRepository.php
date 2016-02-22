<?php namespace App\Zabor\Repositories;

use Carbon\Carbon;
use Config;

use App\Zabor\Mysql\Item;
use App\Zabor\Mysql\Category;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Mysql\Item_meta as Meta;
use Cache;

class ItemEloquentRepository implements ItemInterface
{

	/**
	 * Gets Last Items
	 * 
	 * @return Item|null 
	 */
	public function getLast()
	{
		return Item::take(10)->with([
            'category.description', 
            'description', 
            'currency', 
            'lastImage',
            'stats'
        ])
			->where('b_enabled', 1)
			->where('b_active', 1)
			->where('dt_expiration', '>', Carbon::now())
			->orderBy('dt_pub_date', 'DESC')
		  	->get();
	}

	/**
	 * Gives full item info with Metas on given ID
	 * 
	 * @param  [int] $id 
	 * 
	 * @return [Item]     
	 */
	public function getById($id)
	{
		return Item::with([
			'images', 
			'category.description', 
			'description', 
			'currency', 
			'user',
			'metas.meta'
			])->findOrFail($id);
	}

	/**
	 * [getUserAds description]
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	public function getUserAds($user_id)
	{
		return Item::with([
	            'category.description', 
	            'description', 
	            'currency', 
	            'lastImage',
	            'stats'
            ])
				->where('fk_i_user_id', $user_id)
				->orderBy('dt_pub_date', 'DESC')
			  	->paginate(10);
	}

	/**
	 * [getUserActiveAds description]
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	public function getUserActiveAds($user_id)
	{
		return Item::with([
	            'category.description', 
	            'description', 
	            'currency', 
	            'lastImage',
	            'stats'
            ])
				->where('fk_i_user_id', $user_id)
				->where('b_enabled', 1)
				->where('b_active', 1)
				->where('dt_expiration', '>', Carbon::now())
				->orderBy('dt_pub_date', 'DESC')
			  	->paginate(8);
	}

	/**
	 * Gives number of currently active items
	 *  
	 * @return [int] number of Active items
	 */
	public function countActive()
	{
		return  Cache::remember('count_main_items', 1 ,function(){
				return Item::where('b_enabled', 1)
							->where('b_active', 1)
							->where('dt_expiration', '>', Carbon::now())
							->count();
				});
	}

	

	/**
	 * searches items by given constraints
	 * 
	 * @param  [array] $data 
	 * @return [type]       
	 */
	public function searchItems($data, $category_id_list = null)
	{
		$orderBy 	= isset($data['orderBy'])  ? $data['orderBy']  : 'dt_pub_date';

		$order_type = isset($data['orderType']) ? $data['orderType'] : 'DESC';

		// expiration date should be more than now
		$query = Item::where('dt_expiration', '>', Carbon::now())
			->where('b_active', 1)
			->where('b_enabled', 1)
			->orderBy($orderBy, $order_type);
		
		// list of categories to search in
		if(!empty($category_id_list)){
			$query->whereIn('fk_i_category_id', $category_id_list);
		}

		// currency
		if(!empty($data['currency'])){
			$query->where('fk_c_currency_code', $data['currency']);
		}	

		// min price
		if(!empty($data['minPrice'])){
			$query->where('i_price', '>=', $data['minPrice']*1000000);
		}

		// max price
		if(!empty($data['maxPrice'])){
			$query->where('i_price', '<=', $data['maxPrice']*1000000);
		}
		
		// search text
		if(!empty($data['text'])){
			$text = $data['text'];
			$query = $query->whereHas('description', function($query) use ($text){
				$query->where(function($query) use ($text){
					$query->where('s_title', 'LIKE', '%'.$text.'%')
						->orWhere('s_description', 'LIKE', '%'.$text.'%');
				});
			});
		}

		if(isset($data['meta'])){
			foreach($data['meta'] as $key => $value){
				$query = $query->whereHas('metas', function($inner_query) use ($key, $value){
					$inner_query->where('fk_i_field_id', $key)->where('s_value', $value);
				});
			}
		}

		$query->with([
	            'category.description', 
	            'description', 
	            'currency', 
	            'lastImage',
	            'stats',
	            'metas'
            ]);

		return $query->paginate(10);
	}


	/**
     * gets number of ads posted by non affiliates in last days
     *  
     * @param  [type] $day_limit [limit of days to count the ads]
     * @return [type]            [description]
     */
    public static function customLastAds($day_limit)
    {

        return Item::where('dt_pub_date', '>', Carbon::now()->subDays($day_limit))
    			->where('b_enabled', 1)
				->where('b_active', 1)
                ->where(function($query){
                    $query->whereNotIn('fk_i_user_id', Config::get('zabor.affiliates'))
                        ->orWhere('fk_i_user_id', null);
                })
                ->count();
    }

    /**
     * [activeCustomAds description]
     * @return [type] [description]
     */
    static function activeCustomAds()
    {
        return Item::where('dt_expiration', '>=', Carbon::now())
        			->where('b_enabled', 1)
					->where('b_active', 1)
                    ->where(function($query){
                        $query->whereNotIn('fk_i_user_id', Config::get('zabor.affiliates'))
                            ->orWhere('fk_i_user_id', null);
                    })
                    ->count();
    }

    /**
     * Get custom inactive ads
     * 
     * @return [type] [description]
     */
    public function getCustomInactiveItems($order_param)
    {
    	return Item::where('b_active', 0)
  								->orderBy($order_param, 'DESC')
					    		->with([
					            'category.description', 
					            'description', 
					            'currency', 
					            'lastImage',
					            'stats'
					        ])
					    		->paginate();
    }


}