<?php namespace App\Zabor\Mysql;

use Config;
use Carbon\Carbon;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends ZaborModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    protected $casts = [
        'info'      => 'array',
        'is_admin'  => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return mixed
     */
    public function getAuthPassword()
    {
        return $this->s_password;
    }

    /**
     * @return null
     */
    public function getRememberToken()
    {
        return null; // not supported
    }

    /**
     * @param string $value
     */
    public function setRememberToken($value)
    {
        // not supported
    }

    /**
     * @return null
     */
    public function getRememberTokenName()
    {
        return null; // not supported
    }


    /**
     * checks if user is admin
     */
    public function is_admin()
    {
        return $this->is_admin;
    }
    
    /**
    * Overrides the method to ignore the remember token.
    */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }

    /**
     * @return mixed
     */
    public function description()
    {
        return $this->hasOne(UserDescription::class, 'fk_i_user_id', 'pk_i_id')->where('fk_c_locale_code', 'ru_Ru');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function data()
    {
        return $this->hasOne(UserData::class, 'fk_i_user_id', 'pk_i_id');
    }

    /**
     * @return bool
     */
    public function canExport()
    {
        $info = $this->info;
        if (!empty($this->info['priceListUpdate'])) {
            if ($this->info['priceListUpdate']['updates']  >= Config::get('zabor.export.updates') &&
                $this->info['priceListUpdate']['date']     === Carbon::now()->toDateString()
            ) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return null
     */
    public function getExportPath()
    {
        if (!empty($this->info['priceListUpdate'])) {
            return $this->info['priceListUpdate']['path'];
        }

        return null;
    }
}
