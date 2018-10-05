<?php
/**
 * Created by PhpStorm.
 * User: ilr
 * Date: 2018/10/5
 * Time: 16:51
 */

namespace App\Http\Controllers;


use App\Models\Users;
use Illuminate\Http\Request;

class ActiveController extends Controller
{
    public function join(Request $request){
        $user_id = $request->get('user_id');
        if(empty($user_id)){
            return ['code'=>0,'msg'=>'参数不能为空'];
        }
        $user = Users::getOneByWhere(['user_id'=>$user_id]);
        if(empty($user)) {
            return ['code'=>0, 'msg'=>'openid获取失败'];
        }
        if($user->is_join) {
            return ['code'=>1, 'msg'=>'已经参与活动'];
        }
        $user->is_join = 1;//参与
        if($user->save()){
            return ['code'=>1, 'msg'=>'成功参与活动'];
        } else {
            return ['code'=>0, 'msg'=>'参与活动失败'];
        }
    }

    public function joinUsers(){
        $select = ['user_id','nickname','avatar','is_join','join_time','help_num','openid'];
        $user = Users::getAllByWhere(['is_join'=>1],$select);
       if(empty($user)){
           return ['code'=>0, 'msg'=>'无人参与'];
       }
        $userArr = $user->toArray();
        return ['code'=>1, 'msg'=>'','data'=>$userArr,'count'=>count($userArr)];
    }

    public function help(Request $request){
        $user_id = $request->get('user_id');
        if(empty($user_id)){
            return ['code'=>0,'msg'=>'参数不能为空'];
        }
        $user = Users::getOneByWhere(['user_id'=>$user_id]);
        $user->help_num += 1;
        if($user->save()){
            return ['code'=>1, 'msg'=>'力助成功'];
        } else {
            return ['code'=>0, 'msg'=>'力助失败'];
        }
    }


}