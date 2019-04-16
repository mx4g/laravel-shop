<?php

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

Route::get('/', 'PagesController@root')->name('root');

//['verify' => true]:启用与邮箱验证相关的路由
Auth::routes(['verify' => true]);
 
// 在之前的路由后面配上中间件
//Laravel 自带了一个名为 verified 的中间件，
//如果一个未验证邮箱的用户尝试访问一个配置了 verified 中间件的路由，Laravel 就会提示该用户邮箱未激活
Route::get('/', 'PagesController@root')->name('root')->middleware('verified');

// auth 中间件代表需要登录，verified中间件代表需要经过邮箱验证
Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
});