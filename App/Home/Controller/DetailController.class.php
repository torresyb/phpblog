<?php
namespace Home\Controller;

use Think\Controller;

class DetailController extends CommonController
{
    public function index($id) {
        if(!is_numeric($id) || $id<0){
            return $this->error('没有该文章');
        }
        // 右侧栏信息
        $rightPicNews = $this->getRightPics(2);
        $rankNews = $this->getRankContents(3);
        
        //获取文章
        $new = $this->news_db->getContent($id);
        if(!$new || $new['status']!=1){
            return $this->error("ID不存在或文章已关闭");
        }
        // 更新count字段
        $this->news_db->newsUpdateCount($id);
        $new['count'] = $new['count']+1;
        // 获取文章详情
        $content_db = new \Admin\Model\NewsContentModel();
        $content = $content_db->getContent($id);
        if (!$content) {
            return $this->error("文章内容为空");
        }
        
        $this->assign('result',array(
            "content"     => $content,
            "new"         => $new,
            'rightPicNews'=> $rightPicNews,
            'rankNews'    => $rankNews
        ));
        $this->display();
    }
}