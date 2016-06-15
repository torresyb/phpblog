<?php
namespace Admin\Model;

use Think\Model;


/**
 * @author user
 *  用户 模型
 */
class AdminModel extends Model
{
    protected  $db;
    
    public function __construct()
    {
        $this->db = M('admin');
    }
    
    /**
     * @param str $username 用户名 查找
     */
    public function getAdminByUsername($username)
    {
       $rst = $this->db->where('username="'.$username.'"')->find();
       return $rst;
    }
    
}