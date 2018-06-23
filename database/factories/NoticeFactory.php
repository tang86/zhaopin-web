<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Notice::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->sentence,
    ];
});
