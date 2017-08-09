<?php
function p($var){
    echo '<pre style="background: #ccc;padding: 5px">';
    print_r($var);
    echo '</pre>';
}
//c('wechat.token')
function c($path){
    //include './system/config/wechat.php';
    $info=explode('.',$path);
    $config = include './system/config/'. $info[0] . '.php';
    return isset($config[$info[1]])?$config[$info[1]] : NULL;
}