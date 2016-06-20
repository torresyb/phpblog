<?php
namespace Admin\Controller;

use Think\Controller;

class AdminController extends CommonController
{
    public function index()
    {
        $this->assign(array('title'=>'用户管理','navname'=>'用户管理'));
        $this->display();
    }
}