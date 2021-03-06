<?php


Route::get('/', 'MainController@index');


// Auth Routes
Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function () {

    // login and register standard routes
    Route::get('login', 'AuthController@getLogin')->name('login');
    Route::post('login', 'AuthController@postLogin');
    Route::get('register', 'AuthController@getRegister')->name('register');
    Route::post('register', 'AuthController@postRegister');
    // account activation and reactivation if first mail did not reach
    Route::get('account/activate/{user_id}/{token}', 'AuthController@activateAccount');
    Route::get('account/reactivate/{email}', 'AuthController@reActivate')->name('reactivate');
    // Password reset link request routes...
    Route::get('password/email', 'PasswordController@getEmail')->name('reset.password');
    Route::post('password/email', 'PasswordController@postEmail');
    // Password reset routes...
    Route::get('password/reset/{email}/{token}', 'PasswordController@getReset');
    Route::post('password/reset', 'PasswordController@postReset');
});


// Admin Routes
Route::group([
    'namespace' => 'Admin',
    'middleware' => 'is_admin',
    'prefix'    => 'admin'], function () {
        
        Route::get('main', 'AdminController@index');
        Route::get('item/get-inactive-items', 'AdminItemController@getInactiveItems');
        Route::get('item/user-items', 'AdminItemController@getUserItems');
        Route::get('item/inactive', 'AdminItemController@inactiveItems');
        Route::post('item/activate/{id}', 'AdminItemController@activateItem');
        Route::post('item/block/{id}', 'AdminItemController@blockItem');
        Route::delete('item/delete/{id}', 'AdminItemController@deleteItem')->name("admin.item.delete");
        Route::get('items/non-affiliate', 'AdminItemController@userItems');
        Route::get('items/comments', 'AdminItemController@comments');
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

        Route::get('article/add', 'AdminArticleController@getAdd')->name('admin.add-article');
        Route::post('article/add', 'AdminArticleController@postAdd')->name('admin.post-article');
        Route::get('article/delete/{id}', 'AdminArticleController@delete')->name('admin.delete-article');
        Route::get('article/edit/{id}', 'AdminArticleController@edit')->name('admin.edit-article');
        Route::post('article/update/{id}', 'AdminArticleController@update')->name('admin.update-article');
        Route::get('article/list', 'AdminArticleController@index')->name('admin.article-list');
    });

Route::group(['namespace' => 'Auth', 'middleware' => 'auth'], function () {
    
    Route::get('logout', 'AuthController@getLogout')->name('logout');
});

// Profile Routes
Route::group([
    'middleware' => 'auth',
    'prefix'     => 'profile'], function () {
    
        Route::get('main', 'ProfileController@index')->name('profile.main');
        Route::get('notifications', 'ProfileController@notifications')->name('profile.notifications');
        Route::put('notifications/update', 'ProfileController@updateNotifications')->name('profile.notifications.update');
        Route::get('ads', 'ProfileController@getAds')->name('profile.ads');
        Route::get('ads-export', 'ProfileController@getAdsExport')->name('profile.ads-export');
        Route::get('generate-excel', 'ProfileController@getGenerateExcel')->name('profile.generate-excel');
        Route::post('update', 'ProfileController@update')->name('profile.update');
        Route::post('update-pass', 'ProfileController@updatePass')->name('profile.update-pass');
    });

Route::group(['prefix' => 'item'], function () {

    Route::get('add', 'ItemController@getAdd');
    Route::post('add', 'ItemController@store');
    
    // Dropzone image api routes
    Route::post('add-image', 'Api\ItemImageApiController@storeImage');
    Route::post('remove-image', 'Api\ItemImageApiController@removeImage');

    // showing item
    Route::get('show/{id}/{code?}', 'ItemController@show')->name('item.show');
    Route::get('edit/{id}/{code?}', 'ItemController@edit')->name('item.edit');
    Route::post('edit/{id}/{code?}', 'ItemController@update')->name('item.update');
    Route::get('prolong/{id}/{code?}', 'ItemController@prolong')->name('item.prolong');
    Route::get('delete/{id}/{code?}', 'ItemController@destroy')->name('item.delete');
    Route::post('contact_owner', 'ItemController@contact')->name('item.contact-owner');
});

Route::group(['prefix' => 'article'], function () {
    Route::get('/all', 'ArticleController@index')->name('article.index');
    Route::get('show/{slug}', 'ArticleController@show')->name('article.show');
});
Route::get('contacts', 'CustomController@contacts');
Route::post('contacts', 'CustomController@postMessage');
Route::get('search', 'SearchController@index')->name('search');

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {

    Route::get('category-meta/{category_id}', 'ApiCategoryController@getCategoryMetaHtml');

    Route::get('user/items', 'ItemApiController@getUserItems');
    Route::put('item/updatePrice/{id}', 'ItemApiController@updatePrice');
    Route::put('item/prolong/{id}', 'ItemApiController@prolong');
    Route::delete('item/delete/{id}', 'ItemApiController@destroy');

    Route::get('item/{item_id}/comments', 'ItemCommentApiController@getComments')->name('api.item.comments');
    Route::post('item/{item_id}/comments', 'ItemCommentApiController@postComment')->name('api.item.comments.post');
});

Route::get('user/ads/{id}', 'ProfileController@showAds')->name('user.ads');
Route::get('test/crawler', 'MainController@testCrawler');




Route::group(['prefix' => 'text'], function (){

    Route::get('gate', function(){
        dd(Gate::forUser(\App\Zabor\Mysql\User::skip(3)->first())->denies('manage', \App\Zabor\Mysql\Item::first()));
    });

    Route::get('comment', function (){
        $comment = \App\Zabor\Mysql\ItemComment::first();
        $user = \App\Zabor\Mysql\User::first();

        Mail::queue('emails.comment', compact('comment', 'user'), function ($m) use ($comment, $user) {
            $m->from('hello@app.com', 'Your Application');
            $m->to('ktnaneri@gmail.com', $user->name)->subject('Your Reminder!');
        });
    });

});