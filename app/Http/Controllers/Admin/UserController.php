<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * ユーザー用コントローラー
 * 
 * ユーザー一覧から、ユーザーの削除まで行える
 */
class UserController extends Controller
{

    /**
     * ユーザー一覧表示
     *
     */
    public function top()
    {
        $users = User::withTrashed()->paginate(15);

        return view('admin.user.top',compact('users'));
    }


    /**
     * 検索処理
     *
     * @param Request $request
     * 
     * @return User user
     */
    public function search(Request $request)
    {
        $users = User::withTrashed()->paginate(15);
        $name = $request->input('name');

        if($request->has('name') && !is_null($request->name)){
            $users = User::where('name','like','%'.$name.'%')->withTrashed()->paginate(15);

            return view('admin.user.top',compact('users'));
        }

        return view('admin.user.top',compact('users'));
    }


    /**
     * 論理削除
     *
     * @param Request $request
     */
    public function delete(Request $request)
    {
        User::where('id',$request->user_id)->delete();

        return redirect()->route('admin.user.top');
    }


    /**
     * 論理削除中ユーザー一覧
     * 
     * @return User user
     */
    public function stop_user()
    {
        $users = User::onlyTrashed()->withTrashed()->paginate(15);

        return view('admin.user.stop_user',compact('users'));
    }


    /**
     * 論理削除中ユーザー検索
     *
     * @param Request $request
     * 
     * @return User user
     */
    public function stop_user_search(Request $request)
    {
        $users = User::onlyTrashed()->paginate(15);

        $name = $request->input('name');

        if($request->has('name') && !empty($request->name)){
            $users = User::where('name','like','%'.$name.'%')->withTrashed()->paginate(15);

            return view('admin.user.stop_user',compact('users'));
        }
        return view('admin.user.stop_user',compact('users'));
    }


    /**
     * 論理削除復活処理
     *
     * @param Request $request
     */
    public function restore(Request $request)
    {
        $id = (int)$request->trainer_id;
        User::where('id',$id)->restore();

        return redirect()->route('admin.user.top');
    }


    /**
     * 物理削除
     *
     * @param Request $request
     */
    public function force_delete(Request $request)
    {
        $id = (int)$request->trainer_id;
        User::where('id',$id)->forceDelete();

        return redirect()->route('admin.user.top');
    }
}
