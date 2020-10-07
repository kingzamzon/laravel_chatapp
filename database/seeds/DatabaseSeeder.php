<?php

use App\User;
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
           // # Create first user
           $user = User::create(
            [
                'name' => "John Doe",
                'email' => 'johndoe@gmail.com',
                'password' => bcrypt('password')
            ]
            );

           // # Create second user
           $user = User::create(
            [
                'name' => "Adesanoye Samson",
                'email' => 'ade@gmail.com',
                'password' => bcrypt('password')
            ]
        );
    }
}
