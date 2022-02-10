<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Area;
use App\Models\Type;
use App\Models\TrainerProfile;
use App\Models\TrainerArea;
use App\Models\TrainerType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TotalTrainerProfileRequest;
use App\Http\Requests\TrainerProfileRequest;
use App\Models\Plan;
use App\Models\Time;
use App\Models\SalesDay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\ViewTrainerProfile;

/**
 * プロフィール処理用コントローラー
 * 
 * プロフィールの作成、編集まで行う
 */

class ProfileController extends Controller
{

    /**
     * プロフィールの一覧の表示
     * 
     * @return TrainerProfile trainer_profile
     * @return Plan plan
     * @return SalesDay sales_day
     * @return TrainerType trainer_type
     * @return TrainerArea trainer_area
     * @return Time time
     */
    public function index()
    {

        $trainer_id = Auth::id(); 

        $trainer_profile = TrainerProfile::where('trainer_id',$trainer_id)->first();

        if(!is_null($trainer_profile)){

            $profile_id = $trainer_profile->id;

            $plans = Plan::where('trainer_profile_id',$profile_id)->get();

            $sales_day = SalesDay::where('trainer_profile_id',$profile_id)->first();

            //sales_daysのカラム名を取得
            $sales_day_columns = Schema::getColumnListing('sales_days');

            //id,trainer_profile_id,timestampを除いたカラム名を取得
            for($i = 2; $i < 16; $i++){
                $colmuns[] = $sales_day_columns[$i];
            }

            //sales_daysより対象プロフィールの情報を取得
            for($i = 0; $i < 14; $i++){
                $value[] = SalesDay::where('trainer_profile_id',$profile_id)->select($colmuns[$i])->first();
            }

            for($i = 0; $i < 14; $i++){
                $time[] = Time::where('id',$value[$i][$colmuns[$i]])->first();
            }

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

            return view('trainer.profiles.index',compact('trainer_profile','plans','sales_day','trainer_types','trainer_areas','time'));
        }
        return view('trainer.profiles.index',compact('trainer_profile'));
    }

    /**
     * プロフィールの新規作成
     * 
     * @return Area areas
     * @return Type types
     * @return Time times
     */
    public function create()
    {
        $areas = Area::all();
        $types = Type::all();
        $times = Time::all();
        return view('trainer.profiles.create',compact('areas','types','times'));
    }


