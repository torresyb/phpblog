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

/**
 * 获取用户名
 * @return string
 */
function getLoginUserName(){
    return $_SESSION['adminInfo']['username']?$_SESSION['adminInfo']['username']:'';
}

/**
 * 获取文章来源
 * @param number $id
 * @return string
 */
function getCopyFrom($id){
    $copy_from = C('COPY_FROM');
    return $copy_from[$id-1]?$copy_from[$id-1]:'';
}

/**
 * 所属栏目
 * @param array $menus
 * @param number $id
 * @return string
 */
function getCat($menus,$id){
    foreach ($menus as $menu){
        if($menu['menu_id']==$id){
            return $menu['name'];
        }
    }
}

/**
 * 更改文章状态
 * @param number $id
 * @return string
 */
function getStatus($id){
    switch ($id) {
        case 0:
            return '关闭';
            break;
        case 1:
            return '正常';
            break;
        case -1:
            return '删除';
            break;
        default:
            return '';
            break;
    }
}