<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller
{
    protected $news_db = NULL;
    
    public function __construct()
    {
        parent::__construct();
        $this->news_db = new \Admin\Model\NewsModel();
    }
    /**
     * 获取文章排行
     * @param number $num
     * @return array
     */
    public function getRankContents($num) 
    {
        $rst= $this->news_db->getRankContents($num);
        return $rst;
    }
    
    public function getRightPics($num)
    {
        $rightPicNews = D('Positioncontent')->select(array('position_id'=>2,'status'=>1),$num);
        return $rightPicNews;
    }
    
    public function getTopPic($num)
    {
        $topPic = D("Positioncontent")->select(array('position_id'=>1,'status'=>1),$num);
        return $topPic;
    }
    /**
     * 获取文章
     * @param array $data
     * @param int $page
     * @param int $pagesize
     * @return array
     */
    public function getContents($data,$page,$pagesize)
    {
        $rst = $this->news_db->getContents($data, $page,$pagesize);
        return $rst;
    }
    
    /**
     * 获取分页
     * @param array $data
     * @param int $pagesize
     * @return string
     */
    public function getPage($data,$pagesize) 
    {
        $pagecount = $this->news_db->getContentCount($data);
        $tpage = new \Think\Page($pagecount,$pagesize);
        $pagenation = $tpage->show();
        return $pagenation;
    }
    
    public function error($message='') {
        layout('layoutindex');
        $message = $message?$message:'系统发生错误';
        $this->assign('message',$message);
        $this->display('/error');
    }
}