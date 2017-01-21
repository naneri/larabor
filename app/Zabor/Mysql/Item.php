<?php namespace App\Zabor\Mysql;

use Carbon\Carbon;
use Config;

class Item extends ZaborModel
{
    protected $table = "item";

    protected $guarded = [];

    protected $appends = [
        'edit_link',
        'show_link',
        'js_image',
        'view_stats',
        'show_date',
        'show_expiration',
        'recently_prolonged',
    ];

    protected $casts = [
        'b_active'  => 'boolean',
        'b_enabled' => 'boolean'
    ];

    protected $dates = ['dt_pub_date', 'dt_mod_date', 'dt_update_date', 'dt_expiration'];
    /**
    *
    *   Query functions
    *
    */

    public function images()
    {
        return $this->hasMany(Item_resource::class, 'fk_i_item_id', 'pk_i_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastImage()
    {
        return $this->hasOne(Item_resource::class, 'fk_i_item_id', 'pk_i_id');
    }

    /**
     * @return [type]
     */
    public function description()
    {
        return $this->hasOne(Item_description::class, 'fk_i_item_id', 'pk_i_id')->where('fk_c_locale_code', 'ru_Ru');
    }

    /**
     * @return [type]
     */
    public function location()
    {
        return $this->hasOne(Item_location::class, 'fk_i_item_id', 'pk_i_id');
    }

    /**
     * @return [type]
     */
    public function stats()
    {
        return $this->hasMany(Item_stats::class, 'fk_i_item_id', 'pk_i_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'fk_i_category_id', 'pk_i_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'fk_c_currency_code', 'pk_c_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_i_user_id', 'pk_i_id');
    }

    public function metas()
    {
        return $this->hasMany(Item_meta::class, 'fk_i_item_id', 'pk_i_id');
    }



    /**
    *
    *   Model functions
    *
    */

    /**
     * getting image to display - if item has no images default empty photo URL is returned
     * @return [type] [description]
     */
    public function demo_image()
    {
        if (!empty($this->lastImage)) {
            return $this->lastImage->thumbnailUrl();
        } else {
            return Config::get('zabor.item_no_image');
        }
    }

    /**
     * @return [type]
     */
    public function formatedPrice()
    {
        if (!empty($this->i_price)) {
            return number_format($this->i_price, 0, ',', ' ');
        }

        return null;
    }

    public function showDescription()
    {
        return $this->description->s_description;
    }

    public function showPubDate()
    {
        $time = new Carbon($this->dt_pub_date);

        return $time->toDateString();
    }

    /**
     * checks if item is actual
     * @return boolean [description]
     */
    public function is_actual()
    {
        if ($this->b_enabled == 1 && $this->b_active == 1 && $this->dt_expiration >= Carbon::now()) {
            return true;
        }
        return false;
    }

    /**
     * [is_active description]
     * @return boolean [description]
     */
    public function is_active()
    {
        if ($this->dt_expiration > Carbon::now()) {
            return true;
        }
        return false;
    }

    public function getIPriceAttribute($value)
    {
        if (!empty($value)) {
            return $value/1000000;
        }
        
        return null;
    }

    public function setIPriceAttribute($value)
    {
        $this->attributes['i_price'] = $value * 1000000;
    }

    
    public function getFkICategoryIdAttribute($value)
    {
        return (int) $value;
    }

    /**
     * @return bool
     */
    public function recentlyProlonged()
    {
        return $this->dt_update_date->diffInDays(Carbon::now()) < 2;
    }

    /**
     * @return string
     */
    public function showExpirationDate()
    {
        $time = new Carbon($this->dt_expiration);

        return $time->toDateString();
    }

    /**
     * @return bool
     */
    public function is_old()
    {
        return $this->dt_expiration < Carbon::now();
    }

    /**
     * get Item "Edit" link
     * @return [type] [description]
     */
    public function getEditLinkAttribute()
    {
        return route('item.edit', [$this->attributes['pk_i_id'], $this->attributes['s_secret']]);
    }

    /**
     * @return string
     */
    public function getShowLinkAttribute()
    {
        return route('item.show', [$this->attributes['pk_i_id']]);
    }

    public function getJsImageAttribute()
    {
        if (!empty($this->lastImage()->first())) {
            return asset($this->lastImage->thumbnailUrl());
        } else {
            return asset(Config::get('zabor.item_no_image'));
        }
    }

    public function getViewStatsAttribute()
    {
        return $this->stats->sum('i_num_views');
    }

    public function getShowDateAttribute()
    {
        $time = new Carbon($this->attributes['dt_pub_date']);

        return $time->toDateString();
    }

    public function getShowExpirationAttribute()
    {
        $time = new Carbon($this->attributes['dt_expiration']);

        return $time->toDateString();
    }

    public function getRecentlyProlongedAttribute()
    {
        $date = Carbon::parse($this->attributes['dt_update_date']);

        return $date->diffInDays(Carbon::now()) < 2;
    }
}
