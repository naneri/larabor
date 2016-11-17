<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use Carbon\Carbon;


$factory->define(App\Zabor\Mysql\Item::class, function (Faker\Generator $faker){

	$categories = App\Zabor\Mysql\Category::whereNotNull('fk_i_parent_id')->get()->lists('pk_i_id')->toArray();
	$currencies = App\Zabor\Mysql\Currency::get()->lists('pk_c_code')->toArray();

	return [
		'fk_i_user_id'		=> null,
		'fk_i_category_id'	=> $categories[array_rand($categories)],
		'dt_pub_date'		=> Carbon::now()->toDateTimeString(),
		'dt_update_date'	=> Carbon::now()->toDateTimeString(),
		'i_price'			=> 1000000,
		'fk_c_currency_code'=> $currencies[array_rand($currencies)],
		's_contact_name'	=> null,
		's_contact_email'	=> $faker->email,
		's_secret'			=> str_random(8),
		'b_active'			=> 1,
		'b_enabled'			=> 1,
		'dt_expiration'		=> Carbon::now()->addDays(3333)->toDateTimeString(),
	];
});

$factory->define(App\Zabor\Mysql\Item_description::class, function(Faker\Generator $faker){
	return [
		'fk_c_locale_code'	=> 'ru_Ru',
		's_title'		=> $faker->sentence(3),
		's_description'	=> $faker->paragraph()
	];
});

$factory->define(App\Zabor\Mysql\User::class, function(Faker\Generator $faker){
	
});