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
        \Illuminate\Support\Facades\DB::update('SET FOREIGN_KEY_CHECKS=0');
        // $this->call(UsersTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(CompanySizeTableSeeder::class);
        $this->call(CompanyStatusTableSeeder::class);
        $this->call(CompanyCategoriesTableSeeder::class);
        $this->call(CreditConfigsTableSeeder::class);
        $this->call(UserPointsLogsTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(IntentionsTableSeeder::class);
        $this->call(SalariesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);

    }
}
