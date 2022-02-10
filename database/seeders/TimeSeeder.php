<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Time;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($h =1; $h <25; $h++){
            DB::table('times')->insert([
                'hour' => $h,
                'minute' => '00',
            ]);
            DB::table('times')->insert([
                'hour' => $h,
                'minute' => '30',
            ]);
        }
    }
}