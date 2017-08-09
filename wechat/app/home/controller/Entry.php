<?php
/**
 * Created by PhpStorm.
 * User: zhaoquan
 * Date: 2017/8/7
 * Time: 21:59
 */
namespace app\home\controller;

use houdunwang\view\View;
/**
 * 第一步步骤：默认首页认证
 * 在浏览器中输入http://www.myzqwww.com/wechat
 * 回车出现'项目认证'
 * Class Entry
 * @package app\home\controller
 */


class Entry {
    public function index(){
        $content=isset($_GET['content']) ? $_GET['content'] : '北京天气';
        $result= (new Wechat())->getTuling($content);
        return View::make()->with(compact('result','content'));
    }
}