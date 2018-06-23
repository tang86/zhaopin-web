<?php

use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Notice::truncate();

        factory(\App\Models\Notice::class,3)->create();
    }
}
