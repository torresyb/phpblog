<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController {
    public function index($type=''){
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
            return $this->error($e->getMessage());
        }
        $this->assign("result",array(
            'topPicNew'=>$topPicNew[0],
            'rightPicNews'=>$rightPicNews,
            'news'=>$news,
            'rankNews'=>$rankNews,
            'pagenation'=>$pagenation
        ));
        
        if($type=='buildHtml'){
            $this->buildHtml('index',HTTP_PATH,'Index/index');
        }else {
            $this->display();
        }
        
    }
    
    /**
     * 后台更新缓存
     */
    public function build_html()
    {
        $this->index('buildHtml');
        show(1, "缓存更新成功");
    }
    
    /**
     * crontab 定时更新
     */
    public function crontab_build_html()
    {
        if(APP_CRONTAB !=1){
            die('the file must exec crontab');
        }
        $this->index('buildHtml');
    }
    
    public function getCount() {
        if(!$_POST){
            show(0, '参数为空');
        }
        $newsIds = array_unique($_POST);
        try {
            $data = array();
            $news = $this->news_db->getNewsByNewsIdIn($newsIds);
            if (!$news){
                show(0, '没有相关数据');
            }
            foreach ($news as $key=>$val){
                $data[$val['news_id']] = $val['count'];
            }
            show(1,"success",$data);
        } catch (Exception $e) {
            show(0, $e->getMessage());
        } 
    }
}