<?php

namespace Database\Seeders;

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
        $this->call([
            UserSeeder::class,
            TrainerSeeder::class,
            AdminSeeder::class,
            AreaSeeder::class,
            TypeSeeder::class,
            TimeSeeder::class,
        ]);
    }
}
