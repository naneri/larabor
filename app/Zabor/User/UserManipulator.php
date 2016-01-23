<?php namespace App\Zabor\User;

use App\Zabor\Mysql\User;
use App\Zabor\Mysql\User_description;

class UserManipulator{


	public function update_details($user_id, $user_details)
	{

		$user = User::findOrFail($user_id);

		$user->s_name = $user_details['name'];
		$user->s_phone_land = $user_details['phone'];
		$user->s_address = $user_details['address'];

		$result = $user->save();

		User_description::where('fk_i_user_id', $user_id)
			->where('fk_c_locale_code', 'ru_RU')
			->update([
				's_info' => $user_details['description']
				]);
	}


}