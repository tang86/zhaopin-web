<?php

use Faker\Generator as Faker;

$faker = \Faker\Factory::create('zh_CN');

$factory->define(\App\Models\News::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'brief' => $faker->paragraph(1),
        'banner' => $faker->randomElement(\App\User::all()->pluck('head_url')->toArray()),
        'content' => $faker->paragraph,
        'like_num' => $faker->numberBetween(),
        'read_num' => $faker->numberBetween(),
        'sort' => $faker->numberBetween(),
    ];
});
