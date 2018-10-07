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
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
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
        return redirect('dist/index.html');
    }

    public function ticket(Application $wechat,Request $request){
        $url = $request->get('url');
        $wechat->js->setUrl($url);
        return ['data'=>$wechat->js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage'), false)];
    }

}