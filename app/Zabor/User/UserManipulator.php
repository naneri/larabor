<?php namespace App\Zabor\User;

use App\Zabor\Mysql\User;
use App\Zabor\Mysql\User_description;

class UserManipulator
{

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

        $description = User_description::firstOrCreate([
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
