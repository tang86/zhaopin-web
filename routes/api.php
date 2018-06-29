<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    Route::get('company/{company}', 'CompanyController@show');

    Route::post('login', 'LoginController@login');

    Route::get('get_banner_news', 'NewsController@getBannerNews');
    Route::get('positions', 'PositionController@index');
    Route::get('position/{position}', 'PositionController@show');
    Route::get('get_notices', 'NoticeController@getNotices');
    Route::resource('news', 'NewsController');

    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('users/points', 'UserController@points');
        Route::post('users_update', 'UserController@update');

    });
    Route::post('wechat_pay/createWechatOrder', 'PayController@createWechatOrder');
    Route::post('wechat_pay/createOrder', 'PayController@createOrder');
});
