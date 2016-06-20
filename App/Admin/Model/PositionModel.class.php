<?php
namespace Admin\Model;

use Think\Model;

class PositionModel extends Model
{
    private $_db = null;
    
    public function __construct()
    {
       $this->_db = M('Position');
    }
    
    
    /**
     * 添加推荐位
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
            $rst =  $this->_db->where(array('id'=>$id))->save($data);
            return $rst;
        }
    
        return 0;
    }
    
    /**
     * 删除推荐位
     * @param number $id
     * @return boolean|number
     */
    public function deletedPosition($id)
    {
        if(is_numeric($id)){
            $rst = $this->_db->where('id='.$id)->save(array('status'=>-1));
            return $rst;
        }
        
        return 0;
    }
    
    
    /**
     * @param array $data
     * @param string $page
     * @param number $pagesize
     * @return 获取推荐位列表
     */
    public function getPositions($page=1, $pagesize=10)
    {
        $data['status'] = array('neq',-1);
        $offset = ($page-1)*$pagesize;
        $rst = $this->_db->where($data)->limit($offset,$pagesize)->select();
        return $rst;
    }
    
    /**
     * @param array $data
     * @param string $page
     * @param number $pagesize
     * @return 获取所有推荐位
     */
    public function getAllPositions()
    {
        $data['status'] = array('eq',1);
        $rst = $this->_db->where($data)->select();
        return $rst;
    }
    
    
    /**
     * 根据ID获取菜单信息
     * @param number $id
     * @return object
     */
    public function getPosition($id)
    {
        if(is_numeric($id)){
            return $this->_db->find($id);
        }
    
        return array();
    }
    
    /**
     * @param array $data
     * @return 获取菜单总数
     */
    public function getPositionsCount()
    {
        $data['status'] = array('neq',-1);
        $rst = $this->_db->count();
        return $rst;
    }

}