<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Notice::class, function (Faker $faker) {
    $company = $faker->company;
    return [
        'title' => "{$company}刚刚入驻",
        'content' => "{$company}刚刚入驻",
    ];
});
