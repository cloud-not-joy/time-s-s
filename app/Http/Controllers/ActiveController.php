<?php
/**
 * Created by PhpStorm.
 * User: ilr
 * Date: 2018/10/5
 * Time: 16:51
 */

namespace App\Http\Controllers;



use App\Models\Activity;
use App\Models\HelpLogs;
use App\Models\Users;
use EasyWeChat\Support\Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActiveController extends Controller
{
    public function join(){
        $user_id =  session('user_id');//$request->get('user_id');
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
        $join_num = Activity::getOne();
        DB::beginTransaction();
        try {
            $join_num->activity_join_num += 1;
            if ($user->save() && $join_num->save()) {
                if(  $join_num->activity_join_num == 400){
                    //触发开奖 后台执行
                }
                DB::commit();
                return ['code' => 1, 'msg' => '成功参与活动'];
            } else {
                DB::rollback();
                return ['code' => 0, 'msg' => '参与活动失败'];
            }
        }catch (Exception $e) {
            DB::rollback();
            return ['code'=>0, 'msg'=>$e->getMessage()];
        }
    }

    public function joinUsers(){
        $select = ['nickname','avatar'];
        $user = Users::getAllByWhere(['is_join'=>1],$select);
       if(empty($user)){
           return ['code'=>0, 'msg'=>'无人参与'];
       }
        $userArr = $user->toArray();
        return ['code'=>1, 'msg'=>'','data'=>$userArr,'count'=>count($userArr)];
    }

    public function help(Request $request){
        $to_user_id = $request->get('to_user_id');
        $from_user_id = session('user_id');
        if(empty($to_user_id) || empty($from_user_id) || $to_user_id == $from_user_id){
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

    public function helpPerson(){
        $user_id = session('user_id');
        $where = ['help_to_user_id'=>$user_id];
        $select = ['nickname','avatar'];
        $logs =  HelpLogs::getAllByWhere($where,$select);
        return ['code'=>$logs->count()?1:0,'data'=>$logs, 'count'=>$logs->count()];
    }

    /**
     * 查看是否获奖
     * @return array
     */
    public function openPrize(){
        $select=['activity_open_prize_time','activity_status','activity_win_user_id'];
       $res = Activity::getOneByWhere($select);
       if(!$res) {
           return ['code'=>0, 'msg'=>'活动没有被设置'];
       }
       if($res->activity_status) {
           $user_id_arr = json_decode($res->activity_win_user_id);
           $user_info = Users::getWinPerson($user_id_arr);
           return ['code'=>1,'data'=>$user_info, 'activity_status'=>1];
       } else{
           $data = ['activity_open_prize_time'=>$res->activity_open_prize_time];
           return ['code'=>1,'data'=>$data, 'activity_status'=>0];
       }

    }

    /**
     * 定时或者满400人则开奖
     */
    public function timedAward(){
        $select=['activity_open_prize_time','activity_status','activity_win_user_id'];
        $res = Activity::getOne($select);

    }






}