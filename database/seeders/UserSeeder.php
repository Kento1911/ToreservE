<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'user3',
                'email' => 'user3@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'user4',
                'email' => 'user4@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'user5',
                'email' => 'user5@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'user6',
                'email' => 'user6@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'user7',
                'email' => 'user7@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'user8',
                'email' => 'user8@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'user9',
                'email' => 'user9@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'user10',
                'email' => 'user10@gmail.com',
                'password' => Hash::make('testtest')
            ],
        ]);
    }
}
