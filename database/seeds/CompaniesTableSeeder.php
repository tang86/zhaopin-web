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

        \Illuminate\Support\Facades\DB::update('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\Company::truncate();
        $companies = factory(\App\Models\Company::class,100)->make();
        \App\Models\Company::insert($companies->toArray());
    }
}
