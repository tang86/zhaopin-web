<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CreditConfigsTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(IntentionsTableSeeder::class);
        $this->call(SalariesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);

    }
}
