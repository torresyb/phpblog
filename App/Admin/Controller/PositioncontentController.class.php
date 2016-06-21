<?php
namespace Admin\Controller;

use Think\Controller;

class PositioncontentController extends CommonController
{
    public function index() {
        $data= array();
        
        // 根据url获取信息
        $page = I('p',1,'int');
        $pagesize = I('pagesize',10,'int');
        
        //收索推荐项
        $positions = D('position')->getAllPositions();
        
        // 根据类型收索 
        $positionId = I('positionId',$positions[0]['id'],'int');
        $title = I('title','','strip_tags,trim');
        
        
        if(!empty($positionId) && is_numeric($positionId)){
            $data['position_id']=$positionId;
        }
        $this->assign('positionId',$positionId);
        if(!empty($title)){
            $data['title']=array('like','%'.$title.'%');
        }
        
        // 抓取数据
        $positioncontents = D('Positioncontent')->getPositionContents($data,$page,$pagesize);
        $positionscount = D('Positioncontent')->getPositionContentsCount($data);
        
        // 实例 分页
        $tpage = new \Think\Page($positionscount,$pagesize);
        $pagination = $tpage->show();
        
        $this->assign("title",'推荐位列表管理');
        $this->assign('navname','推荐位列表管理');
        $this->assign('positions',$positions);
        $this->assign('positioncontents',$positioncontents);
        $this->assign('pagination',$pagination);
        $this->display();
    }
    
    /**
     * 添加推荐位 
     */
    public function add() {
        $this->assign('title','添加推荐位列表');
        $this->assign('navname','添加推荐位列表');
        
        $positions = D('position')->getAllPositions();
        $this->assign('positions',$positions);
        if(IS_POST){
            parse_str(I('data','','strip_tags,trim'));  
            $data['title'] = $title;
            $data['position_id'] = $positionId;
            $data['thumb'] = $thumb;
            $data['url'] = $url;
            $data['news_id'] = $news_id;
            $data['id'] = $id;
            $data['status'] = $status;
            if(!isset($data['title']) || empty($data['title'])){
                show(0, '标题不能為空');
            }
            if(!isset($data['position_id']) || empty($data['position_id'])){
                show(0, '请选择推荐位');
            }
            if(!is_numeric($data['news_id']) || empty($data['news_id'])){
                show(0, '请填写文章ID');
            }
            try {
                if(is_numeric($data['id'])){
                    $data['update_time'] = time();
                    $result = D('Positioncontent')->edit($data['id'],$data);
                    $result?show(1, '编辑推荐位成功！'):show(0, '编辑推荐位失敗');
                }else {
                    $data['create_time'] = time();
                    $result = D('Positioncontent')->insert($data);
                    
                    $result?show(1, '添加推荐位成功！'):show(0, '添加推荐位失敗');
                }

            } catch (Exception $e) {
                show(0, $e->getMessage());
            }
        }
        
        if(is_numeric($_GET[id])){
            $positioncontent = D('Positioncontent')->getPositionContent($_GET[id]);
            if($positioncontent){
                $this->assign('positioncontent',$positioncontent);
                $this->assign('title','编辑推荐位');
                $this->assign('navname','编辑推荐位');
            }else{
                $this->redirect('/admin/positioncontent/index');
            }
        }
        
        $this->display();
    }
    
    /**
     * 删除推荐位和状态改变
     * @param number $id
     * @return number
     */
    public function delete() {
        if(IS_POST){
            $id = I('id','','int');
            $status = I('status',-1,'int');
            if(!empty($id) && is_int($id)){
                $rst = D('Positioncontent')->statusDelete($id,$status);
                if($rst){
                    $status==-1?show(1, '删除成功'):show(1, '更改状态成功','1');
                }else {
                    $status==-1?show(0, '删除失败'):show(0, '更新状态失败','1');
                }
            }
        }
    }
    
    /**
     * 推荐位列表排序
     */
    public function listorder()
    {
        if(IS_POST){
            $str = I('data','','strip_tags,trim');
            parse_str($str);
    
            $errors= array();
            // 数据库的操作都要加上try..catch
            try {
                if($listorder){
                    foreach ($listorder as $id=>$value){
                        $rst = D('Positioncontent')->updateListOrder($id,$value);
                        if($rst===false){
                            $errors[] = $id;
                        }
                    }
                    
                    count($errors)>0?show(0, '更新排序失敗"'.implode(',', $errors).'"！'):show(1, '更新排序成功!');
                }
            } catch (Exception $e) {
                show(0, $e->getMessage());
            }
            
            return show(0,'数据有误');
        }
    }
    
}