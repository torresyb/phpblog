<?php
namespace Admin\Controller;

use Think\Controller;

class PositionController extends CommonController
{
    public function index() {
        $data= array();
        
        // 根据url获取信息
        $page = I('p',1,'int');
        $pagesize = I('pagesize',10,'int');
        
        $positions = D('Position')->getPositions($page,$pagesize);
        $positionscount = D('Position')->getPositionsCount();
        
        // 实例 分页
        $tpage = new \Think\Page($positionscount,$pagesize);
        $pagination = $tpage->show();
        
        $this->assign("title",'菜單管理');
        $this->assign('navname','推荐位管理');
        $this->assign('positions',$positions);
        $this->assign('pagination',$pagination);
        $this->display();
    }
    
    /**
     * 添加推荐位 
     */
    public function add() {
        $this->assign('title','添加推荐位');
        $this->assign('navname','添加推荐位');
        
        if(IS_POST){
            parse_str(I('data','','strip_tags,trim'));  
            $data['name'] = $name;
            $data['status'] = $status;
            $data['description'] = $description;
            $data['id'] = $id;
            if(!isset($data['name']) || empty($data['name'])){
                show(0, '推荐位名不能為空');
            }
            if(empty($data['id'])){
                $data['create_time'] = time();
                $result = D('Position')->insert($data);
                $result?show(1, '添加推荐位成功！'):show(0, '添加推荐位失敗');
            }else {
                $data['update_time'] = time();
                $result = D('Position')->edit($data['id'],$data);
                $result?show(1, '编辑推荐位成功！'):show(0, '编辑推荐位失敗');
            }
        }
        
        if(is_numeric($_GET[id])){
            $position = D('Position')->getPosition($_GET[id]);
            if($position){
                $this->assign('position',$position);
                $this->assign('title','编辑推荐位');
                $this->assign('navname','编辑推荐位');
            }else{
                $this->redirect('/admin/position/index');
            }
        }
        
        $this->display();
    }
    
    /**
     * 删除推荐位
     * @param number $id
     * @return number
     */
    public function deleted()
    {
        $id = I('id','','strip_tags,trim');
        if(is_numeric($id)){
            $rst = D('Position')->deletedPosition($id);
            $rst?show(1, '删除推荐位成功！'):show(0, '删除推荐位失敗');
        }
        show(0, '访问数据有误');
    }
}