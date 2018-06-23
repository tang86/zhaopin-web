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
    Route::get('companies/{company}', 'CompanyController@show');

    Route::post('login', 'LoginController@login');

    Route::get('get_banner_news', 'NewsController@getBannerNews');
    Route::get('get_notices', 'NoticeController@getNotices');
    Route::resource('news', 'NewsController');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('coupons', 'CouponsController@store');
        Route::post('getCoupon/{coupon}', 'CouponsController@getCoupon');
        Route::post('comments', 'CommentsController@store');
        Route::get('my_coupons', 'CouponsController@myCoupons');
        Route::post('users_update', 'UsersController@update');
        Route::resource('orders', 'OrdersController');
        Route::get('gifts/sendOrders', 'GiftsController@sendOrders');
        Route::get('gifts/receiveOrders', 'GiftsController@receiveOrders');
        Route::post('gifts/send/{order}', 'GiftsController@send');
        Route::post('gifts/{order}', 'GiftsController@store');
    });
    Route::post('wechat_pay/createWechatOrder', 'PayController@createWechatOrder');
    Route::post('wechat_pay/createOrder', 'PayController@createOrder');
});
