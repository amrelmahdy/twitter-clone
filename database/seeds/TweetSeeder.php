<?php

use Illuminate\Database\Seeder;
use App\Models\Tweet;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tweet::create([
           'user_id' => 1,
            'tweet' => 'hey I love twitter it is amazing',
        ]);

        Tweet::create([
            'user_id' => 2,
            'tweet' => 'hey I love twitter it is awesome',
        ]);


        Tweet::create([
            'user_id' => 3,
            'tweet' => 'hey I love twitter it is wonderful',
        ]);


        Tweet::create([
            'user_id' => 4,
            'tweet' => 'I love twitter too',
        ]);

        Tweet::create([
            'user_id' => 5,
            'tweet' => 'hey I love twitter it is good',
        ]);

        Tweet::create([
            'user_id' => 6,
            'tweet' => 'hey I love twitter it is nice',
        ]);

        Tweet::create([
            'user_id' => 7,
            'tweet' => 'hey I love twitter it is not bad',
        ]);



        Tweet::create([
            'user_id' => 8,
            'tweet' => 'hey I love twitter it is fun',
        ]);


        Tweet::create([
            'user_id' => 9,
            'tweet' => 'hey I love twitter it is not boring',
        ]);


        Tweet::create([
            'user_id' => 10,
            'tweet' => 'hey I love twitter it is amusing',
        ]);



        Tweet::create([
            'user_id' => 3,
            'tweet' => 'hey I love twitter it is beyond imagination',
        ]);

        Tweet::create([
            'user_id' => 3,
            'tweet' => 'hey I love twitter it is a bit good',
        ]);
    }
}
