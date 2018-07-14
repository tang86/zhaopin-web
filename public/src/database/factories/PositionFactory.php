<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Position::class, function (Faker $faker) {
    return [
        'name' => '职位名称'.$faker->countryCode,
        'company_id' => $faker->randomElement(\App\Models\Company::all()->pluck('id')->toArray()),
        'salary_id' => $faker->randomElement(\App\Models\Salary::all()->pluck('id')->toArray()),
        'district_id' => $faker->randomElement(\App\Models\District::all()->pluck('id')->toArray()),
        'number' => $faker->numberBetween(5,50),
        'keywords' => '3年经验 学历不限 双休 包吃住',
        'content' => '<p>1.车间主任在生产厂长的领导下，负责车间全面行政工作</p><p>2.爱敬敬业，执行并落实公司的各项规章制度，车间主任对本车间生产、技术、质量、设备、安全等各项工作职责</p>',
        'benefit' => '<p>五险一金</p><p>管吃住</p>',
    ];
});
