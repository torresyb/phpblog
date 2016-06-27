<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
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
            try {
                // Model 方法
                $rst = D('Admin')->getAdminByUsername($username);
                
                if($rst && $rst['status']==1){
                    if($rst['password'] == getMd5Password($password)){
                        // session全局存储
                        session('adminInfo',$rst);
                        // mysql存储登陆信息
                        $data['lastlogintime'] = time();
                        $data['lastloginip'] = get_client_ip();
                        D("Admin")->update($rst['admin_id'],$data);
                        //请求返回信息
                        show(1,'登陆成功');
                    }else{
                        show(0,'密码不正确');
                    }
                    
                }else {
                    show(0,'不存在该用户');
                }
            } catch (Exception $e) {
                show(0, $e->getMessage());
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
        
        $rst = D('Admin')->getAdminByUsername($data['username']);
        if($rst){
            show(0, '该用户已存在');
        }
        
        if($data['username']!="" && $data['password']!=""){
            $data['status'] = '1';
            $data['lastlogintime'] = time();
            $data['lastloginip'] = get_client_ip();
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