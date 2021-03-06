<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccessTypeTableSeeder::class);
        $this->call(DivisionsTableSeeder::class);
        $this->call(PositionTableSeeder::class);
        $this->call(CaseStatusTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
