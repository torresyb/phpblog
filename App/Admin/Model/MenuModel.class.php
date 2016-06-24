<?php
namespace Admin\Model;

use Think\Model;

class MenuModel extends Model
{
    private $_db = null;
    
    public function __construct()
    {
       $this->_db = M('menu');
    }
    
    /**
     * 根据ID获取菜单信息
     * @param number $id
     * @return object
     */
    public function getMenu($id)
    {
        if(is_numeric($id)){
            return $this->_db->find($id);
        }
        
        return array();
    }
    
    /**
     * 添加菜单
     * @param array $data
     * @return number
     */
    public function insert($data=array())
    {
        if(isset($data) && is_array($data)){
           return $this->_db->add($data);
        }
        
        return 0;
    }
    
    /**
     * 编辑菜单
     * @param number $id
     * @param array $data
     * @return boolean|number
     */
    public function edit($id,$data)
    {
        if(is_numeric($id) && is_array($data)){
            $rst =  $this->_db->where(array('menu_id'=>$id))->save($data);
            return $rst;
        }
    
        return 0;
    }
    
    /**
     * 删除菜单
     * @param number $id
     * @return boolean|number
     */
    public function deletedMenu($id)
    {
        if(is_numeric($id)){
            $rst = $this->_db->where('menu_id='.$id)->save(array('status'=>-1));
            return $rst;
        }
        
        return 0;
    }
    
    /**
     * @param array $data
     * @param string $page
     * @param number $pagesize
     * @return 获取菜单列表
     */
    public function getMenus($data, $page, $pagesize=10)
    {
        $data['status'] = array('neq',-1);
        $offset = ($page-1)*$pagesize;
        $rst = $this->_db->where($data)->order('listorder desc, menu_id desc')->limit($offset,$pagesize)->select();
        return $rst;
    }
    
    /**
     * @param array $data
     * @return 获取菜单总数
     */
    public function getMenusCount($data=array())
    {
        $data['status'] = array('neq',-1);
        $rst = $this->_db->where($data)->count();
        return $rst;
    }
    
    /**
     * 菜单排序
     * @param number $id
     * @param number $value
     * @return boolean|number
     */
    public function updateListOrder($id,$value)
    {
        if(is_numeric($id)){
            $rst = $this->_db->where('menu_id='.$id)->save(array('listorder'=>(int)$value));
            return $rst;
        }
        
        return false;
    }
    
    /**
     * 后台菜单
     */
    public function getAdminMenus()
    {
        $data = array(
            'status'=> array('neq',-1),
            'type'=> 1
        );
        
        return $this->_db->where($data)->order('listorder asc,menu_id desc')->select();
    }
    
    /**
     * 前端菜单
     */
    public function getBarMenus()
    {
        $data = array(
            'status'=> 1,
            'type'=> 0
        );
    
        return $this->_db->where($data)->order('listorder asc,menu_id desc')->select();
    }
}