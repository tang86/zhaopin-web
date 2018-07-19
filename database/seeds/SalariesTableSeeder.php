<?php

use Illuminate\Database\Seeder;

class SalariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::update('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\Salary::truncate();

        $data = [
            [
                'name' => '1K~3K',
                'floor' => 1000,
                'ceil' => 3000,
            ],
            [
                'name' => '3K~5K',
                'floor' => 3000,
                'ceil' => 5000,
            ],
            [
                'name' => '5K~10K',
                'floor' => 5000,
                'ceil' => 10000,
            ],
            [
                'name' => '10K~30K',
                'floor' => 10000,
                'ceil' => 30000,
            ],
        ];

        \App\Models\Salary::insert($data);
    }
}
