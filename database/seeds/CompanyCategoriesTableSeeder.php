<?php

use Illuminate\Database\Seeder;

class CompanyCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::update('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\CompanyCategory::truncate();

        $data = [
            [
                'name' => '金融',
            ],
            [
                'name' => '医疗',
            ],
            [
                'name' => '科技',
            ],
            [
                'name' => '教育',
            ],
        ];

        \App\Models\CompanyCategory::insert($data);
    }
}
