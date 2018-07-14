<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('news', 'NewsController');
    $router->resource('notices', 'NoticeController');

    $router->post('uploadNews', 'NewsController@uploadNews');

    $router->resource('users', 'UserController');
    // 禁用用户
    $router->get('users_disable/{user}', 'UserController@disable');
    // 启用用户
    $router->get('users_able/{user}', 'UserController@able');

    $router->resource('companies', 'CompanyController'); //企业管理
    $router->resource('company-categories', 'CompanyCategoryController'); //行业管理
    $router->resource('company-size', 'CompanySizeController'); //规模管理
    $router->resource('company-status', 'CompanyStatusController'); //状态管理
    $router->resource('positions', 'PositionController'); //职位管理
    $router->resource('salaries', 'SalaryController'); //薪资范围管理

    $router->resource('districts', 'DistrictController'); //地区管理
    $router->resource('intentions', 'IntentionController'); //求职意向管理
    $router->resource('credits', 'CreditController'); //积分管理




});
