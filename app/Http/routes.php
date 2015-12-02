<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Zabor\Mysql\Item;

Route::get('/', 'MainController@index');

Route::get('/login', function(){
	return view('auth.login');
});

Route::get('/register', function(){
	return view('auth.register');
});

Route::get('/item/add', function(){
	return view('item.add');
});

Route::get('contacts', function(){
	return view('custom.contacts');
});