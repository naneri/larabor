<?php namespace App\Zabor\User;

use App\Zabor\Mysql\User;

class UserEloquentRepository{

	public function getUserInfo($user_id)
	{
		return User::with('description')->findOrFail($user_id);
	}
}