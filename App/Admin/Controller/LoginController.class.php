<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends CommonController
{
    public function _before_index()
    {
        if (session('adminInfo')){
            $this->redirect('/admin/index/index');exit();
        }
    }
    
    public function index()
    {
        layout('layoutempty');
        $this->assign('title','登陆页面');
        
        $this->display();
    }
    

    /**
     *  登陆判断
     */
    public function check()
    {
        $username = I('username','','strip_tags,trim');
        $password = I('password','','strip_tags,trim');
        
        if($username!="" && $password!=""){
            // Model 方法
            $rst = D('Admin')->getAdminByUsername($username);
            
            if($rst){
                if($rst['password'] == getMd5Password($password)){
                    session('adminInfo',$rst);
                    show(1,'登陆成功');
                }else{
                    show(0,'密码不正确');
                }
                
            }else {
                show(0,'不存在该用户');
            }
            
        }else {
            show(0, '填写信息有误');
        }
    }
    
    /**
     * 注册
     */
    public function add()
    {
        
        $data['username'] = I('username','','strip_tags,trim');
        $data['password'] = getMd5Password(I('password','','strip_tags,trim'));

        if($data['username']!="" && $data['username']!=""){
            $data['status'] = '1';
            $reslut = M('Admin')->add($data);
            if($reslut){
                show(1, '注册成功');
            }else{
                show(0, '注册失败');
            }
        }else{
            show(0, '注册信息有误');
        }
    
    }
    
    /**
     * 退出登录
     */
    public function loginout()
    {
        session('adminInfo', null);
        $this->redirect('/admin/login/index');
    }
}