    /**
     * プロフィール、営業日、エリア、タイプの新規作成を一括に行う
     * 
     * @param TotalTrainerProfileRequest $request
     */
    public function store(TotalTrainerProfileRequest $request)
    {
        DB::transaction(function()use($request){

            //Trainer_Profileの保存
            $trainer_profile = new TrainerProfile();

            $trainer_profile->trainer_id = Auth::id();
            $trainer_profile->name = $request->name;
            $trainer_profile->age = (int)$request->age;
            $trainer_profile->sex = $request->sex;
            $trainer_profile->profile_comment = $request->profile_comment;
            $profile_image = $request->file('profile_image');
            if(!is_null($profile_image)){
                $image = new ViewTrainerProfile();
                $path = $image->edit_image($profile_image);
                $trainer_profile->profile_image = $path;
            }
            $trainer_profile->save();

            //Trainer_Profileのidを取得
            $tp_id = $trainer_profile->id;

            //selsDayの保存
            $sales_day = new SalesDay();

            $sales_day->trainer_profile_id = $tp_id;
            if($request->monday_rest === "0" || $request->monday_open === "0" || $request->monday_close === '0'){
                $sales_day->monday_open = "0";
                $sales_day->monday_close = "0";
            }else{
                $sales_day->monday_open = $request->monday_open;
                $sales_day->monday_close = $request->monday_close;
            }

            if($request->tuesday_rest === "0" || $request->tuesday_open === "0" || $request->tuesday_close === "0"){
                $sales_day->tuesday_open = "0";
                $sales_day->tuesday_close = "0";
            }else{
                $sales_day->tuesday_open = $request->tuesday_open;
                $sales_day->tuesday_close = $request->tuesday_close;
            }

            if($request->wednesday_rest === "0" || $request->wednesday_open === "0" || $request->wednesday_close === "0"){
                $sales_day->wednesday_open = "0";
                $sales_day->wednesday_close = "0";
            }else{
                $sales_day->wednesday_open = $request->wednesday_open;
                $sales_day->wednesday_close = $request->wednesday_close;
            }

            if($request->thursday_rest === "0" || $request->thursday_open === "0" || $request->thursday_close === "0"){
                $sales_day->thursday_open = "0";
                $sales_day->thursday_close = "0";
            }else{
                $sales_day->thursday_open = $request->thursday_open;
                $sales_day->thursday_close = $request->thursday_close;
            }

            if($request->friday_rest === "0" || $request->friday_open === "0" || $request->friday_close === "0"){
                $sales_day->friday_open = "0";
                $sales_day->friday_close = "0";
            }else{
                $sales_day->friday_open = $request->friday_open;
                $sales_day->friday_close = $request->friday_close;
            }

            if($request->saturday_rest === "0" || $request->saturday_open === "0" || $request->saturday_close === "0"){
                $sales_day->saturday_open = "0";
                $sales_day->saturday_close = "0";
            }else{
                $sales_day->saturday_open = $request->saturday_open;
                $sales_day->saturday_close = $request->saturday_close;
            }

            if($request->sunday_rest === "0" || $request->sunday_open === "0" || $request->sunday_close === "0"){
                $sales_day->sunday_open = "0";
                $sales_day->sunday_close = "0";
            }else{
                $sales_day->sunday_open = $request->sunday_open;
                $sales_day->sunday_close = $request->sunday_close;
            }
            $sales_day->save();


            //areaの保存
            $i = 0;
            foreach($request->only('area') as $area){
                foreach($area as $key => $val){
                    if( $i === 5 ){
                        break ;
                    }
                $trainer_area = new TrainerArea();
                $trainer_area->area_id = $val;
                $trainer_area->trainer_profile_id = $tp_id;
                $trainer_area->save();
                $i++;
                }
            }
        
            //typeの保存
            $i = 0;
            foreach($request->only('type') as $type){
                foreach($type as $key => $val){
                    if( $i === 5 ){
                        break ;
                    }
                $trainer_type = new TrainerType();
                $trainer_type->type_id = $val;
                $trainer_type->trainer_profile_id = $tp_id;
                $trainer_type->save(); 
                $i++;
                }
            }

            //planの保存
            $plan_inputs = $request->only('plan_name','price','time','introduction');
            //$requestのキーの取得
            $keys = array_keys($plan_inputs);
            //各配列の長さの取得
            $count = count($plan_inputs[$keys[0]]);
            //最大5つまで保存
            if($count > 5){
                $count = 5;
            }
            for($i = 0; $i<$count; $i++){
                //各配列の列を取得
                $input = array_column($plan_inputs, $i);
                
                $plan = new Plan();
                $plan->plan_name = $input[0];  
                $plan->price = (int)$input[1]; 
                $plan->time = (int)$input[2];
                $plan->introduction = $input[3]; 
                $plan->trainer_profile_id = $tp_id;
                $plan->save();
            };
        });

        $request->session()->regenerateToken();

        return redirect()->route('trainer.profile.index');
    }


    /**
     * プロフィール編集画面の表示
     * 
     * @param Trainer $trainer_profile
     * 
     * @return TrainerProfile trainer_profile
     * @return Time times
     * @return Area areas
     * @return Type types
     */
    public function edit_profile(TrainerProfile $trainer_profile)
    {
        $this->authorize('edit_profile', $trainer_profile);
        $trainer_profile = TrainerProfile::where('id',$trainer_profile->id)->first();
        $times = Time::all();
        $areas = Area::all();
        $types = Type::all();

        return view('trainer.profiles.edit_profile',compact('trainer_profile','times','areas','types'));
    }


