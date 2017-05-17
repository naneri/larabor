<?php namespace App\Zabor\Items;

use App\Zabor\Mysql\MetaCategory;
use Carbon\Carbon;

use Config;
use App\Zabor\Mysql\Item;
use App\Zabor\Mysql\ItemDescription as Description;
use App\Zabor\Mysql\ItemLocation    as Location;
use App\Zabor\Mysql\ItemComment     as Comment;
use App\Zabor\Mysql\ItemStats       as Stats;
use App\Zabor\Mysql\ItemMeta        as Meta;
use App\Zabor\Images\ImageCreator;
use App\Zabor\Categories\CategoryStatsManager;
use Telegram\Bot\Api;

class ItemManipulator
{
    /**
     * @var ItemNotifier
     */
    private $itemNotifier;

    /**
     * ItemManipulator constructor.
     * @param ImageCreator $imageCreator
     * @param CategoryStatsManager $catManager
     * @param ItemNotifier $itemNotifier
     * @internal param Api $api
     */
    public function __construct(
        ImageCreator $imageCreator,
        CategoryStatsManager $catManager,
        ItemNotifier $itemNotifier
    ) {
        $this->imageCreator     = $imageCreator;
        $this->categoryManager  = $catManager;
        $this->itemNotifier = $itemNotifier;
    }

    /**
     * @param $item_data
     * @param $user
     * @param $days
     *
     * @return Item
     */
    public function store($item_data, $user, $days)
    {
        $item = new Item;
        $item->fk_i_user_id         = !is_null($user) ? intval($user->pk_i_id) : null;
        $item->fk_i_category_id     = $item_data['category'];
        $item->dt_pub_date          = Carbon::now()->toDateTimeString();
        $item->dt_update_date       = Carbon::now()->toDateTimeString();
        $item->i_price              = isset($item_data['price']) ? $item_data['price'] : null;
        $item->fk_c_currency_code   = $item_data['currency'];
        $item->s_contact_name       = isset($user->s_name) ? $user->s_name : null;
        $item->s_contact_email      = $item_data['seller-email'];
        $item->s_secret             = str_random(8);
        $item->b_active             = !is_null($user) ? true : false;
        $item->b_enabled            = true;

        if (isset($user->pk_i_id) &&
            in_array($user->pk_i_id, Config::get('zabor.affiliates'))
        ) {
            if ($user->pk_i_id == 25) {
                $days = (int) $days / 4;
            } else {
                $days = (int) $days / 2;
            }
        }
            
        $item->dt_expiration = Carbon::now()->addDays($days)->toDateTimeString();
        
        $item->save();

        $description = $this->storeOrUpdateDescription($item->pk_i_id, $item_data);
                
        $this->storeMetas($item, $item_data['meta']);

        $this->categoryManager->increaseCategoryStats(
            $item->fk_i_category_id,
            null,
            $item->b_active
        );

        $this->itemNotifier->notifyNewItem($item, $description);

        return $item;
    }

    /**
     * @param $item_data
     * @param $user
     * @param $id
     *
     * @return mixed
     */
    public function edit($item_data, $user, $id)
    {
        // Retrieving the item record
        $item =  Item::findOrFail($id);

        $item->fk_i_category_id     = $item_data['category'];
        $item->dt_mod_date          = Carbon::now()->toDateTimeString();
        $item->i_price              = isset($item_data['price']) ? $item_data['price']  : null;
        $item->fk_c_currency_code   = $item_data['currency'];
        $item->s_contact_name       = isset($user->s_name)       ? $user->s_name        : null;

        $item->save();

        $this->storeOrUpdateDescription($item->pk_i_id, $item_data);
        
        $this->storeMetas($item, $item_data['meta']);


        return $item->pk_i_id;
    }

