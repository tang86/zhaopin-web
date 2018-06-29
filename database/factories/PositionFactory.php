<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Position::class, function (Faker $faker) {
    return [
        'name' => '职位名称'.$faker->name,
        'company_id' => $faker->randomElement(\App\Models\Company::all()->pluck('id')->toArray()),
        'salary_id' => $faker->randomElement(\App\Models\Salary::all()->pluck('id')->toArray()),
        'district_id' => $faker->randomElement(\App\Models\District::all()->pluck('id')->toArray()),
        'number' => $faker->numberBetween(5,50),
        'keywords' => '3年经验 学历不限 双休 包吃住',
        'content' => '职位详情职位详情职位详情职位详情职位详情职位详情',
        'benefit' => '福利待遇福利待遇福利待遇福利待遇福利待遇福利待遇福利待遇',
    ];
});