    /**
     * プロフィールの編集内容登録処理
     * 
     * @param TrainberProfileRequest $request
     * @param TrainerProfile $trainer_profile
     */
    public function update_profile(TrainerProfileRequest $request,TrainerProfile $trainer_profile)
    {
        $this->authorize('update_profile', $trainer_profile);
        DB::transaction(function () use($request,$trainer_profile){
        
            //プロフィールの編集
            $profile_image = $request->file('profile_image');
            if(!is_null($profile_image)){
                $image = new ViewTrainerProfile();
                $path = $image->edit_image($profile_image);

                TrainerProfile::where('id',$trainer_profile->id)->update([
                    'name' => $request->name,
                    'age' => (int)$request->age,
                    'sex' => $request->sex,
                    'profile_comment' => $request->profile_comment,
                    'profile_image' => $path
                ]);
            }else{
                TrainerProfile::where('id',$trainer_profile->id)->update([
                    'name' => $request->name,
                    'age' => (int)$request->age,
                    'sex' => $request->sex,
                    'profile_comment' => $request->profile_comment,
                ]);
            }

            //エリアの編集
            TrainerArea::where('trainer_profile_id',$trainer_profile->id )->delete();
            $i = 0;
            foreach($request->only('area') as $area){
                foreach($area as $key => $val){
                    if( $i === 5 ){
                        break ;
                    }
                $trainer_area = new TrainerArea();
                $trainer_area->area_id = $val;
                $trainer_area->trainer_profile_id = $trainer_profile->id;
                $trainer_area->save();
                $i++;
                }
            }

            //タイプの編集
            TrainerType::where('trainer_profile_id',$trainer_profile->id)->delete();
            $i = 0;
            foreach($request->only('type') as $type){
                foreach($type as $key => $val){
                    if( $i === 5 ){
                        break ;
                    }
                $trainer_type = new TrainerType();
                $trainer_type->type_id = $val;
                $trainer_type->trainer_profile_id = $trainer_profile->id;
                $trainer_type->save(); 
                $i++;
                }  
            }

            //営業日の編集
            if($request->monday_rest === "0" || $request->monday_open === "0" || $request->monday_close === '0'){
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'monday_open' => "0",
                    'monday_close' => "0",
                ]);
            }else{
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'monday_open' => $request->monday_open,
                    'monday_close' => $request->monday_close
            ]);}

            if($request->tuesday_rest === "0" || $request->tuesday_open === "0" || $request->tuesday_close === "0"){
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'tuesday_open' => "0",
                    'tuesday_close' => "0",
                ]);
            }else{
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'tuesday_open' => $request->tuesday_open,
                    'tuesday_close' => $request->tuesday_close
            ]);}

            if($request->wednesday_rest === "0" ||$request->wednesday_open === "0" || $request->wednesday_close === "0"){
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'wednesday_open' => "0",
                    'wednesday_close' => "0",
                ]);
            }else{
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'wednesday_open' => $request->wednesday_open,
                    'wednesday_close' => $request->wednesday_close
            ]);}

            if($request->thursday_rest === "0" || $request->thursday_open === "0" || $request->thursday_close === "0"){
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'thursday_open' => "0",
                    'thursday_close' => "0",
                ]);
            }else{
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'thursday_open' => $request->thursday_open,
                    'thursday_close' => $request->thursday_close
            ]);}

            if($request->friday_rest === "0" || $request->friday_open === "0" || $request->friday_close === "0"){
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'friday_open' => "0",
                    'friday_close' => "0",
                ]);
            }else{
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'friday_open' => $request->friday_open,
                    'friday_close' => $request->friday_close
            ]);}

            if($request->saturday_rest === "0" || $request->saturday_open === "0" || $request->saturday_close === "0"){
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'saturday_open' => "0",
                    'saturday_close' => "0",
                ]);
            }else{
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'saturday_open' => $request->saturday_open,
                    'saturday_close' => $request->saturday_close
            ]);}

            if($request->sunday_rest === "0" || $request->sunday_open === "0" || $request->sunday_close === "0"){
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'sunday_open' => "0",
                    'sunday_close' => "0",
                ]);
            }else{
                SalesDay::where('trainer_profile_id',$trainer_profile->id)->update([
                    'sunday_open' => $request->sunday_open,
                    'sunday_close' => $request->sunday_close
            ]);}
        });

        $request->session()->regenerateToken();

        return redirect()->route('trainer.profile.index');
    }


    /**
     * プランの編集画面表示
     * 
     * @param Plan $plan
     * 
     * @return Plan $plan
     */
    public function edit_plan(Plan $plan)
    {
        $trainer_profile = TrainerProfile::whereIn('id',function ($query) use ($plan){
            $query->from('plans')
            ->select('trainer_profile_id')
            ->where('id',$plan->id);
        })->first();
        $this->authorize('edit_plan', $trainer_profile);

        $plan = Plan::where('id',$plan->id)->first();

        return view('trainer.profiles.edit_plan',compact('plan'));
    }


    /**
     * プランの編集処理
     * 
     * @param Request $request
     * @param Plan $plan
     */
    public function update_plan(PlanRequest $request, Plan $plan)
    {
        $trainer_profile = TrainerProfile::whereIn('id',function ($query) use ($plan){
            $query->from('plans')
            ->select('trainer_profile_id')
            ->where('id',$plan->id);
        })->first();
        $this->authorize('update_plan', $trainer_profile);

        DB::transaction(function () use($request,$plan){
            Plan::where('id',$plan->id)->update([
                'plan_name' => $request->plan_name,
                'price' => (int)$request->price,
                'time' => (int)$request->time,
                'introduction' => $request->introduction
            ]);
        });

        $request->session()->regenerateToken();

        return redirect()->route('trainer.profile.index');
    }


    /**
     * プランの新規作成ページ
     * 
     * @param TrainerPRofile $trainer_profile
     * 
     * @return Profile profile
     */
    public function create_plan(TrainerProfile $trainer_profile)
    {
        $profile = TrainerProfile::where('id',$trainer_profile->id)->first();

        return view('trainer.profiles.create_plan',compact('profile'));
    }


    /**
     * 新規作成プランの保存
     * 
     * @param Request $request
     * @param Profile $profile
     */
    public function store_plan(PlanRequest $request, TrainerProfile $profile)
    {

        DB::transaction(function () use($request,$profile){
            $tp_id = $profile->id;

            $count = Plan::where('trainer_profile_id',$tp_id)->count();

            if(!$count > 5){

                $plan_inputs = $request->only('plan_name','price','time','introduction');
                //$request内の配列のキーの取得
                $keys = array_keys($plan_inputs);

                //各配列の長さの取得
                $count = count($plan_inputs[$keys[0]]);

                for($i = 0; $i<$count; $i++){
                    //各配列の列を取得
                    $input = array_column($plan_inputs, $i);
                    
                    $plan = new Plan();
                    $plan->plan_name = $input[0];  
                    $plan->price = $input[1];
                    $plan->time = $input[2];
                    $plan->introduction = $input[3]; 
                    $plan->trainer_profile_id = $tp_id;
                    $plan->save();
                    $request->session()->regenerateToken();
                };
            }
        });


        return redirect()->route('trainer.profile.index'); 
    }


    /**
     * プランの削除確認画面表示
     * 
     * @param Plan $plan
     * @return Plan plan
     */
    public function delete_plan(Plan $plan)
    {
        $trainer_profile = TrainerProfile::whereIn('id',function ($query) use ($plan){
            $query->from('plans')
            ->select('trainer_profile_id')
            ->where('id',$plan->id);
        })->first();
        $this->authorize('delete_plan', $trainer_profile);

        $plan = Plan::where('id',$plan->id)->first();

        return view('trainer.profiles.delete_plan',compact('plan'));
    }


    /**
     * プランの削除処理
     * 
     * @param mixed $plan
     */
    public function destroy_plan(Plan $plan)
    {
        $trainer_profile = TrainerProfile::whereIn('id',function ($query) use ($plan){
            $query->from('plans')
            ->select('trainer_profile_id')
            ->where('id',$plan->id);
        })->first();
        $this->authorize('destroy_plan', $trainer_profile);

        $delete_plan = Plan::findOrFail($plan->id);
        $delete_plan->delete();

        return redirect()->route('trainer.profile.index');
    }
}
