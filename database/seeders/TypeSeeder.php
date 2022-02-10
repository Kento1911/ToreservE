<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            [
                'name' => '筋トレ'
            ],
            [
                'name' => 'パワーリフティング'
            ],
            [
                'name' => 'ダイエット'
            ],
            [
                'name' => 'ヨガ'
            ],
            [
                'name' => 'ボディメイク'
            ],
            [
                'name' => 'ダンス'
            ],
            [
                'name' => 'HIIT'
            ],
            [
                'name' => '陸上競技'
            ],
            [
                'name' => '野球'
            ],
            [
                'name' => 'サッカー'
            ],
            [
                'name' => 'その他'
            ],
        ]);
    }
}
