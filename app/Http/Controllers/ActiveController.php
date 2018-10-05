<?php
/**
 * Created by PhpStorm.
 * User: ilr
 * Date: 2018/10/5
 * Time: 16:51
 */

namespace App\Http\Controllers;


use App\Models\HelpLogs;
use App\Models\Users;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActiveController extends Controller
{
    public function join(Request $request){
        $user_id = $request->get('user_id');
        if(empty($user_id)){
            return ['code'=>0,'msg'=>'参数不能为空'];
        }
        $user = Users::getOneByWhere(['user_id'=>$user_id]);
        if(empty($user)){
            return ['code'=>0,'msg'=>'用户不存在'];
        }
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
        $to_user_id = $request->get('to_user_id');
        $from_user_id = $request->get('from_user_id');
        if(empty($to_user_id) || empty($from_user_id)){
            return ['code'=>0,'msg'=>'参数不能为空'];
        }
        $where = [
            'help_from_user_id'=>$from_user_id,
            'help_to_user_id'  => $to_user_id
        ];
        $log = HelpLogs::getOneByWhere($where);
        if(!empty($log)) {
            return ['code'=>0,'msg'=>'已经力助啦'];
        }
        //行锁？
        $user = Users::getOneByWhere(['user_id'=>$to_user_id]);
        if(empty($user)){
            return ['code'=>0,'msg'=>'用户不存在'];
        }
        DB::beginTransaction(); //开启事务
        try {
            $user->help_num += 1;

            $log = new HelpLogs();
            $log->help_from_user_id = $from_user_id;
            $log->help_to_user_id = $to_user_id;
            if($user->save() &&  $log->save()){
                DB::commit();
                return ['code'=>1, 'msg'=>'力助成功'];
            } else {
                DB::rollback();
                return ['code'=>0, 'msg'=>'力助失败'];
            }

        } catch (Exception $e) {
            DB::rollback();
            return ['code'=>0, 'msg'=>$e->getMessage()];
        }

    }


}