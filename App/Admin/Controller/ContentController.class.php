<?php
namespace Admin\Controller;

use Think\Controller;

class ContentController extends Controller{
    /**
     * 文章管理首页
     */
    public function index() {
        $this->assign(array('title'=>'文章管理','navname'=>'文章管理'));
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
                'content'=>$content,
                'title_font_color'=>$title_font_color,
                'copyfrom' =>$copyfrom,
                'catid' => $catid,
                'description' =>$description,
                'keywords' => $keywords
            );
            $rst = D('News')->insert($data);
            if($rst){
                show(1, '插入数据成功');
            }else{
                show(0, '插入数据失败');
            }
        }else{
            $menu = D('Menu');
            $menus = $menu->getBarMenus();
            
            $titleColor = C('TITLE_COLOR');
            $copyfrom = C('COPY_FROM');
            
            $this->assign(array(
                'title'=>'文章管理',
                'navname'=>'文章管理',
                'menus'=>$menus,
                'titleColors' => $titleColor,
                'copyfroms' => $copyfrom
            )); 
        }
        $this->display();
    }
}