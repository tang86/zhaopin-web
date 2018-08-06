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


Route::group(['middleware' => ['web']], function () {
    Route::any('/wechat','WechatController@index');
    Route::any('/mini_report_home','WechatController@index');
    Route::get('/wechat_menu','WechatController@menu');
    Route::get('/wechat_sources','WechatController@sources');
    Route::get('/wechat_makeImg/{head}/{name}/{url}','WechatController@makeImg');
    Route::any('/qrcode','WechatController@qrcode');


});


Route::get('/', 'Home\HomeController@index');