    /**
     * @param $item_id
     * @param $item_data
     * @return bool
     */
    public function storeOrUpdateDescription($item_id, $item_data)
    {
        $description = Description::where('fk_i_item_id', $item_id)->firstOrNew([
            'fk_i_item_id'      => $item_id,
            'fk_c_locale_code'  => 'ru_Ru'
        ]);

        $description->s_title       = $item_data['title'];
        $description->s_description     = $item_data['description'];

        $description->save();

        return $description;
    }

    /**
     * @param $item
     * @param $meta_values
     */
    public function storeMetas($item, $meta_values)
    {
        // getting all item metas
        $metas = Meta::where('fk_i_item_id', $item->pk_i_id)->get();

        // deleting all old metas of $item that user did not send
        Meta::where('fk_i_item_id', $item->pk_i_id)->whereNotIn('fk_i_field_id', array_keys($meta_values))->delete();

        // getting all $item->category metas
        $actual_metas = MetaCategory::where('fk_i_category_id', $item->fk_i_category_id)->lists('fk_i_field_id');

        foreach ($actual_metas as $key) {
            if (isset($meta_values[$key])) {
                // checking if record exists or creating a new
                if (!$metas->where('fk_i_field_id', (int) $key)->isEmpty()) {
                    $meta = Meta::where('fk_i_field_id', (int) $key)
                        ->where('fk_i_item_id', $item->pk_i_id)
                        ->update(['s_value' => $meta_values[$key]]);
                } else {
                    Meta::create([
                        'fk_i_item_id'  => $item->pk_i_id,
                        'fk_i_field_id'     => $key,
                        's_value'       => $meta_values[$key]
                    ]);
                }
            }
        }
        // ToDo refactor to comply with DDD.
    }

    /**
     * @param $item
     * @param $days
     *
     * @return mixed
     */
    public function prolong($item, $days)
    {
        $old_date = $item->dt_expiration;

        $item->dt_update_date   = Carbon::now()->toDateTimeString();
        $item->dt_expiration    = Carbon::now()->addDays($days)->toDateTimeString();
        $item->save();

        $this->categoryManager->increaseCategoryStats(
            $item->fk_i_category_id,
            $old_date,
            $item->b_active
        );

        return $item;
    }

    /**
     * @param $item
     * @return bool
     */
    public function delete($item)
    {
        // ToDo refactor to comply with DDD.
        $item_id = $item->pk_i_id;
        foreach ($item->images as $image) {
            $this->imageCreator->delete($image->pk_i_id);
        }

        Description::where('fk_i_item_id', $item_id)->delete();
        Location::where('fk_i_item_id', $item_id)->delete();
        Stats::where('fk_i_item_id', $item_id)->delete();
        Comment::where('item_id', $item_id)->delete();
        Meta::where('fk_i_item_id', $item_id)->delete();

        Item::where('pk_i_id', $item_id)->delete();

        return true;
    }

    /**
     * [activate description]
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function activate($item_id)
    {
        Item::where('pk_i_id', $item_id)->update([
            'b_active' => 1,
            'b_enabled'     => 1,
            ]);

        return Item::find($item_id);
    }

    /**
     * @param $item_id
     * @return bool
     */
    public function block($item_id)
    {
        Item::where('pk_i_id', $item_id)->update([
                'b_enabled'     => 0
            ]);

        return true;
    }

    /**
     * @param $item_id
     */
    public function increase_count($item_id)
    {
        $stats = Stats::firstOrCreate([
                'fk_i_item_id'  => $item_id,
                'dt_date'       => Carbon::now()->toDateString()
            ]);

        Stats::where([
                'fk_i_item_id'  => $item_id,
                'dt_date'       => Carbon::now()->toDateString()
            ])->increment('i_num_views');
    }

    /**
     * @param $item_id
     * @param $price
     *
     * @return mixed
     */
    public function updatePrice($item_id, $price)
    {
        $item = Item::find($item_id);

        $item->i_price = $price;

        return $item->save();
    }
}
