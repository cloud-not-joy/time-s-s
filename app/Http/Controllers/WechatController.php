<?php
/**
 * Created by PhpStorm.
 * User: ilr
 * Date: 2018/9/23
 * Time: 18:09
 */

namespace App\Http\Controllers;
use EasyWeChat\Foundation\Application;
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
        var_dump($wechat->access_token->getAppId());die;
        // $wechat 则为容器中 EasyWeChat\Foundation\Application 的实例
        $wechat->user;
        $wechat->access_token;
    }

}