<?php
namespace Admin\Controller;

class IndexController extends CommonController {
    
    public function index(){
        $this->assign('title','后台首页');
        //获取最大阅读量的文章
        $new = D("News")->maxcountnew();
        
        //获取文章总数
        $newscount = D("News")->getContentCount();
        
        //获取推荐位总数
        $positioncount = D("Position")->getPositionsCount();
        
        //获取今天的登陆用户数
        $logincount = D("Admin")->getLoginCount();
        
        $this->assign('new',$new);
        $this->assign('newscount',$newscount);
        $this->assign('positioncount',$positioncount);
        $this->assign('logincount',$logincount);
        $this->display();
    }
}