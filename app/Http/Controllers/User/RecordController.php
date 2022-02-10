<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Record;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * トレーニング記録の参照用コントローラ
 * 
 * 一覧から詳細まで記載
 * 
 */
class RecordController extends Controller
{
    /**
     * 一覧表示
     * 
     * @return mixed schedule
     */
    public function top()
    {
        $schedules = Schedule::with('trainer.TrainerProfile','plan','time','area')->where('user_id',Auth::id())->where('state_flg',4)->paginate(15);

        return view('user.record.top',compact('schedules'));
    }

    /**
     * 検索処理
     * 
     * トレーナー名での検索と作成日での昇降の並び替え
     * 
     * @param Request $request
     * 
     * @return mixed schedule
     */
    public function research(Request $request)
    {
        $schedules = Schedule::with('trainer.TrainerProfile','plan','time','area')->where('user_id',Auth::id())->where('state_flg',4)->paginate(15);

        $name = $request->input('name');

        if($request->has('name') && !empty($request->name)){
            $schedules = Schedule::with('trainer.TrainerProfile','plan','time','area')
                    ->where([['user_id',Auth::id()],['state_flg',4]])
                    ->whereIn('trainer_id',function ($query) use ($name){
                        $query->from('trainers')
                            ->select('id')
                            ->where('name','like', '%'.$name.'%');
                    })->paginate(15);
        }
        if($request->has('sort_order') && !empty($request->sort_order)){
            if($request->sort_order === 'old'){
                $schedules = Schedule::with('trainer.TrainerProfile','plan','time','area')->where('user_id',Auth::id())->where('state_flg',4)->orderBy('date','asc')->paginate(15);
            }
            if($request->sort_order === 'new'){
                $schedules = Schedule::with('trainer.TrainerProfile','plan','time','area')->where('user_id',Auth::id())->where('state_flg',4)->orderBy('date','desc')->paginate(15);
            }
        }

        return view('user.record.top',compact('schedules'));
    }

    /**
     * 記録の詳細表示
     * 
     * @param mixed $schedule
     * 
     * @return mixed schedule
     * @return mixed record
     * 
     */
    public function detail(Schedule $schedule)
    {
        $this->authorize('user_detail',$schedule);

        $schedules = Schedule::with('trainer','plan','time','area')->where('id',$schedule->id)->get();
        $records = Record::where('schedule_id',$schedule->id)->get();

        return view('user.record.detail',compact('schedules','records'));
    }
}
