<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\UserPointsLog::class, function (Faker $faker) {
    $credit_config = $faker->randomElement(\App\Models\CreditConfig::all()->toArray());
    return [
        'user_id' => 1,
        'credit_config_id' => $credit_config['id'],
        'points' => $credit_config['points'],
        'remark' => $credit_config['name'],
    ];
});
