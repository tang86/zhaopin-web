<?php

use Illuminate\Database\Seeder;

class IntentionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Intention::truncate();
        $intentions = factory(\App\Models\Intention::class,20)->make();
        \App\Models\Intention::insert($intentions->toArray());
    }
}
