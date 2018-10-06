<?php
/**
 * Created by PhpStorm.
 * User: ilr
 * Date: 2018/9/23
 * Time: 18:09
 */

namespace App\Http\Controllers;
use App\Models\Users;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use Log;

class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.');

        $wechat = app('wechat');

        $wechat->server->setMessageHandler(function($message){
            var_dump($message);die;
            return "欢迎关注 overtrue！";
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }

    public function demo(Application $wechat)
    {
        var_dump($user = app()->oauth->user());die();
        var_dump($wechat->access_token->getAppId());die;
        // $wechat 则为容器中 EasyWeChat\Foundation\Application 的实例
        $wechat->user;
        $wechat->access_token;
    }


    public function user(){
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        $users = new Users();
        $openid = $user->getId();
        $res = $users->where(['openid'=>$openid])->first();
       if(empty($res)) {
           $users->openid = $openid;
           $users->name = $user['name'];
           $users->nickname = $user['nickname'];
           $users->avatar = $user['avatar'];
           $users->email = $user['email'];
           $users->original = json_encode($user['original']);
           $users->save();
       }else{
           $users = $res;
       }
        session(['user_id'=>$users->user_id]);
       return ['code'=>count($users->toArray()) ? 1:0,'data'=>$users->toArray()];
    }

    public function ticket(Application $wechat,Request $request){
        return ['data'=>$wechat->jssdk->buildConfig(array('onMenuShareTimeline', 'onMenuShareAppMessage'), true)];
    }
}