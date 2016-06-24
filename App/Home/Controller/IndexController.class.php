<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController {
    public function index(){
        layout('layoutindex');
        try {
            $topPicNew = $this->getTopPic(1);
            $rightPicNews = $this->getRightPics(2);
            
            //获取文章
            $page = I('p',1,'int');
            $pagesize=2;
            $data = array('status'=>1,'thumb'=>array('neq',''));
            // 获取所有文字
            $news = $this->getContents($data, $page,$pagesize);
            
            // 获取分页
            $pagenation = $this->getPage($data,$pagesize);
            
            // 获取right 文章排行
            $rankNews= $this->getRankContents(3);
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        $this->assign("result",array(
            'topPicNew'=>$topPicNew[0],
            'rightPicNews'=>$rightPicNews,
            'news'=>$news,
            'rankNews'=>$rankNews,
            'pagenation'=>$pagenation
        ));
        $this->display();
    }
}