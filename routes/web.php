<?php

use App\Http\Controllers\MainController;
use Illuminate\Routing\RouteGroup;
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

Route::get('/', function () {
    return redirect()->route('groups');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('users', 'MainController@users')->name('users');
    Route::get('users/{user_id}', 'MainController@user')->name('user');
    Route::get('groups', 'MainController@groups')->name('groups');
    Route::get('groups/{group_id}', 'MainController@group')->name('group');
    Route::get('groups/{group_id}/users/add', 'MainController@addUser')->name('addUser');
    Route::post('groups/{group_id}/users/add', 'MainController@addUserForm')->name('addUserForm');
});
