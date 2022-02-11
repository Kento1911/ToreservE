<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\ScheduleComment;
use Illuminate\Support\Facades\DB;


/**
 * 処理用コントローラー
 * 
 * 未承諾一覧から、予約確定処理までを行う
 */
class ScheduleController extends Controller
{   
    /**
     * 未確定予約一覧表示
     * 
     * @return Schedule schedule
     */
    public function unapproved()
    {
        $schedules = Schedule::with('user','plan','time','area')->where('trainer_id',Auth::id())->where('state_flg','<>',3)->where('state_flg','<>',4)->orderBy('date','asc')->paginate(15);

        return view('trainer.schedule.unapproved',compact('schedules'));
    }


    /**
     * 未確定予約詳細表示
     * 
     * @param schedule $schedule
     * 
     * @return schedule scheudle
     * @return schedule_comment schedule_comment
     * @return int sender_id
     */
    public function unapproved_detail(Schedule $schedule)
    {
        $this->authorize('unapproved_detail',$schedule);

        $schedule = Schedule::with('user','plan','time','area')->where('id',$schedule->id)->first();
        $schedule_comment = ScheduleComment::where('schedule_id',$schedule->id)->get();
        $sender_id = Auth::id();

        return view('trainer.schedule.unapproved_detail',compact('schedule','schedule_comment','sender_id'));
    }


    /**
     * 確定確認画面表示
     * 
     * @param schedule $scheudle
     * 
     * @return schedule schedules
     */
    public function approve_form(Schedule $schedule)
    {
        $this->authorize('trainer_approve_form',$schedule);

        $schedule = Schedule::with('user','plan','time','area')->where('id',$schedule->id)->first();

        $today_schedule = Schedule::where([['date',$schedule->date],['trainer_id',$schedule->trainer_id],['time_id',$schedule->time_id],['state_flg',3]])->first();
        if(!is_null($today_schedule)){
            $message = '※同時刻に予約があります';
            return view('trainer.schedule.approve_form',compact('schedule','message'));
        }

        return view('trainer.schedule.approve_form',compact('schedule'));
    }


    /**
     * 承認処理及びコメント投稿
     * 
     * @param Request $request
     * @param Schedule $schedule
     */
    public function approve(ScheduleCommentRequest $request, Schedule $schedule)
    {
        $this->authorize('trainer_approve',$schedule);

        DB::transaction(function()use($request,$schedule){
            $schedule_comment = new ScheduleComment();
            $request = $request->only(['comment']);
            $schedule_comment->schedule_id = $schedule->id;
            $schedule_comment->sender = 1;
            $schedule_comment->receiver = 2;
            $schedule_comment->comment = $request['comment'];
            $schedule_comment->save();
            Schedule::where('id',$schedule->id)->update([
                'state_flg' => 1
            ]);
        });

        $request->session()->regenerateToken();
        
        return redirect()->route('trainer.schedule.unapproved');
    }


    /**
     * 追加連絡画面表示
     *
     * @param Schedule $schedule
     */
    public function contact_form(Schedule $schedule)
    {
        $this->authorize('trainer_contact_form',$schedule);

        $schedules = Schedule::with('user:id,name','plan','time','area')->where('id',$schedule->id)->get();
        $schedule_comment = ScheduleComment::where('schedule_id',$schedule->id)->get();

        return view('trainer.schedule.contact_form',compact('schedules','schedule_comment'));
    }

    public function contact(ScheduleCommentRequest $request, Schedule $schedule)
    {
        $this->authorize('trainer_contact',$schedule);

        DB::transaction(function()use($request,$schedule){
            $schedule_comment = new ScheduleComment();
            $request = $request->only(['comment']);
            $schedule_comment->schedule_id = $schedule->id;
            $schedule_comment->sender = 1;
            $schedule_comment->receiver = 2;
            $schedule_comment->comment = $request['comment'];
            $schedule_comment->save();
            Schedule::where('id',$schedule->id)->update([
                'state_flg' => 1
            ]);
        });

        $request->session()->regenerateToken();

        return redirect()->route('trainer.schedule.unapproved');
    }


    /**
     * キャンセル処理
     *
     * @param Schedule $schedule
     */
    public function cancel(Schedule $schedule)
    {
        $this->authorize('trainer_cancel',$schedule);

        $schedules = Schedule::findOrFail($schedule->id);
        $schedules->delete();

        return redirect()->route('trainer.schedule.unapproved');
    }

    public function confirm(Request $request)
    {
        $id = $request->only('schedule_id');
        $schedule = Schedule::where('id',$id['schedule_id'])->first();
        if($schedule->trainer_id === Auth::id()){
            Schedule::where('id',$id['schedule_id'])->update([
                'state_flg' => 4
            ]);
        }

        $request->session()->regenerateToken();
        
        return redirect()->route('trainer.top');
    }
}
