<?php
namespace Admin\Controller;

use Think\Controller;

class ContentController extends CommonController
{
    /**
     * 文章管理首页
     */
    public function index() {
         // 根据url获取信息
        $page = I('p',1,'int');
        $pagesize = I('pagesize',2,'int');
        $catid = I('catid','','int');
        $title = I('title','');
        
        if(!empty($catid)){
            
            $data['catid'] = $catid;
        }
        if(!empty($title)){
            $data['title'] = array('like','%'.$title.'%');
        }
        $rst = D('News')->getContents($data,$page,$pagesize);
        
        $contentcount = D('News')->getContentCount($data);
        $menus = D('Menu')->getBarMenus();
        
        $tpage = new \Think\Page($contentcount,$pagesize);
        $pagination = $tpage->show();
        
        $positions = D("Position")->getAllPositions();
        
        $this->assign(array('title'=>'文章管理','navname'=>'文章管理'));
        $this->assign('news',$rst);
        $this->assign('menus',$menus);
        $this->assign('positions',$positions);
        $this->assign('pagination',$pagination);
        $this->display();
    }
    
    /**
     * 添加文章页 
     */
    public function add() {
        if(IS_POST){
            parse_str(I('data','','trim'));
            empty($title) && show(0,'标题为空');
            empty($small_title) && show(0,'短标题为空');
            empty($thumb) && show(0,'缩约图为空');
            empty($title_font_color) && show(0,'标题颜色为空');
            empty($content) && show(0,'内容为空');
            empty($description) && show(0,'描述为空');
            empty($keywords) && show(0,'关键字为空');
            $data = array(
                'title'=>$title,
                'small_title'=>$small_title,
                'thumb'=>$thumb,
                'content'=>htmlspecialchars($content),
                'title_font_color'=>$title_font_color,
                'copyfrom' =>$copyfrom,
                'catid' => $catid,
                'description' =>$description,
                'keywords' => $keywords
            );
            if(!empty($news_id) && is_numeric($news_id)){
                $rst = D('News')->newsupdate($news_id,$data);
                if($rst){
                    show(1, '更新数据成功');
                }else{
                    show(0, '更新数据失败');
                }
            }else {
                $rst = D('News')->insert($data);
                if($rst){
                    show(1, '插入数据成功');
                }else{
                    show(0, '插入数据失败');
                }
            }
            
        }else{
            $menu = D('Menu');
            $menus = $menu->getBarMenus();
            $id = I('id','','int');
            
            $titleColor = C('TITLE_COLOR');
            $copyfrom = C('COPY_FROM');
            
            $new = NULL;
            $content= NULL;
            $navname = '文章管理';
            if(!empty($id)){
                $new = D('News')->getContent($id);
                $content = D('NewsContent')->getContent($id);
                $navname = '文章编辑';
            }
            
            $this->assign(array(
                'title'=>'文章管理',
                'navname'=>$navname,
                'menus'=>$menus,
                'new'=>$new,
                'content'=>$content,
                'titleColors' => $titleColor,
                'copyfroms' => $copyfrom
            ));
        }
        $this->display();
    }
    
    /**
     * 文章排序
     */
    public function listorder() {
        if(IS_POST){
            $str = I('data','','strip_tags,trim');
            parse_str($str);
        
            $errors= array();
            foreach ($listorder as $id=>$value){
                $rst = D('News')->updateListOrder($id,$value);
                if($rst===false){
                    $errors[] = $id;
                }
            }
        
            count($errors)>0?show(0, '更新排序失敗"'.implode(',', $errors).'"！'):show(1, '更新排序成功!');
        }
    }
    
    /**
     * 文章删除
     */
    public function delete() {
        if(IS_POST){
            $id = I('id','','int');
            $status = I('status',-1,'int');
            if(!empty($id) && is_int($id)){
                $rst = D('News')->contentDelete($id,$status);
                if($rst){
                    $status==-1?show(1, '删除成功'):show(1, '更改状态成功','1');
                }else {
                    $status==-1?show(0, '删除失败'):show(0, '更新状态失败','1');
                }
            }
        }
    }
    
    /**
     * 推荐位
     */
    public function push(){
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $position_id = I('position_id','','int');
        $news_id = I('check_v','','strip_tags,trim');
        
        if(!isset($position_id) || empty($position_id)){
            show(0,'请选择推荐位');
        }
        
        if(!is_array($news_id) || !(count($news_id)>0)){
            show(0, '请选择文章');
        }
        try {
            // 根据news_id 查询文章想过信息
            $news = D('News')->getNewsByNewsIdIn($news_id);
            if(!$news){
                show(0,'没有想过文章');
            }
            foreach ($news as $new){
                // 组装  tb_position_content
                $data = array(
                    'position_id'=> $position_id,
                    'title'      => $new['title'],
                    'thumb'      => $new['thumb'],
                    'news_id'    => $new['news_id'],
                    'status'     => $new['status'],
                    'create_time'=> $new['create_time'],
                    'update_time'=> $new['update_time']
                );
                $position = D('Positioncontent')->insert($data);
            }
        } catch (Exception $e) {
            show(0, $e->getMessage());
        }
        show(1, '添加推荐位成功',array('jump_url'=>$jumpUrl));
    }
}