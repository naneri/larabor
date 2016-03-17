<?php namespace App\Zabor\User;

use App\Zabor\Mysql\Item;
use App\Zabor\Mysql\User;
use Carbon\Carbon;
use DB;

class UserEloquentRepository{

	public function getUserInfo($user_id)
	{
		return User::with('description')->findOrFail($user_id);
	}

	public function getTopSellers()
	{
		return Item::select(DB::raw('count(*) as item_count, fk_i_user_id'))
			->where('dt_expiration', '>', Carbon::now())
			->groupBy('fk_i_user_id')
			->whereNotNull('fk_i_user_id')
			->orderBy('item_count', 'DESC')
			->with('user')
			->take(20)
			->get();
	}

	public function findById($id)
	{
		return User::find($id);
	}

	public function findByEmail($email)
	{
		return User::where('s_email', $email)->first();
	}
}