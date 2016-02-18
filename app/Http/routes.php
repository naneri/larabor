<?php

use App\Zabor\Repositories\MetaEloquentRepository;
use Carbon\Carbon;
use App\Zabor\Mysql\Item;

Route::get('/', 'MainController@index');

Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function(){

	Route::get('login', 'AuthController@getLogin')->name('login');

	Route::post('login', 'AuthController@postLogin');
	Route::get('register', 'AuthController@getRegister')->name('register');

	Route::post('register', 'AuthController@postRegister');
	Route::get('account/activate/{user_id}/{token}', 'AuthController@activateAccount');

	// Password reset link request routes...
	Route::get('password/email', 'PasswordController@getEmail');
	Route::post('password/email', 'PasswordController@postEmail');

	// Password reset routes...
	Route::get('password/reset/{email}/{token}', 'PasswordController@getReset');
	Route::post('password/reset', 'PasswordController@postReset');
});

Route::group([
	'namespace' => 'Admin', 
	'middleware' => 'is_admin',
	'prefix'	=> 'admin'], function(){
		
		Route::get('main', 'AdminController@index');
		Route::get('item/inactive', 'AdminController@inactiveItems');
		Route::get('item/activate', 'AdminController@activateItem');
		Route::post('item/block', 'AdminController@blockItem');
		Route::post('item/delete', 'AdminController@deleteItem');
	});

Route::group(['namespace' => 'Auth', 'middleware' => 'auth'], function(){
	
	Route::get('logout', 'AuthController@getLogout')->name('logout');


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
	
	Route::post('add-image', 'Api\ItemImageApiController@storeImage');
	Route::post('remove-image', 'Api\ItemImageApiController@removeImage');

	Route::get('show/{id}/{code?}', 'ItemController@show')->name('item.show');
	
	Route::get('edit/{id}/{code?}', 'ItemController@edit')->name('item.edit');
	Route::post('edit/{id}/{code?}', 'ItemController@update')->name('item.update');
	Route::get('prolong/{id}/{code?}', 'ItemController@prolong')->name('item.prolong');
	Route::get('delete/{id}/{code?}', 'ItemController@destroy')->name('item.delete');
	Route::post('contact_owner', 'ItemController@contact')->name('item.contact-owner');
});

Route::get('contacts', 'CustomController@contacts');
Route::post('contacts', 'CustomController@postMessage');
Route::get('search', 'SearchController@index')->name('search');

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function(){

	Route::get('category-meta/{category_id}', 'ApiCategoryController@getCategoryMetaHtml');
});

Route::get('user/ads/{id}', 'ProfileController@showAds')->name('user.ads');


Route::get('test/email', function(){
	 $item = Item::find(75000);
	 return view('emails.item.activated', compact('item'));
});
