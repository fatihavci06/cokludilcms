<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
        'name'=>'Fatih',
        'email'=>'admin@test.com',
        'password'=>bcrypt('102030')
        ]);
    }
}
