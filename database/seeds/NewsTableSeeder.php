<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\News::truncate();

        $news = factory(\App\Models\News::class,1000)->make();
        \App\Models\News::insert($news->toArray());
    }
}
