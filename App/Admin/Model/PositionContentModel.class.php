<?php
namespace Admin\Model;

use Think\Model;

class PositionContentModel extends Model
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
     * 查询指定推荐文章内容
     * @param number $id
     * @return number|array
     */
    public function getContent($id)
    {
        if(isset($id)){
            $data['news_id'] = $id;
            $rst = $this->_db->where($data)->find();
            return $rst;
        }
        return false;
    }
}