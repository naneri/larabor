<?php namespace App\Zabor\User;

use App\Zabor\Mysql\User;
use App\Zabor\Mysql\UserDescription;
use App\Zabor\Mysql\UserData;
use Carbon\Carbon;

class UserManipulator
{
    /**
     * @param array $params
     *
     * @return User
     */
    public function createUser($params)
    {
        $user = User::create([
            'dt_reg_date'   => Carbon::now(),
            's_name'        => $params['username'],
            's_password'    => bcrypt($params['password']),
            's_secret'      => str_random(8),
            's_email'       => $params['email'],
            'b_enabled'     => 1,
            'b_active'      => 0,
            'i_items'       => 0,
            'i_comments'    => 0,
            'dt_access_date'=> Carbon::now()
        ]);

        UserDescription::create([
            'fk_i_user_id' => $user->pk_i_id,
            'fk_c_locale_code' => 'ru_RU'
        ]);

        UserData::create(['fk_i_user_id'    => $user->pk_i_id]);

        return $user;
    }

    /**
     * @param $user_id
     * @param $user_details
     */
    public function update_details($user_id, $user_details)
    {
        $user = User::findOrFail($user_id);

        $user->s_name       = $user_details['name'];
        $user->s_phone_land = $user_details['phone'];
        $user->s_address    = $user_details['address'];

        $user->save();

        $description = UserDescription::firstOrCreate([
                'fk_i_user_id' => $user_id,
                'fk_c_locale_code' => 'ru_RU'
            ]);

        $description->s_info = $user_details['description'];

        $description->save();
    }

    /**
     * @param $user
     * @param $password
     */
    public function updatePassword($user, $password)
    {
        $user->update([
            's_password'    => bcrypt($password),
        ]);
    }
}
