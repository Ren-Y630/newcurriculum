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

Route::get('/', function () {
    return view('welcome');
});

// URLをadminから始まるように
// 'middleware' => 'auth'ログインしていない状態でそのページにアクセスした時ログイン画面にリダイレクト
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('sns/create', 'Admin\SnsController@index');
    Route::post('sns/create', 'Admin\SnsController@create');
    Route::get('sns/delete', 'Admin\SnsController@delete');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');