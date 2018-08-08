<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'number' => $faker->numberBetween(),
        'profile' => '诺基亚公司（Nokia Corporrtion,NYSE:NOK）是一家总部位于芬兰主要从事生产移动通信产品的跨国公司，自1996年以来，诺基亚一直占据市场份额第一。面对苹果公司于2007年推出的iphone和采用Google  Android的手机夹击，诺基亚连续15年的全球手机销量第一的地位在2011年第二季被苹果及三星双双超越。',
        'company_category_id' => $faker->randomElement(\App\Models\CompanyCategory::all()->pluck('id')->toArray()),
        'company_size_id' => $faker->randomElement(\App\Models\CompanySize::all()->pluck('id')->toArray()),
        'company_status_id' => $faker->randomElement(\App\Models\CompanyStatus::all()->pluck('id')->toArray()),
        'district_id' => $faker->randomElement(\App\Models\District::all()->pluck('id')->toArray()),
        'phone' => $faker->phoneNumber,
        'sort' => $faker->numberBetween(1,255),
        'logo' => 'company/company_logo.png',
    ];
});
