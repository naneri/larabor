<?php namespace App\Zabor\Items;

use App\Zabor\Services\AbstractRepository;
use App\Zabor\Items\ExpirationException;
use App\Zabor\Mysql\Archive;
use Carbon\Carbon;
use Config;

use App\Zabor\Mysql\Item;
use App\Zabor\Items\Contracts\ItemInterface;
use Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ItemEloquentRepository extends AbstractRepository implements ItemInterface
{

    public function __construct(Item $model)
    {
        $this->model = $model;
    }

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
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     * @throws ExpirationException
     */
    public function getById($id)
    {
        $item = Archive::where('type', 'item')->where('entity_id', $id)->first();

        if(!is_null($item)){
            throw new ExpirationException('item archived');
        }

        return Item::with([
            'images',
            'category.description',
            'description',
            'currency',
            'user',
            'metas.meta',
            'stats'
            ])->findOrFail($id);
    }

    /**
     * @param $user_id
     * @return mixed
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
    public function getUserActiveAds($user_id, $limit = null)
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
                ->orderBy('dt_update_date', 'DESC')
                ->paginate(8);
    }

    /**
     * @return mixed
     */
    public function countActive()
    {
        return  Cache::remember('count_main_items', 1, function () {
                return Item::where('b_enabled', 1)
                            ->where('b_active', 1)
                            ->where('dt_expiration', '>', Carbon::now())
                            ->count();
        });
    }


    /**
     * @param $data
     * @param null $category_id_list
     *
     * @return mixed
     */
    public function searchItems($data, $category_id_list = null)
    {
        $orderBy    = isset($data['orderBy'])  ? $data['orderBy']  : 'dt_update_date';

        $order_type = isset($data['orderType']) ? $data['orderType'] : 'DESC';

        // expiration date should be more than now
        $query = Item::where('dt_expiration', '>', Carbon::now())
            ->where('b_active', 1)
            ->where('b_enabled', 1)
            ->orderBy($orderBy, $order_type);
        
        // list of categories to search in
        if (!empty($category_id_list)) {
            $query->whereIn('fk_i_category_id', $category_id_list);
        }

        // currency
        if (!empty($data['currency'])) {
            $query->where('fk_c_currency_code', $data['currency']);
        }

        // min price
        if (!empty($data['minPrice'])) {
            $query->where('i_price', '>=', $data['minPrice']*1000000);
        }

        // max price
        if (!empty($data['maxPrice'])) {
            $query->where('i_price', '<=', $data['maxPrice']*1000000);
        }
        
        // search text
        if (!empty($data['text'])) {
            $text = $data['text'];
            $query = $query->whereHas('description', function ($query) use ($text) {
                $query->where(function ($query) use ($text) {
                    $query->where('s_title', 'LIKE', '%'.$text.'%')
                        ->orWhere('s_description', 'LIKE', '%'.$text.'%');
                });
            });
        }

        if (isset($data['meta'])) {
            foreach ($data['meta'] as $key => $value) {
                $query = $query->whereHas('metas', function ($inner_query) use ($key, $value) {
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
     * @param $id_list
     *
     * @return mixed
     */
    public function countCategoryCustomActiveItems($id_list)
    {
        return $this->model
                    ->whereIn('fk_i_category_id', $id_list)
                    ->where('dt_expiration', '>', Carbon::now())
                    ->where('b_enabled', 1)
                    ->where('b_active', 1)
                    ->where(function ($query) {
                        $query->whereNotIn('fk_i_user_id', Config::get('zabor.affiliates'))
                            ->orWhere('fk_i_user_id', null);
                    })
                    ->get()
                    ->count();
    }

    /**
     * @param $day_limit
     *
     * @return mixed
     */
    public static function customLastAdsCount($day_limit)
    {

        return Item::where('dt_pub_date', '>', Carbon::now()->subDays($day_limit))
                ->where('b_enabled', 1)
                ->where('b_active', 1)
                ->where(function ($query) {
                    $query->whereNotIn('fk_i_user_id', Config::get('zabor.affiliates'))
                        ->orWhere('fk_i_user_id', null);
                })
                ->count();
    }

    /**
     * @return mixed
     */
    static function activeCustomAdsCount()
    {
        return Item::where('dt_expiration', '>=', Carbon::now())
                    ->where('b_enabled', 1)
                    ->where('b_active', 1)
                    ->where(function ($query) {
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
    public function getCustomInactiveItems()
    {
        return Item::where('b_active', 0)
                ->orderBy('dt_pub_date', 'DESC')
                ->with([
                    'category.description',
                    'description',
                    'currency',
                    'lastImage',
                    'stats'
                ])
                ->paginate(30);
    }

    /**
     * @param Item $item
     * @return mixed
     */
    public function find_related(Item $item)
    {
        return Item::where('b_enabled', 1)
                    ->where('pk_i_id', '!=', $item->pk_i_id)
                    ->where('b_active', 1)
                    ->where('dt_expiration', '>', Carbon::now())
                    ->where('fk_i_category_id', $item->fk_i_category_id)
                    ->take(3)
                    ->orderByRaw("RAND()")
                    ->with([
                        'description',
                        'currency',
                        'lastImage',
                        'stats'
                    ])
                    ->get();
    }

    /**
     * @return mixed
     */
    public function getCustomItems()
    {
        return Item::where('b_enabled', 1)
                    ->where('b_active', 1)
                    ->where('dt_expiration', '>', Carbon::now())
                    ->where(function ($query) {
                        $query->whereNotIn('fk_i_user_id', Config::get('zabor.affiliates'))
                            ->orWhere('fk_i_user_id', null);
                    })
                    ->with([
                        'category.description',
                        'description',
                        'currency',
                        'lastImage',
                        'stats'
                    ])
                    ->orderBy('dt_pub_date', 'DESC')
                    ->paginate(30);
    }

    /**
     * @return mixed
     */
    public static function getOldItems()
    {
        return Item::where('dt_expiration', '<', Carbon::now()->subDays(90))
                    ->with(['images',
                            'category.description',
                            'description',
                            'currency',
                            'user',
                            'metas.meta'
                            ])
                    ->take(100)
                    ->get();
    }

    /**
     * [getUserAdsForExport description]
     * @param  integer $user_id [description]
     * @return array          [description]
     */
    public function getUserAdsForExport($user_id)
    {
        $ads = [];

        Item::with([
                'category.description',
                'description',
                'currency',
            ])
                ->where('fk_i_user_id', $user_id)
                ->where('b_enabled', 1)
                ->where('b_active', 1)
                ->where('dt_expiration', '>', Carbon::now())
                ->orderBy('dt_update_date', 'DESC')
                ->take(500)
                ->chunk(100, function ($items) use (&$ads) {
                    foreach ($items as $key => $item) {
                        $ads[] = [
                            'id'        => $item->pk_i_id,
                            'name'      => $item->description->s_title,
                            'category'  => $item->category->description->s_name,
                            'price'     => $item->formatedPrice(),
                            'currency'  => !is_null($item->i_price) ? $item->currency->s_description : ''
                        ];
                    }
                });

        return $ads;
    }
}
