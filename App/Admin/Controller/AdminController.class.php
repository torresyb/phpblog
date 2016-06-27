<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Page;

class AdminController extends CommonController
{
    public function index()
    {   
        $data= array();
        // 分页
        $page = I('p',1,'int');
        $pagesize = 3;
        $admins = D("Admin")->getAdmins($data,$page,$pagesize);
        $totalRows = D("Admin")->getAdminsCount();
        $tpage = new Page($totalRows,$pagesize);
        $pagination = $tpage->show();
        $this->assign("admins",$admins);
        $this->assign("pagination",$pagination);
        $this->assign(array('title'=>'用户管理','navname'=>'用户管理'));
        $this->display();
    }
    
    /**
     *  添加用户界面
     */
    public function add()
    {
        $this->assign(array('title'=>'用户管理','navname'=>'添加用户'));
        try {
            if(IS_POST){
                $str = I('data','','strip_tags,trim');
                parse_str($str);
                $data['username'] = $username;
                $data['password'] = getMd5Password($password);
                $data['realname'] = $realname;
                $data['email'] = $email;
                
                if(!$data['username']){
                    show(0, '请填写用户名');
                }
                if(!$data['password']){
                    show(0, '请填写密码');
                }
                if(!$data['realname']){
                    show(0, '请填写真实姓名');
                }
                $admin = D("Admin")->getAdminByUsername($username);
                if($admin && $admin['status']!=-1){
                    show(0, '用户名已经存在');
                }
                if($id){
                    $rst = D("Admin")->update($id,$data);
                    if($rst){
                        show(1, "更新用户成功");
                    }else{
                        show(0, "更新用户失败");
                    }
                }else{
                    $rst = D("Admin")->insert($data);
                    if($rst){
                        show(1, "添加用户成功");
                    }else{
                        show(0, "添加用户失败");
                    }
                }
            }else{
                $id = I('id','','int');
                if(is_numeric($id) && $id>0){
                    $admin = D("Admin")->getAdmin($id);
                    if(!is_array($admin)){
                        $this->redirect('/admin/admin/index');
                    }
                    $this->assign('admin',$admin);
                }
                
                $this->display();
            }
        } catch (Exception $e) {
            show(0, $e->getMessage());
        }
    }
    
/**
     * 删除推荐位和状态改变
     * @param number $id
     * @return number
     */
    public function delete() {
        if(IS_POST){
            $id = I('id','','int');
            $status = I('status',-1,'int');
            if(!empty($id) && is_int($id)){
                $rst = D('Admin')->statusDelete($id,$status);
                if($rst){
                    $status==-1?show(1, '删除成功'):show(1, '更改状态成功','1');
                }else {
                    $status==-1?show(0, '删除失败'):show(0, '更新状态失败','1');
                }
            }
        }
    }
}