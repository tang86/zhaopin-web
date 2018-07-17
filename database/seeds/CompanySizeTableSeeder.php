<?php

use Illuminate\Database\Seeder;

class CompanySizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::update('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\CompanySize::truncate();

        $data = [
            [
                'name' => '10~50',
                'min' => 10,
                'max' => 50,
            ],
            [
                'name' => '50~100',
                'min' => 50,
                'max' => 100,
            ],
            [
                'name' => '100~150',
                'min' => 100,
                'max' => 150,
            ],
            [
                'name' => '150~250',
                'min' => 150,
                'max' => 250,
            ],


        ];

        \App\Models\CompanySize::insert($data);
    }
}
