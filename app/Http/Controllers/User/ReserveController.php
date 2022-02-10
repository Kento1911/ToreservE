<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Models\Area;
use App\Models\Plan;
use App\Models\SalesDay;
use App\Models\Schedule;
use App\Models\Time;
use App\Models\Trainer;
use App\Models\ViewReserve;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/** ユーザーの予約用のコントローラー
 * 
 * 予約ページ参照から予約完了までを記載
 */

class ReserveController extends Controller
{
    //曜日を配列で指定
    private $weekday = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];

    /**
     * 2週間分の日付、曜日、営業有無を取得
     * 
     * @param int $plan
     * 
     * @return mixed plan
     * @return array td　　　　　　　　　　　日付データ(carbon)
     * @return array|int day　　　　　　　　日付
     * @return array|string day_of_week　　曜日
     * @return array sales　　　　　　　　　　営業有無、曜日
     * @return array|int keys　　　　　　　　曜日($weekday)
    */
    public function reserve($plan)
    {
        $plan = Plan::where('id',$plan)->first();

        
        //2週間分の日付と曜日を取得
        for($i = 1; $i < 15; $i ++){
            $today = Carbon::today();
            $td[$i] = $today->addDay($i);
            $day[$i] = $td[$i]->day;
            $day_of_week[$i] = $this->weekday[$td[$i]->dayOfWeek];
        }

        $sales_day = SalesDay::where('trainer_profile_id',$plan->trainer_profile_id)->first();

        $judge = new ViewReserve();
        $sales = $judge->sales_judge($sales_day);
        $keys = $judge->chenge_week_day($sales_day,$day_of_week);

        return view('user.reserve_form',compact('plan','td','day','day_of_week','sales','keys'));
    }


    /**
     * 選択された日付のopen~closeまでの時間の取得とエリアの取得
     *
     * 
     * @param mixed $td
     * @param int $plan
     * 
     * @return mixed plan
     * @return date daydata
     * @return string day_of_week
     * @return mixed select_time
     * @return mixed areas
     */
    public function reserve_day($td ,$plan)
    {
        $daydata = new Carbon($td); 
        $day_of_week = $this->weekday[$daydata->dayOfWeek];
        $plan = Plan::where('id',$plan)->first();

        $sales = $this->reserve($plan->id);
        $sales = $sales->sales;
        $select_colums = new ViewReserve();
        $open_colums_names = $select_colums->select_time($sales,$day_of_week);

        foreach($open_colums_names as $open_colums_name){
            $open_time[] = SalesDay::where('trainer_profile_id',$plan->trainer_profile_id)->select($open_colums_name)->first();
        }

        for($i = 0; $i < 2; $i++){
            $times[] = $open_time[$i][$open_colums_names[$i]];
        }

        $select_times = Time::where('id','>',$times[0])->where('id','<',$times[1])->get();
        $areas = Area::whereIn('id',function($query) use($plan){
            $query->from('trainer_areas')
                ->where('trainer_profile_id',$plan->trainer_profile_id)
                ->select('area_id');
        })->get();

        return view('user.reserve.reserve_day',compact('plan','daydata','day_of_week','select_times','areas'));
    }


    /**
     * 入力された内容の確認表示
     * 
     * @param  Request  $request
     * 
     * @return array plan
     * @return array time
     * @return array area
     * @return string comment
     * @return date daydate
     * @return integer day
     * @return integer month
     */
    public function reserve_confirm(Request $request)
    {
        $plan = Plan::where('id',$request->plan_id)->first();
        $time = Time::where('id',$request->time)->first();
        $area = Area::where('id',$request->area)->first();

        $comment = $request->comment;

        $daydata = new Carbon($request->daydata); 
        $day = $daydata->day;
        $month = $daydata->month;

        $request->session()->regenerateToken();

        return view('user.reserve.reserve_confirm',compact('plan','time','area','comment','daydata','day','month'));
    }

    /**
     * 予約内容の保存
     * 
     * @param Request $request
     */
    public function reserve_submit(ScheduleRequest $request)
    {
        DB::transaction(function () use($request){
            $schudule = new Schedule();

            $trainer_id = Trainer::whereIn('id',function ($query) use ($request){
                $query->from('trainer_profiles')
                    ->select('trainer_id')
                    ->whereIn('id',function ($query) use ($request){
                        $query->from('plans')
                            ->select('trainer_profile_id')
                            ->where('id',$request->plan_id);
                    });
                })->select('id')->first();


            $schudule->user_id = Auth::id();
            $schudule->trainer_id = $trainer_id->id;
            $schudule->plan_id = $request->plan_id;
            $schudule->area_id = $request->area_id;
            $schudule->time_id = $request->time_id;
            $schudule->date = $request->daydata;
            $schudule->user_comment = $request->comment;
            $schudule->state_flg = 0;
            $schudule->save();
        });

        $request->session()->regenerateToken();
        
        return view('user.reserve.message');
    }
}