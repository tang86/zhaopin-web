<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 会注册一些在访问令牌、客户端、私人访问令牌的发放和吊销过程中会用到的必要路由
        Passport::routes();
        // 定义令牌作用域
        Passport::tokensCan([
            'place-orders' => 'Place orders',
            'check-status' => 'Check order status',
        ]);
        // accessToken有效期
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        // accessRefushToken有效期
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
