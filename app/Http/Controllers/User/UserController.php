<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Type;
use App\Models\TrainerProfile;
use App\Models\Plan;
use Illuminate\Http\Request;

/**
 * トップ画面からトレーナープロフィール詳細までのコントローラー
 */

class UserController extends Controller
{
    /**
     * トップ画面の表示及び、検索に必要なパラメータの取得
     * 
     * @return mixed type
     * @return mixed area
     */
    public function index()
    {
        $types = Type::all();
        $areas = Area::all();

        return view('user.top',compact('types','areas'));
    }

    /**
     * 検索処理及び、トレーナー表示
     * 
     * @param Request $request
     * 
     * @return mixed trainer,plan
     */
    public function show(Request $request)
    {
        if(!empty($request->type) && !empty($request->area)){
            
            $trainers = TrainerProfile::with('Plan')->where('id',function($query)use($request){
                $query->from('trainer_types')
                    ->select('trainer_profile_id')
                    ->where('type_id',$request->type);
            })->where('id',function($query)use($request){
                $query->from('trainer_areas')
                    ->select('trainer_profile_id')
                    ->where('area_id',$request->area);
            })->paginate(15);

        }elseif(!empty($request->type)){

            $trainers = TrainerProfile::with('Plan')->where('id',function($query)use($request){
                $query->from('trainer_types')
                    ->select('trainer_profile_id')
                    ->where('type_id',$request->type);
            })->paginate(15);

        }elseif(!empty($request->area)){

            $trainers = TrainerProfile::with('Plan')->where('id',function($query)use($request){
                $query->from('trainer_areas')
                    ->select('trainer_profile_id')
                    ->where('area_id',$request->area);
            })->paginate(15);

        }else{
            $trainers = TrainerProfile::with('Plan')->paginate(15);
        }
        
        return view('user.search',compact('trainers'));
    }

    public function detail(TrainerProfile $trainer)
    {
        $trainer_profile = TrainerProfile::where('trainer_id',$trainer->id)->first();

        $profile_id = $trainer_profile->id;

        $plans = Plan::where('trainer_profile_id',$profile_id)->get();

        $trainer_types = Type::whereIn('id',function($query) use ($profile_id){
            $query->from('trainer_types')
                    ->select('type_id')
                    ->where('trainer_profile_id',$profile_id);
            })->get();

        $trainer_areas = Area::whereIn('id',function($query) use ($profile_id){
            $query->from('trainer_areas')
                    ->select('area_id')
                    ->where('trainer_profile_id',$profile_id);
            })->get();
        
        return view('user.trainer_detail',compact('trainer_profile','plans','trainer_types','trainer_areas'));

    }

}
