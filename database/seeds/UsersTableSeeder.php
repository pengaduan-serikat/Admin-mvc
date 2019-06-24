<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessType = DB::table('access_types')->where('name', 'Admin')->first();
        $division = DB::table('divisions')->where('name', 'Operation')->first();
        $position = DB::table('positions')->where('name', 'Operator')->first();
        DB::table('users')->insert([
            'access_type_id' => $accessType->id,
            'division_id' => $division->id,
            'position_id' => $position->id,
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'first_name' => 'admin',
            'last_name' => 'admin',
            'profile_pic' => '',
            'NIK' => '12345',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
