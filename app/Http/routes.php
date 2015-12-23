<?php

use App\Zabor\Repositories\MetaEloquentRepository;
use Carbon\Carbon;

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

Route::group(['prefix' => 'item'], function(){

	Route::get('add', 'ItemController@getAdd');
	Route::post('add', 'ItemController@store');

	Route::get('{id}', 'ItemController@show');
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
