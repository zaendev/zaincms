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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::group(['prefix' => 'admz', 'middleware' => 'auth'],function (){
    Route::get('/', 'Admin\DashboardController@index');
    Route::resource('post', 'Admin\PostController');
    Route::resource('page', 'Admin\PageController');
    Route::resource('slide', 'Admin\SlideController');
    Route::resource('config', 'Admin\ConfigController');

    Route::get('category/{modul}', 'Admin\CategoryController@index');
    Route::get('category/show/{modul}', 'Admin\CategoryController@show');
    Route::get('category/view/{modul}', 'Admin\CategoryController@view');
    Route::post('category/save/{modul}', 'Admin\CategoryController@save');
    Route::post('category/store/{modul}', 'Admin\CategoryController@store');
    Route::post('category/update/{modul}', 'Admin\CategoryController@update');
    Route::post('category/destroy/{modul}', 'Admin\CategoryController@destroy');

    Route::get('menu', 'Admin\MenuController@index');
    Route::get('menu/show', 'Admin\MenuController@show');
    Route::get('menu/view', 'Admin\MenuController@view');
    Route::post('menu/save', 'Admin\MenuController@save');
    Route::post('menu/store', 'Admin\MenuController@store');
    Route::post('menu/update', 'Admin\MenuController@update');
    Route::post('menu/destroy', 'Admin\MenuController@destroy');
});

Route::get('/', 'Site\IndexController@index');
Route::get('/search', 'Site\IndexController@search');
Route::get('/{page}', 'Site\IndexController@page');
Route::get('/{page}/{show}', 'Site\IndexController@show');

