<?php

use Illuminate\Database\Seeder;

class UserPointsLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::update('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\UserPointsLog::truncate();
        $user_points_logs = factory(\App\Models\UserPointsLog::class, 77)->make();
        \App\Models\UserPointsLog::insert($user_points_logs->toArray());
    }
}
