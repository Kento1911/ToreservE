<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleCommentRequest;
use App\Models\Schedule;
use App\Models\ScheduleComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * 予約内容の確定を行うコントローラー
 * 
 * 未承諾予約の一覧から確定まで
 * 
 */
class ScheduleController extends Controller
{
    /**
     * 確定済み一覧表示
     * 
     * @return mixed shcedules
     * 
     */
    public function top()
    {
        $schedules = Schedule::with('trainer.TrainerProfile','plan','time','area')
                    ->where([['user_id',Auth::id()],['state_flg',3]])
                    ->orderBy('date','asc')->paginate(15);

        return view('user.schedule.top',compact('schedules'));
    }

    /**
     * 未承諾予約一覧表示
     * 
     * @return mixed schedules
     */
    public function unapproved()
    {
        $schedules = Schedule::with('trainer.TrainerProfile','plan','time','area')
                ->where([['user_id',Auth::id()],['state_flg','<>','3']])
                ->Where([['user_id',Auth::id()],['state_flg','<>','4']])
                ->orderBy('date','asc')->paginate(15);

        return view('user.schedule.unapproved',compact('schedules'));   
    }

    /** 
     * 予約内容詳細表示
     * 
     * @param mixed $scheduke
     * 
     * @return mixed schedules
     * @return mixed schedule_comment
     * @return int sender_id
    */
    public function detail(Schedule $schedule)
    {
        $this->authorize('user_detail',$schedule);

        $schedules = Schedule::with('trainer:id,name','plan','time','area')->where('id',$schedule->id)->get();
        $schedule_comment = ScheduleComment::where('schedule_id',$schedule)->get();
        $sender_id = Auth::id();

        return view('user.schedule.detail',compact('schedules','schedule_comment','sender_id'));
    }

    /**
     * 追加予約フォーム表示
     * 
     * @param mixed $schedule
     * 
     * @return mixed schedule 
     * @return mixed schedule_comment
     */
    public function contact_form(Schedule $schedule)
    {
        $this->authorize('user_contact_form',$schedule);

        $schedules = Schedule::with('trainer:id,name','plan','time','area')->where('id',$schedule->id)->get();
        $schedule_comment = ScheduleComment::where('schedule_id',$schedule->id)->get();

        return view('user.schedule.contact_form',compact('schedules','schedule_comment'));
    }

    /**
     * 連絡内容の保存処理
     * 
     * @param Request $request
     * @param mixed $schedule
     * 
     * 
     * 
     */
    public function contact(ScheduleCommentRequest $request , Schedule $schedule)
    {
        $this->authorize('user_contact',$schedule);

        DB::transaction(function()use($request,$schedule){
            $schedule_comment = new ScheduleComment();
            $request = $request->only(['comment', 'trainer_id']);
            $schedule_comment->sender = 2;
            $schedule_comment->receiver = 1;
            $schedule_comment->schedule_id = $schedule->id;
            $schedule_comment->comment = $request['comment'];
            $schedule_comment->save();
            Schedule::where('id',$schedule->id)->update([
                'state_flg' => 2
            ]);
        });

        $request->session()->regenerateToken();
        
        return redirect()->route('user.schedule.top');
    }

    /**
     * 予約内容の確定処理
     * 
     * @param mixed $schedule
     */
    public function confirm(Schedule $schedule)
    {
        $this->authorize('user_confirm',$schedule);

        $id = $schedule->id;
        Schedule::where('id',$id)->update([
            'state_flg' => 3
        ]);

        return redirect()->route('user.schedule.top');
    }

    /**
     * キャンセル処理
     * 
     * @param mixed $schedule
     */
    public function cancel(Schedule $schedule)
    {
        $this->authorize('user_cancel',$schedule);

        $id = $schedule->id;
        $schedules = Schedule::findOrFail($id);
        $schedule_comment = ScheduleComment::Where('schedule_id',$id);
        $schedule_comment->delete();
        $schedules->delete();

        return redirect()->route('user.schedule.top');
    }
}