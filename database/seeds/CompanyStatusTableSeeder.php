<?php

use Illuminate\Database\Seeder;

class CompanyStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::update('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\CompanyStatus::truncate();

        $data = [
            [
                'name' => '已经上市',
            ],
            [
                'name' => '上市中',
            ],
            [
                'name' => '创业公司',
            ],
            [
                'name' => '集团公司',
            ],
        ];

        \App\Models\CompanyStatus::insert($data);
    }
}
