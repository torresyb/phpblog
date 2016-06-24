<?php
namespace Home\Controller;

use Think\Controller;

class CatController extends CommonController
{
    public function index($id) {
        if(!is_numeric($id)){
            return $this->error('ID不存在');
        }
        
        $menu = new \Admin\Model\MenuModel();
        $cat = $menu->getMenu($id);
        if(!$cat || $cat['status']!=1){
            return $this->error('栏目不存在或状态有误');
        }
        
        $page = I('p',1,'int');
        $pagesize =1;
        $data = array('status'=>1,'catid'=>$id,'thumb'=>array('neq',''));
        
        $rightPicNews = $this->getRightPics(2);
        $rankNews = $this->getRankContents(3);
        $news = $this->getContents($data, $page, $pagesize);

        $pagenation = $this->getPage($data, $pagesize);
        $this->assign("result",array(
            'rightPicNews'=>$rightPicNews,
            'news'=>$news,
            'rankNews'=>$rankNews,
            'pagenation'=>$pagenation
        ));
        
        $this->display();
    }
}