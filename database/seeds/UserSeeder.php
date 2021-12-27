<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Partha Ghose',
            'email' => 'partha35-2350@diu.edu.bd',
            'password' => Hash::make('12345678')
        ];
        DB::table('users')->insert($user);
    }
}
