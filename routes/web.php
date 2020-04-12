<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes([
    'register' => false,
    'verify' => true,
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'Admin\AdminController@index');
    Route::get('/users/create', 'Admin\UserController@create')->middleware('permission:add-user');
    Route::POST('/users', 'Admin\UserController@store')->middleware('permission:add-user');
    Route::get('/users', 'Admin\UserController@index')->middleware('permission:view-user');
    Route::get('/users/{id}/edit', 'Admin\UserController@edit')->middleware('permission:edit-user');
    Route::PATCH('/users/{id}', 'Admin\UserController@update')->middleware('permission:edit-user');
    Route::DELETE('/users/{id}', 'Admin\UserController@destroy')->middleware('permission:delete-user');
    Route::get('/user-settings', 'Admin\UserController@userSettings');
    Route::POST('/change-password', 'Admin\UserController@changePassword');
    Route::PATCH('/change-user-image', 'Admin\UserController@changeUserImage');
});
Route::resource('platforms', 'Admin\\PlatformsController');