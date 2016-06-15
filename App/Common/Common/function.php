<?php

/**
 * ajax 返回值
 * @param int $status
 * @param string $msg
 * @param array $data
 */
function show($status, $msg, $data= array()){
    $rst = array(
        'status' => $status,
        'msg' => $msg,
        'data' => $data
    );
    
    exit(json_encode($rst));
}

/**
 * 获取加密的密码
 * @param string $pwd
 */
function getMd5Password($pwd){
    return md5($pwd.C('MD5_PRE'));   
}

/**
 * 后台菜单类型
 * @param number $type
 */
function getMenuType($type){
    $str = '';
    switch ($type){
        case 1 :
            $str = '后台菜单';
            break;
        case 0 :
            $str = '前台导航';
            break;
        default:
            break;
    }
    return $str;
}

/**
 * 后台菜单状态
 * @param number $status
 * @return string 
 */
function getMenuStatus($status){
    $str = '';
    switch ($type){
        case 0 :
            $str = '关闭状态';
            break;
        case 1 :
            $str = '正常状态';
            break;
        case -1 :
            $str = '删除状态';
            break;
        default:
            break;
    }
    return $str;
}

/**
 * 菜单列表添加active
 * @param str $navc
 * @return string
 */
function getActive($navc){
    $c = strtolower(CONTROLLER_NAME);
    
    if(strtolower($navc) === $c){
        return 'class="active"';
    }else{
        return '';
    }
}

function getLoginUser(){
    return session('adminInfo') && session('adminInfo').username;
}