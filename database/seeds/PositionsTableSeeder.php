<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Position::truncate();
        $positions = factory(\App\Models\Position::class,37)->make();
        \App\Models\Position::insert($positions->toArray());
    }
}
