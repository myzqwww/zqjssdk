<?php
/**
 * Created by PhpStorm.
 * User: zhaoquan
 * Date: 2017/8/7
 * Time: 21:25
 */
namespace houdunwang\core;
class Boot {
    /**
     * 执行框架
     */
    public static function run(){
        //初始化框架
        self::init();
        //执行应用
        self::appRun();
    }

    /**
     * 初始化框架
     */
    private static function appRun(){
        //1.当有get传参的时候$s的值就是传参的值，否则默认值就是"home/entry/index"；
        //2.home表示前台应用，entry表示控制器的名称，index表示控制器里面的方法名
        $s = isset($_GET['s']) ? strtolower($_GET['s']) : 'home/entry/index';
        //1.把$s的值通过"/"分界转换成数组
        //2.这样方便数据的调用
        $info = explode('/',$s);


        //定义组合模板的常量
        define('APP',$info[0]);
        define('CONTROLLER',$info[1]);
        define('ACTION',$info[2]);


        $className = "\app\\{$info[0]}\controller\\" . ucfirst($info[1]);
        echo call_user_func_array([new $className,$info[2]],[]);
    }

    /**
     * 初始化框架
     */
    private static function init(){
        //先判断是否有session_id，如果没有就开启session
        session_id() || session_start();
        //设置时区
        date_default_timezone_set('PRC');
        //1.创建常量
        //2.判断用户使用post的请求方式来点击的提交按钮
        define('IS_POST',$_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);
    }
}