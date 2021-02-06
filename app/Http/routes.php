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

Route::group(['middleware' => ['auth', 'role-permission']], function () {
    // Route::group(['middleware' => ['auth']], function () {
    /* all routes in this route group require auth */
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/roles/{role}/edit_permissions', 'RoleController@editPermissions')->name('role.edit_permissions');
    Route::post('/roles/{role}/update_permissions', 'RoleController@updatePermissions')->name('role.update_permissions');
    Route::resource('roles', 'RoleController');

    Route::resource('permissions', 'PermissionController');
});
