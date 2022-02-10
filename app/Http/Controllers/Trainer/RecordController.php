<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;
use App\Models\Record;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * トレーニング記録の処理用コントローラー
 * 
 * トレーニング記録一覧から編集までを行う
 */
class RecordController extends Controller
{
    /**
     * 一覧画面表示
     *
     * @return array schedule
     */
    public function top()
    {
        $schedules = Schedule::with('user','plan','time','area')->where('trainer_id',Auth::id())->where('state_flg',4)->paginate(15);


        return view('trainer.record.top',compact('schedules'));
    }


    /**
     * 検索処理
     * ユーザー名、実施日でのソート機能
     * 
     * @param Request $request
     * 
     * @return mixed schedule
     */
    public function research(Request $request)
    {
        $schedules = Schedule::with('user','plan','time','area')->where('trainer_id',Auth::id())->where('state_flg',4)->paginate(15);

        $name = $request->input('name');

        if($request->has('name') && !empty($request->name)){
            $schedules = Schedule::with('user','plan','time','area')
                    ->where([['trainer_id',Auth::id()],['state_flg',4]])
                    ->whereIn('user_id',function ($query) use ($name){
                        $query->from('users')
                            ->select('id')
                            ->where('name','like', '%'.$name.'%');
                    })->paginate(15);
        }
        if($request->has('sort_order') && !empty($request->sort_order)){
            if($request->sort_order === 'old'){
                $schedules = Schedule::with('user','plan','time','area')->where('trainer_id',Auth::id())->where('state_flg',4)->orderBy('date','asc')->paginate(15);
            }
            if($request->sort_order === 'new'){
                $schedules = Schedule::with('user','plan','time','area')->where('trainer_id',Auth::id())->where('state_flg',4)->orderBy('date','desc')->paginate(15);
            }
        }

        return view('trainer.record.top',compact('schedules'));
    }


    /**
     * 詳細画面表示
     * 
     * @param mixed $schedule
     * 
     * @return array schedule
     * @return array record
     */
    public function detail(Schedule $schedule)
    {
        $this->authorize('trainer_detail',$schedule);

        $schedule = Schedule::with('user','plan','time','area')->where('id',$schedule->id)->first();
        $record = Record::where('schedule_id',$schedule->id)->first();

        return view('trainer.record.detail',compact('schedule','record'));
    }


    /**
     * フィードバック投稿画面表示
     * 
     * @param array shceudle
     * 
     * @return array scheudle
     */
    public function record_form(Schedule $schedule)
    {
        $this->authorize('record_form',$schedule);

        $schedule = Schedule::where('id',$schedule->id)->first();

        return view('trainer.record.record_form',compact('schedule'));
    }


    /**
     * 投稿処理
     * 
     * @param RecordRequest $request
     * @param mixed $schedule
     * 
     */
    public function post_record(RecordRequest $request, Schedule $schedule)
    {
        $this->authorize('post_record',$schedule);

        DB::transaction(function () use($request,$schedule){
            $record = new Record();
            $record->schedule_id = $schedule->id;
            $record->menu = $request->menu;
            $record->feedback = $request->feedback;
            $record->save();
        });

        $request->session()->regenerateToken();

        return redirect()->route('trainer.record.top');
    }


    /**
     * 編集画面表示
     * 
     * @param mixed $schedule
     * 
     * @return mixed $schedule
     * @return mixed $record
     */
    public function edit_form(Schedule $schedule)
    {
        $this->authorize('edit_form',$schedule);

        $records = Record::where('schedule_id',$schedule->id)->get();

        return view('trainer.record.edit_form',compact('records','schedule'));
    }


    /**
     * 編集処理
     * 
     * @param Request $requst
     * @param mixed $schedule
     */
    public function edit(RecordRequest $request, Schedule $schedule)
    {
        $this->authorize('edit',$schedule);
        DB::transaction(function () use($request){

            Record::where('id',$request->record_id)->update([
                'menu' => $request->menu,
                'feedback' => $request->feedback,
            ]);
        });

        $request->session()->regenerateToken();
        
        return redirect()->route('trainer.record.top');
    }
}
