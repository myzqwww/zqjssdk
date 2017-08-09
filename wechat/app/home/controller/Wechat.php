<?php
/**
 * Created by PhpStorm.
 * User: zhaoquan
 * Date: 2017/8/7
 * Time: 21:59
 */

namespace app\home\controller;

use houdunwang\wechat\Wechat as Wx;
use Curl\Curl;
/**
 * 第二步骤：订阅认证
 * 查看目录system/config/wechat里面的token必须跟自己微信平台里面的token一致
 * 进行提交认证，如果不能认证成功，说明代码打错，返回复查
 * Class Wechat
 * @package app\home\controller
 */
class Wechat{
    public function handle() {

        //微信验证服务器
        Wx::validate();
        //如果是订阅
        if ( Wx::subscribe() ) {
            //回复订阅成功
            Wx::responseMsg( '订阅成功' );
        }

        /**
         * 第三步骤：关键词回复
         * 用手机扫二维码关注
         * 分别回复以下序号，微信就会分别回复不同对应的消息
         */
        //默认回复.把图灵机器人的
        Wx::responseMsg( $this->getTuling(wx::getContent()) );


    }

    /**
     * 第五步骤：获取图灵接口
     * 先百度packagist.org找到首页输入框输入Curl选择第一个curl/curl复制命令代码composer require curl/curl到phpstorm里面下载
     * 并找到getTuling方法在最上面use Curl\Curl;
     * 写好图灵接口这个方法，然后把获得图灵的方法和回复消息方法作为自动回复 Wx::responseMsg( $this->getTuling(wx::getContent()) );
     * @param string $content
     * @return mixed
     */

    public function getTuling( $content = '北京天气' ) {
        $url = "http://www.tuling123.com/openapi/api?key=8fd4b055a27744579fbb1e4e594d7c61&info=" . $content;
        //curl方式请求，不要用file_get_contents，比较low
        $curl = new Curl();
        $data = $curl->get( $url );
        $arr  = json_decode( $data->response, true );

        //echo $arr['text'];
        return $arr['text'];
    }



    /**
     * 第四步骤：接口调用
     * 到自己的微信平台里面的找到基本配置，进行开发者密码设置和ip白名单设置，设置成功后
     * 然后进行目录system/config/wechat里面的appid和appsecret替换
     * 获取token
     */
    public function handleAccessToken(){
        $accessToken = Wx::getAccessToken();
        echo $accessToken;
    }

    /**
     * 获取微信服务器的IP，需要access_token票据
     */

    public function getIp(){
        $url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=";
        $url .= Wx::getAccessToken();
        //调取接口
        // curl方式请求，不要用file_get_contents，比较low
        $curl=new Curl();
        $data = $curl->get( $url );
        $data = json_decode( $data->response );
//        p($data);exit;
        //输出ip地址，微信服务器很多ip地址
        foreach ($data->ip_list as $ip) {
            echo $ip . '<br/>';
        }
    }



    /**
     * 第六步骤：创建菜单
     * 创建一个数组
     */
    public function createMenu(){
        $data = [
            'button' => [
                [
                    "type" => "view",
                    "name" => "小米页面",
                    "url"  => "https://github.com/myzqwww/zqxm.git"
                ],
                [
                    "type" => "view",
                    "name" => "我的框架",
                    "url"  => "https://github.com/myzqwww/zqwww.git"
                ],
                [
                    "name"       => "后台项目",
                    "sub_button" => [
                        [
                            "type" => "view",
                            "name" => "学生管理系统",
                            "url"  => "https://github.com/myzqwww/zqstu.git"
                        ],
                        [
                            "type" => "view",
                            "name" => "微信jssdk",
                            "url"  => "http://www.myzqwww.com/wechat/index.php?s=home/jssdk/index"
                        ],
                        [
                            "type" => "view",
                            "name" => "留言板",
                            "url"  => "https://github.com/myzqwww/zqmsg.git"
                        ],

                    ]
                ]

            ]
        ];
        $res = Wx::createMenu($data);
        p($res);
    }
    /**
     * 第七步骤
     * 获得菜单
     */
    public function getMenu(){
        $data=Wx::getMenu();
        p($data);exit;
    }
    /**
     * 第八步骤
     * 删除菜单
     */
    public function delMenu(){
        $res=Wx::removeMenu();
        p($res);
    }

}