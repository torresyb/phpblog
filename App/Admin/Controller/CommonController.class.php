<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->_init();
    }
    
    /**
     * 初始化
     * @return
     */
    private function _init()
    {
        $isLogin = $this->isLogin();
        if(!$isLogin){
            $this->redirect('/admin/login/index');
        }
    }
    
    /**
     * 判定是否登录
     * @return boolean
     */
    public function isLogin()
    {
        $user = $this->getLoginUser();
        if($user && is_array($user)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * 获取登录用户信息
     * @return array
     */
    public function getLoginUser() {
        return session("adminInfo");
    }
}