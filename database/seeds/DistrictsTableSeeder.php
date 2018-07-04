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
//        \App\Models\District::truncate();
//        $intentions = factory(\App\Models\District::class,20)->make();
//        \App\Models\District::insert($intentions->toArray());
        \Illuminate\Support\Facades\DB::update('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\District::truncate();

        $data = [
            [
                'name' => '北京',
                'parent_id' => 0,
            ],
            [
                'name' => '河北省',
                'parent_id' => 0,
            ],
            [
                'name' => '朝阳区',
                'parent_id' => 1,
            ],
            [
                'name' => '东城区',
                'parent_id' => 1,
            ],
            [
                'name' => '昌平区',
                'parent_id' => 1,
            ],
            [
                'name' => '石家庄',
                'parent_id' => 2,
            ],
            [
                'name' => '固安',
                'parent_id' => 2,
            ],
            [
                'name' => '沧州',
                'parent_id' => 2,
            ],
        ];

        \App\Models\District::insert($data);
    }
}
