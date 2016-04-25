<?php namespace App\Zabor\Mysql;

use Config; 
use Carbon\Carbon;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends ZaborModel implements AuthenticatableContract,
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
        'info' => 'array',
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
     * [getAuthPassword description]
     * @return [type] [description]
     */
    public function getAuthPassword()
    {
        return $this->s_password;
    }

    /**
     * [getRememberToken description]
     * @return [type] [description]
     */
    public function getRememberToken()
    {
        return null; // not supported
    }

    /**
     * [setRememberToken description]
     * @param [type] $value [description]
     */
    public function setRememberToken($value)
    {
        // not supported
    }

    /**
     * [getRememberTokenName description]
     * @return [type] [description]
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
        if($this->is_admin == 1){
            return true;
        }
        return false;
    }
    
    /**
    * Overrides the method to ignore the remember token.
    */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
          parent::setAttribute($key, $value);
        }
    }

    /**
     * [description description]
     * @return [type] [description]
     */
    public function description()
    {
        return $this->hasOne('App\Zabor\Mysql\User_description', 'fk_i_user_id', 'pk_i_id')->where('fk_c_locale_code', 'ru_Ru');            
    }

    /**
     * [data description]
     * @return [type] [description]
     */
    public function data()
    {
        return $this->hasOne(UserData::class, 'fk_i_user_id', 'pk_i_id');
    }

    /**
     * [canExport description]
     * @return [type] [description]
     */
    public function canExport()
    {
        $info = $this->info;
        if(!empty($this->info['priceListUpdate'])){
            if( $this->info['priceListUpdate']['updates']  >= Config::get('zabor.export.updates') && 
                $this->info['priceListUpdate']['date']     === Carbon::now()->toDateString()
            ){
                return false;
            }
        }

        return true;
    }
    
    /**
     * [getExportPath description]
     * @return [type] [description]
     */
    public function getExportPath()
    {
        $info = $this->info;

        if(!empty($this->info['priceListUpdate'])){
            return $this->info['priceListUpdate']['path'];
        }

        return null;
    }

}
