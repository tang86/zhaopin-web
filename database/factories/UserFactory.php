<?php

use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Coupon::class, function (Faker $faker) {
    return [
        'id' => Uuid::uuid1()->getHex(),
        'user_id' => \App\User::all()->first()->id??null,
        'goods_id' => \App\Models\Good::all()->first()->id??null,
        'min' => random_int(10, 100),
        'max' => random_int(101, 1000),
        'expire_start' => strtotime('2018-05-01'),
        'expire_end' => strtotime('2018-12-31'),
        'remark' => $faker->name,
    ];
});
$factory->define(\App\Models\CouponsRelUser::class, function (Faker $faker) {
    return [
        'coupon_id' => $faker->randomElement(\App\Models\Coupon::all()->pluck('id')->toArray()),
        'user_id' => \App\User::all()->first()->id??null,
        'price' => random_int(10, 1000),
        'status' => true
    ];
});

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'goods_id' => 1,
        'parent_id' => 1,
        'user_id' => 1,
        'content' => $faker->name,
        'title' => $faker->name,
    ];
});