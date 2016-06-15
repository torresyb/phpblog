<?php
namespace Admin\Controller;

class IndexController extends CommonController {
    
    public function index(){
        $this->assign('title','后台首页');
//         print_r(session('adminInfo'));exit();
        $this->display();
    }
}