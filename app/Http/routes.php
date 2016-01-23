<?php

use App\Zabor\Repositories\MetaEloquentRepository;
use Carbon\Carbon;
use App\Zabor\Mysql\Item;

Route::get('/', 'MainController@index');

Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function(){

	Route::get('login', function(){
		return view('auth.login');
	});

	Route::post('auth/login', 'AuthController@postLogin');
	Route::get('register', function(){
		return view('auth.register');
	});

	Route::post('register', 'AuthController@postRegister');
	Route::get('account/activate/{user_id}/{token}', 'AuthController@ActivateAccount');
});

Route::group(['namespace' => 'Auth', 'middleware' => 'auth'], function(){
	
	Route::get('logout', 'AuthController@getLogout');


});

Route::group(['middleware' => 'auth'], function(){
	//profile
	Route::get('profile/main', 'ProfileController@index')->name('profile.main');
	Route::get('profile/ads', 'ProfileController@getAds')->name('profile.ads');
	Route::post('profile/update', 'ProfileController@update')->name('profile.update');
	Route::post('profile/update-pass', 'ProfileController@updatePass')->name('profile.update-pass');
});

Route::group(['prefix' => 'item'], function(){

	Route::get('add', 'ItemController@getAdd');
	Route::post('add', 'ItemController@store');
	Route::post('add-image', 'ItemController@storeImage');
	Route::get('show/{id}/{code?}', 'ItemController@show')->name('item.show');
	Route::post('remove-image', 'ItemController@removeImage');
	Route::get('edit/{id}/{code?}', 'ItemController@edit')->name('item.edit');
	Route::post('edit/{id}/{code?}', 'ItemController@update')->name('item.update');
	Route::get('prolong/{id}/{code?}', 'ItemController@prolong')->name('item.prolong');
	Route::get('delete/{id}/{code?}', 'ItemController@destroy')->name('item.delete');
});

Route::get('contacts', 'CustomController@contacts');
Route::post('contacts', 'CustomController@postMessage');
Route::get('search', 'SearchController@index')->name('search');






Route::group(['prefix' => 'api', 'namespace' => 'Api'], function(){

	Route::get('category-meta/{category_id}', 'ApiCategoryController@getCategoryMetaHtml');
});


/* 	Misc routes for testing;
*/
Route::get('carbon', function(){
	echo "<pre>"; print_r(Carbon::now()->addDays(30)->toDateTimeString()); echo "</pre>";
	exit;
});
Route::get('check', function(){
	$user = \App\Zabor\Mysql\User::first();
	return view('email/activate-account',['user' => $user]);
});

Route::get('check/resp', function(){
	return view('email.contact-us');
});