<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'name' => 'Amr El Mahdy',
            'email' => 'a.mahdy@rkanjel.com',
            'username' => 'amrelmahdy',
            'password' => bcrypt('password'), // secret
            'remember_token' => str_random(10),
        ]);

        factory('App\Models\User', 10)->create();
    }
}
