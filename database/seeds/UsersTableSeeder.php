<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 10000; $i++) {
            \App\Test::create([
                'code' => Str::random(10),
                'name' => Str::random(10),

            ]);
        }


    }
}
