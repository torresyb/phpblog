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
    public function getAdminByUsername($username='')
    {
        if(empty($username)){
            throw_exception("用户名不能为空");
        }
        $rst = $this->db->where('username="'.$username.'"')->find();
        return $rst;
    }
    
    /**
     * 获取注册用户
     * @param array $data
     * @param int $page
     * @param int $pagesize
     * @return array
     */
    public function getAdmins($data = array(),$page,$pagesize) 
    {
        $data['status'] = array("neq","-1");
        $offset = ($page-1)*$pagesize;
        $rst = $this->db->where($data)->order("admin_id desc")->limit($offset,$pagesize)->select();
        return $rst;
    }
    
    public function getAdmin($id){
        $rst = $this->db->find($id);
        return $rst;
    }
    
    /**
     * 获取用户数
     * @return number
     */
    public function getAdminsCount()
    {
        $data['status'] = array('neq',-1);
        $rst = $this->db->where($data)->count();
        return $rst;
    }
    
    public function getLoginCount()
    {
        $time = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $data=array(
            'status'=>1,
            'lastlogintime'=>array("gt",$time)  
        );
        $rst = $this->db->where($data)->count();
        return $rst;
    }
    
    /**
     * 添加用户
     * @param bloon 
     */
    public function insert($data=array())
    {
        if(!$data || !is_array($data)){
            throw_exception("数据有误");
        }
        $data['status'] = 1;
        $data['lastlogintime'] = time();
        $data['lastloginip'] = get_client_ip();
        $rst = $this->db->add($data);
        return $rst;
    }
    
    /**
     * @param unknown $id
     * @param unknown $data
     */
    public function update($id,$data) 
    {
        if(!$id || !is_numeric($id)){
            throw_exception("id参数不正确");
        }
        if(!$data || !is_array($data)){
            throw_exception("存储数据格式有误");
        }
        $rst = $this->db->where(array('admin_id'=>$id))->save($data);
        return $rst;
    }
    
    /**
     * 删除和更改状态
     * @param number $id
     * @param number $status
     * @return boolean
     */
    public function statusDelete($id,$status)
    {
        if(is_numeric($id) && is_numeric($status)){
            $rst = $this->db->where(array('admin_id'=>$id))->save(array('status'=>$status));
            return $rst;
        }else {
            throw_exception("参数不正确");
        }
        return false;
    }
}