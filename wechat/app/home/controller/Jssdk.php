<?php
/**
 * Created by PhpStorm.
 * User: zhaoquan
 * Date: 2017/8/8
 * Time: 19:41
 */

namespace app\home\controller;
use houdunwang\view\View;
use houdunwang\wechat\Wechat;
use Curl\Curl;


class Jssdk {
    public function index(){
        //时间戳
        $time = time();
        //随机字符串32
        $nonceStr = md5(microtime(true));
        //p($_SERVER);
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        //jsapi_ticket
        $jsapiTicket = $this->getTicket();
        //算signature
        $str = "jsapi_ticket={$jsapiTicket}&noncestr={$nonceStr}&timestamp={$time}&url={$url}";
        //sha1加密
        $signature = sha1($str);

        return View::make()->with(compact('time','signature','nonceStr'));
    }

    /**
     * 获取jsApiTicket
     * @return mixed
     */
    public function getTicket(){
        $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.Wechat::getAccessToken().'&type=jsapi';
        $data = (new Curl())->get($url);
        //p($data);exit;
        $data = json_decode($data->response,true);
        return $data['ticket'];
    }
}