<?php

use Illuminate\Database\Seeder;

class CreditConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::update('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\CreditConfig::truncate();

        $data = [
            [
                'name' => '阅读',
                'points' => 1,
            ],
            [
                'name' => '邀请',
                'points' => 50,

            ],
            [
                'name' => '完善简历',
                'points' => 50,
            ],
            [
                'name' => '被邀请人完善简历',
                'points' => 50,
            ],
        ];

        \App\Models\CreditConfig::insert($data);
    }
}