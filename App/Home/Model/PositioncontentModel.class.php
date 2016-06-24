<?php
namespace Home\Model;

use Think\Model;

class PositioncontentModel extends Model
{
    private $_db = null;
    
    public function __construct()
    {
        $this->_db = M('position_content');
    }
    
    /* 
     * 推荐位大图
     */
    public function select($data=array(),$num)
    {   
        if(!$data || !is_array($data)){
            throw_exception('数据不完整');
        }
        $rst = $this->_db->where($data)->order('listorder desc,id desc')->limit($num)->select();
        return $rst;
    }
}