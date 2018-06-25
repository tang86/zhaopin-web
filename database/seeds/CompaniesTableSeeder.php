<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Company::truncate();

        $companies = factory(\App\Models\Company::class,100)->make();
        \App\Models\Company::insert($companies->toArray());
    }
}
