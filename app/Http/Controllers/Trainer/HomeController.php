<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * ログイン後のtop画面を表示
 * 
 * 確定予約一覧、当月の売上、トレーニング件数を表示
 * 
 * @return int schedule_count
 * @return int total_price
 * @return mixed schedules
 */
class HomeController extends Controller
{
    public function top()
    {
        $dt = new Carbon();
        $setMonth = $dt->month;
        $setYear = $dt->year;
        //今月の初日、末日を取得
        $month['first_day'] = Carbon::create($setYear, $setMonth, 1)->firstOfMonth(); 
        $month['last_day']  = Carbon::create($setYear, $setMonth, 1)->lastOfMonth(); 

        //今月のスケジュールを取得
        $this_month_schedules = Schedule::with('user','plan','time','area')->where([['trainer_id',Auth::id()],['state_flg',4],['date','>=',$month['first_day']],['date','<=',$month['last_day']]])->get();
        //今月のトレーニング件数
        $schedule_count = $this_month_schedules->count();
        
        //今月の売り上げ合計
            foreach($this_month_schedules as $schedule){
                foreach($schedule->plan as $plan)
                $price[] = $plan->price; 
            }
            if(isset($price)){
                $total_price = array_sum($price);
            }else{
                $total_price = 0;
            }

        $schedules = Schedule::with('user','plan','time','area')->where([['trainer_id',Auth::id()],['state_flg',3]])->orWhere([['trainer_id',Auth::id()],['state_flg',0]])->orderBy('date','asc')->paginate(15);

        return view('trainer.top',compact('schedule_count','total_price','schedules'));
    }
}
