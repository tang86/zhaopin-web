<?php

use Illuminate\Database\Seeder;

class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Notice::truncate();

        $notices = factory(\App\Models\Notice::class,3)->make();
        \App\Models\Notice::insert($notices->toArray());
    }
}
