<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\District::truncate();
        $intentions = factory(\App\Models\District::class,20)->make();
        \App\Models\District::insert($intentions->toArray());
    }
}
