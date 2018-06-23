<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(6),
        'number' => $faker->numberBetween(),
        'profile' => $faker->paragraph(1),
        'company_category_id' => $faker->randomElement(\App\Models\CompanyCategory::all()->pluck('id')->toArray()),
        'company_size_id' => $faker->randomElement(\App\Models\CompanySize::all()->pluck('id')->toArray()),
        'company_status_id' => $faker->randomElement(\App\Models\CompanyStatus::all()->pluck('id')->toArray()),
        'district_id' => $faker->randomElement(\App\Models\District::all()->pluck('id')->toArray()),
        'phone' => $faker->phoneNumber,
        'sort' => $faker->numberBetween(1,255),
    ];
});
