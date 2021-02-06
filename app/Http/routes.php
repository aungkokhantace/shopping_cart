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

Route::auth();

// Route::group(['middleware' => ['auth']], function () {
Route::group(['middleware' => ['auth', 'role-permission']], function () {
    /* all routes in this route group require auth */
    Route::get('/', 'Frontend\ItemController@index')->name('frontend.items.index');
    Route::get('/frontend/items', 'Frontend\ItemController@index')->name('frontend.items.index');

    // start cart routes
    Route::get('/view_cart', 'Frontend\ItemController@viewCart')->name('cart.view');
    Route::get('/add_to_cart/{id}', 'Frontend\ItemController@addToCart')->name('cart.add');
    Route::get('/remove_from_cart/{id}', 'Frontend\ItemController@removeFromCart')->name('cart.remove');
    Route::post('/checkout', 'Frontend\ItemController@checkout')->name('cart.checkout');
    // end cart routes

    Route::get('/view_transactions', 'Frontend\TransactionController@index')->name('frontend.transactions.list');
    Route::get('/view_transactions/detail/{id}', 'Frontend\TransactionController@show')->name('frontend.transactions.detail');
    // end frontend routes

    // start backend routes
    Route::resource('items', 'ItemController');
    Route::resource('customers', 'CustomerController');

    Route::get('/transactions', 'TransactionController@index')->name('transactions.list');
    Route::get('/transactions/detail/{id}', 'TransactionController@show')->name('transactions.detail');
    // end backend routes
});
