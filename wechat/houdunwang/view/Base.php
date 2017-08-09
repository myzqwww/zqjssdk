<?php
/**
 * Created by PhpStorm.
 * User: zhaoquan
 * Date: 2017/8/8
 * Time: 19:38
 */

namespace houdunwang\view;


class Base {
private $tpl;
private $var=[];
public function make(){
    $this->tpl="./app/" .APP .'/view/' . CONTROLLER . '/' .ACTION . '.php';
    return $this;
}
public function with($data){
    //把当前   赋值给$data
    $this->var=$data;
    return $this;
}
public function __toString(){
  extract($this->var);
  include $this->tpl;
  return '';
}
}