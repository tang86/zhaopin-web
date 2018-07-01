<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Intention::class, function (Faker $faker) {
    return [
        'name' => '求职意向'.$faker->name
    ];
});
