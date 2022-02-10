<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainers')->insert([
            [
                'name' => 'trainer1',
                'email' => 'trainer1@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'trainer2',
                'email' => 'trainer2@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'trainer3',
                'email' => 'trainer3@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'trainer4',
                'email' => 'trainer4@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'trainer5',
                'email' => 'trainer5@gmail.com',
                'password' => Hash::make('testtest')
            ],
            [
                'name' => 'trainer6',
                'email' => 'trainer6@gmail.com',
                'password' => Hash::make('testtest')
            ], 
            [
                'name' => 'trainer7',
                'email' => 'trainer7@gmail.com',
                'password' => Hash::make('testtest')
            ], 
            [
                'name' => 'trainer8',
                'email' => 'trainer8@gmail.com',
                'password' => Hash::make('testtest')
            ], 
            [
                'name' => 'trainer9',
                'email' => 'trainer9@gmail.com',
                'password' => Hash::make('testtest')
            ], 
            [
                'name' => 'trainer10',
                'email' => 'trainer10@gmail.com',
                'password' => Hash::make('testtest')
            ], 
        ]);
    }
}
