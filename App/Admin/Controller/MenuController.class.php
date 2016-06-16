<?php
namespace Admin\Controller;

class MenuController extends CommonController
{
    /**
     * 菜單管理首頁 
     */
    public function index()
    {
        $data= array();
        
        // 根据url获取信息
        $page = I('p',1,'int');
        $pagesize = I('pagesize',3,'int');
        
        // 根据类型收索
        $type = I('type','','int');
        if(isset($type) && in_array($type, array(0,1),TRUE)){
            $data['type']=$type;
            $this->assign('type',$type);
        }
        
        $menus = D('Menu')->getMenus($data,$page,$pagesize);
        $menuscount = D('Menu')->getMenusCount($data);
        
        // 实例 分页
        $tpage = new \Think\Page($menuscount,$pagesize);
        $pagination = $tpage->show();
        
        $this->assign("title",'菜單管理');
        $this->assign('navname','菜單管理');
        $this->assign('menus',$menus);
        $this->assign('pagination',$pagination);
        $this->display();
    }
    
    /**
     * 添加/修改菜單表達 
     */
    public function add()
    {
        
        $this->assign('title','添加菜單');
        $this->assign('navname','添加菜單');
        // 添加页面
        if(IS_POST){
            $str = I('data','','strip_tags,trim');
            parse_str($str);
            
            $data['name'] = $name;
            $data['type'] = $type;
            $data['m'] = $m;
            $data['c'] = $c;
            $data['f'] = $f;
            $data['status'] = $status;
            $data['menu_id'] = $menu_id;
            
            if(!isset($data['name']) || !$data['name']){
                show(0, '菜單名不能為空');    
            }
            
            if(!isset($data['m']) || !$data['m']){
                show(0, '模塊名不能為空');    
            }
            if(!isset($data['c']) || !$data['c']){
                show(0, '控制器名不能為空');
            }
            if(!isset($data['f']) || !$data['f']){
                show(0, '方法名不能為空');
            }
            
            if(!empty($data['menu_id'])){
                $result = D('Menu')->edit($data['menu_id'],$data);
                $result?show(1, '编辑菜單成功！'):show(0, '编辑菜單失敗');
            }else {
                $result = D('Menu')->insert($data);
                $result?show(1, '添加菜單成功！'):show(0, '添加菜單失敗');
            }
        }
        // 编辑页
        $menu_id = $_GET['id'];
        if(is_numeric($menu_id)){
            $menu= D('Menu')->getMenu($menu_id);
            if($menu){
                $this->assign('menu',$menu);
                $this->assign('title','编辑菜單');
                $this->assign('navname','编辑菜單');
            }else{
                $this->redirect('/admin/menu/index');
            }
            
        }
        
        $this->display();
    }
    
    /**
     * 删除菜单
     * @param number $id
     * @return number
     */
    public function deleted($id)
    {
        if(is_numeric($id)){
            $rst = D('Menu')->deletedMenu($id);
            $rst?show(1, '删除菜单成功！'):show(0, '删除菜單失敗');
        }
        show(0, '访问数据有误');
    }
    
    /**
     * 菜单列表排序
     */
    public function orderlist()
    {
        if(IS_POST){
            $str = I('data','','strip_tags,trim');
            parse_str($str);
            
            $errors= array();
            
            foreach ($listorder as $id=>$value){
                $rst = D('Menu')->updateListOrder($id,$value);
                if($rst===false){
                    $errors[] = $id;
                }
            }
            
            count($errors)>0?show(0, '更新排序失敗"'.implode(',', $errors).'"！'):show(1, '更新排序成功!');
        }
    }
}