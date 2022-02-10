<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ViewReserve extends Model
{
    use HasFactory;

    private $weekday = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];

    /**
     * 曜日ごとの営業有無の確認
     * 
     * @param mixed $sales_day
     * @return array $sales
     */
    public function sales_judge($sales_day)
    {
        if($sales_day->sunday_open === "0"){
            $sales[0] = array('open' => $open = 0,'weekday' => $this->weekday[0]);
        }else{
            $sales[0] = array('open' => $open = 1,'weekday' => $this->weekday[0]);
        }

        if($sales_day->monday_open === "0"){
            $sales[1] = array('open' => $open = 0,'weekday' => $this->weekday[1]);
        }else{
            $sales[1] = array('open' => $open = 1,'weekday' => $this->weekday[1]);
        }

        if($sales_day->tuesday_open === "0"){
            $sales[2] = array('open' => $open = 0,'weekday' => $this->weekday[2]);
        }else{
            $sales[2] = array('open' => $open = 1,'weekday' => $this->weekday[2]);
        }

        if($sales_day->wednesday_open === "0"){
            $sales[3] = array('open' => $open = 0,'weekday' => $this->weekday[3]);
        }else{
            $sales[3] = array('open' => $open = 1,'weekday' => $this->weekday[3]);
        }

        if($sales_day->thursday_open === "0"){
            $sales[4] = array('open' => $open = 0,'weekday' => $this->weekday[4]);
        }else{
            $sales[4] = array('open' => $open = 1,'weekday' => $this->weekday[4]);
        }

        if($sales_day->friday_open === "0"){
            $sales[5] = array('open' => $open = 0,'weekday' => $this->weekday[5]);
        }else{
            $sales[5] = array('open' => $open = 1,'weekday' => $this->weekday[5]);
        }

        if($sales_day->saturday_open === "0"){
            $sales[6] = array('open' => $open = 0,'weekday' => $this->weekday[6]);
        }else{
            $sales[6] = array('open' => $open = 1,'weekday' => $this->weekday[6]);
        }
        return $sales;
    }

    /**
     * 営業日有無を取得するため、曜日keyを二週間分取得
     * 
     * @param mixed $sales_day
     * @param array $day_of_week
     * 
     * @return array $keys
     * 
    */
    public function chenge_week_day($sales_day,$day_of_week)
    {
        $sales = $this->sales_judge($sales_day);
        for($i = 1; $i < 15; $i ++){
            $keys[$i] = array_search($day_of_week[$i], array_column($sales, 'weekday'));
        }
        return $keys;
    }

    /**
     * sales_daysテーブルより選択された曜日のopen&closeのカラム名を取得
     * 
     * @param string $day_of_week　　　　　選択された曜日
     * @param array $sales　　　　　　　　　曜日&営業有無
     * 
     * @return array $open_colums_names　open&closeのカラム名
     * 
     */
    public function select_time($sales,$day_of_week,)
    {
        $keys =  array_search($day_of_week, array_column($sales, 'weekday'));
        $open_day = $sales[$keys];

        //sales_daysテーブルのカラム名取得
        $sales_day_columns = Schema::getColumnListing('sales_days');

        //requestされた曜日に対応する曜日のカラム名取得
        $open_colums_names = preg_grep('/'.$open_day['weekday'].'/',$sales_day_columns);

        //配列のkeyを0スタートに変更
        $open_colums_names = array_values($open_colums_names);

        return $open_colums_names;
    }
}
