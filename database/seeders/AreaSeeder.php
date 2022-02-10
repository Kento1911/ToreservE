<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            [
                'name' => '銀座・新橋・有楽町'
            ],
            [
                'name' => '東京・日本橋'
            ],
            [
                'name' => '渋谷・恵比寿・代官山'
            ],
            [
                'name' => '新宿・代々木・大久保'
            ],
            [
                'name' => '池袋～高田馬場・早稲田'
            ],
            [
                'name' => '六本木・麻布・広尾'
            ],
            [
                'name' => '赤坂・永田町・溜池'
            ],
            [
                'name' => '四ツ谷・市ヶ谷・飯田橋'
            ],
            [
                'name' => '秋葉原・神田・水道橋'
            ],
            [
                'name' => '上野・浅草・日暮里'
            ],
            [
                'name' => '両国・錦糸町・小岩'
            ],
            [
                'name' => '築地・湾岸・お台場'
            ],
            [
                'name' => '浜松町・田町・品川'
            ],
            [
                'name' => '大井・蒲田'
            ],
            [
                'name' => '目黒・白金・五反田'
            ],
            [
                'name' => ' 中目黒・祐天寺・自由が丘'
            ],
            [
                'name' => '中野～西荻窪'
            ],
            [
                'name' => '吉祥寺・三鷹・武蔵境'
            ],
            [
                'name' => '板橋・東武沿線'
            ],
            [
                'name' => '千住・綾瀬・葛飾'
            ],
            [
                'name' => '小金井・国分寺・国立'
            ],
            [
                'name' => '調布・府中・狛江'
            ],
            [
                'name' => '町田・稲城・多摩'
            ],
            [
                'name' => '立川市・八王子市周辺'
            ],
        ]);
    }
}
