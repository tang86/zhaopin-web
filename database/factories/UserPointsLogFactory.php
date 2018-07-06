<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\UserPointsLog::class, function (Faker $faker) {



    if (random_int(1, 10) < 2) {
        $status = random_int(0, 2);
        $credit_config = [
            'id' => 0,
            'points' => 50,
            'name' => '提现',
        ];
    } else {
        $status = 1;
        $credit_config = $faker->randomElement(\App\Models\CreditConfig::all()->toArray());
    }
    return [
        'user_id' => 1,
        'credit_config_id' => $credit_config['id'],
        'points' => $credit_config['points'],
        'remark' => $credit_config['name'],
        'status' => $status,
    ];
});
