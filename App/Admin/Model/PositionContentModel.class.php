<?php
namespace Admin\Model;

use Think\Model;

class PositioncontentModel extends Model
{
    private $_db = null;
    
    public function __construct()
    {
        $this->_db = M('position_content');
    }
    
    /**
     * 插入推荐文章内容
     * @param array $data
     * @return number>
     */
    public function insert($data=array()) 
    {
        if(!is_array($data) || !$data){
            return 0;
        }
        return $this->_db->add($data);
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
     * 删除和更改状态
     * @param number $id
     * @param number $status
     * @return boolean
     */
    public function statusDelete($id,$status)
    {
        if(is_numeric($id)){
            $rst = $this->_db->where('id='.$id)->save(array('status'=>$status));
            return $rst;
        }
        return false;
    }
    
    /**
     * 获取推荐位列表文章
     * @return array
     */
    public function getPositionContents($data,$page,$pagesize=2)
    {
        $data['status'] = array('neq',-1);
        $offset = ($page-1)*$pagesize;
        $rst = $this->_db->where($data)->order('listorder desc,id desc')->limit($offset,$pagesize)->select();
        return $rst;
    }
    
    /**
     * 查询指定推荐文章内容
     * @param number $id
     * @return number|array
     */
    public function getPositionContent($id)
    {
        if(isset($id)){
            $data['id'] = $id;
            $rst = $this->_db->where($data)->find();
            return $rst;
        }
        return false;
    }
    
    /**
     * 获取推荐文章总数
     * @return array
     */
    public function getPositionContentsCount($data)
    {
        $data['status'] = array('neq',-1);
        $count = $this->_db->where($data)->count();
        return $count;
    }
    
    /**
     * 推荐位列表排序
     * @param number $id
     * @param number $value
     * @return boolean|number
     */
    public function updateListOrder($id,$value)
    {
        if(is_numeric($id)){
            $rst = $this->_db->where('id='.$id)->save(array('listorder'=>(int)$value));
            return $rst;
        }
        
        return false;
    }
}