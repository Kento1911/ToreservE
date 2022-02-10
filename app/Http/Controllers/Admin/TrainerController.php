<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Plan;
use App\Models\SalesDay;
use App\Models\Time;
use App\Models\Trainer;
use App\Models\TrainerProfile;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

/**
 * トレーナー用コントローラー
 * 
 * トレーナー一覧から、トレーナーの削除まで行える
 */
class TrainerController extends Controller
{

    /**
     * トレーナー一覧表示
     * 
     * @return Trainer trainer
     * @return Type type
     */
    public function top()
    {
        $trainers = Trainer::with('TrainerProfile')->withTrashed()->paginate(15);
        $types = Type::all();

        return view('admin.trainer.top',compact('trainers','types'));
    }


    /**
     * 検索処理
     * アカウント名で検索
     *
     * @param Request $request
     * 
     * @return Trainer trainer
     * @return Type type
     */
    public function search(Request $request)
    {
        $trainers = Trainer::with('TrainerProfile')->paginate(15);
        $types = Type::all();

        $name = $request->input('name');

        if($request->has('name') && !empty($request->name)){
            $trainers = Trainer::with('TrainerProfile')->where('name','like','%'.$name.'%')->paginate(15);

            return view('admin.trainer.top',compact('trainers','types'));
        }
        return view('admin.trainer.top',compact('trainers','types'));
    }
    

    /**
     * トレーナーのプロフィール詳細
     *
     * @param Trainer $trainer
     * 
     * @return Trainer trainer
     * @return TrainerProfile trainer_profile
     * @return Plan plans
     * @return Type trainer_types
     * @return Area trainer_areas
     * @return Times times
     */
    public function detail(Trainer $trainer)
    {
        $trainer_profile = TrainerProfile::where('trainer_id',$trainer->id)->first();
        if(isset($trainer_profile)){

            $profile_id = $trainer_profile->id;

            $plans = Plan::where('trainer_profile_id',$profile_id)->get();

            $sales_day = SalesDay::where('trainer_profile_id',$profile_id)->first();

            //sales_daysのカラム名を取得
            $sales_day_columns = Schema::getColumnListing('sales_days');

            //salse_dayテーブルからid,trainer_profile_id,timestampを除いたカラム名を取得
            for($i = 2; $i < 16; $i++){
                $colmuns[] = $sales_day_columns[$i];
            }

            //sales_daysより対象プロフィールの情報を取得
            for($i = 0; $i < 14; $i++){
                $value[] = SalesDay::where('trainer_profile_id',$profile_id)->select($colmuns[$i])->first();
            }
            //timesより対象プロフィールの営業時間を取得
            for($i = 0; $i < 14; $i++){
                $time[] = Time::where('id',$value[$i][$colmuns[$i]])->first();
            }

            //タイプ取得
            $trainer_types = Type::whereIn('id',function($query) use ($profile_id){
                $query->from('trainer_types')
                        ->select('type_id')
                        ->where('trainer_profile_id',$profile_id);
                })->get();

            //エリア取得
            $trainer_areas = Area::whereIn('id',function($query) use ($profile_id){
                $query->from('trainer_areas')
                        ->select('area_id')
                        ->where('trainer_profile_id',$profile_id);
                })->get();

            return view('admin.trainer.detail',compact('trainer','trainer_profile','plans','sales_day','trainer_types','trainer_areas','time'));
        }

        return view('admin.trainer.detail',compact('trainer'));
    }


    /**
     * トレーナーの論理削除
     *
     * @param Trainer $trainer
     * @return void
     */
    public function stop_account(Trainer $trainer)
    {
        TrainerProfile::where('id',$trainer->id)->delete();
        Trainer::findOrFail($trainer->id)->delete();

        return redirect()->route('admin.trainer.top');
    }


    /**
     * 論理削除トレーナー一覧
     *
     * @return void
     */
    public function stop_trainer()
    {
        $trainers = Trainer::onlyTrashed()->paginate(15);

        return view('admin.trainer.stop_trainer',compact('trainers'));
    }


    /**
     * 論理削除中トレーナー検索処理
     *
     * @param Request $request
     * 
     * @return Trainer trainers
     */
    public function stop_trainer_search(Request $request)
    {
        $trainers = Trainer::onlyTrashed()->paginate(15);

        $name = $request->input('name');

        if($request->has('name') && !empty($request->name)){
            $trainers = Trainer::onlyTrashed()->where('name','like','%'.$name.'%')->paginate(15);

            return view('admin.trainer.stop_trainer',compact('trainers'));
        }
        return view('admin.trainer.stop_trainer',compact('trainers'));
    }


    /**
     * 論理削除復活処理
     *
     * @param Request $request
     */
    public function restore(Request $request)
    {
        $id = (int)$request->trainer_id;
        TrainerProfile::where('trainer_id',$id)->restore();
        Trainer::where('id',$id)->restore();

        return redirect()->route('admin.trainer.top');
    }


    /**
     * 物理削除
     *
     * @param Request $request
     */
    public function force_delete(Request $request)
    {
        $id = (int)$request->trainer_id;
        TrainerProfile::where('trainer_id',$id)->forceDelete();
        Trainer::where('id',$id)->forceDelete();

        return redirect()->route('admin.trainer.top');
    }
}
