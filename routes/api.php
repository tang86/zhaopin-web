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


    Route::get('districts', 'DistrictController@index');
    Route::get('company/{company}', 'CompanyController@show');

    Route::post('login', 'LoginController@login');

    Route::get('code', 'CodeController@create');
    Route::get('get_banner_news', 'NewsController@getBannerNews');
    Route::get('positions', 'PositionController@index');
    Route::get('intentions', 'IntentionController@index');
    Route::get('sent-positions', 'PositionController@sentPositions');
    Route::get('position/{position}', 'PositionController@show')->where('position','\d+');
    Route::get('position/is-sent/', 'PositionController@isSent');
    Route::get('get_notices', 'NoticeController@getNotices');
    Route::resource('news', 'NewsController');



    Route::group(['middleware' => 'auth:api'], function () {

        //积分
        Route::get('users/invite-logs', 'PointsController@inviteLogs');
        Route::get('users/withdraw-logs', 'PointsController@withdrawLogs');
        Route::get('users/points-logs', 'PointsController@pointsLogs');
        Route::get('users/points-friend-resume-logs', 'PointsController@pointsFriendResumeLogs');
        Route::post('credit/increase-points-read', 'PointsController@increasePointsRead');
        Route::post('credit/increase-points-invite', 'PointsController@increasePointsInvite');
        Route::post('credit/increase-points-resume', 'PointsController@increasePointsResume');
        Route::post('credit/increase-points-friend-resume', 'PointsController@increasePointsFriendResume');
        Route::post('credit/increase-points-share', 'PointsController@increasePointsShare');

        //绑定手机号
        Route::post('users/bind-mobile', 'UserController@bindMobile');
        //提现
        Route::post('users/withdraw', 'UserController@withdraw');

        Route::get('users/get-resume', 'UserController@getResume');
        Route::get('users/points', 'UserController@points');
        Route::post('users/resume/create-or-update', 'UserController@updateResume');
        Route::post('users/send-resume', 'UserController@sendResume');
        Route::post('users/update', 'UserController@update');
        Route::post('users/add-experience', 'UserController@addExperience');

    });
    Route::post('wechat_pay/createWechatOrder', 'PayController@createWechatOrder');
    Route::post('wechat_pay/createOrder', 'PayController@createOrder');
});
