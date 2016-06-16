<?php
namespace Admin\Model;

use Think\Model;

class NewsModel extends Model
{
    private $_db = null;
    
    public function __construct()
    {
        $this->_db = M('news');
    }
    
    /**
     * 添加文章
     * @param array $data
     * @return number
     */
    public function insert($data=array()) 
    {
        if(!is_array($data) || !$data){
            return 0;
        }
        $data['create_time'] = time();
        $data['count'] = 0;
        $data['status'] = '1';
        $data['username'] = getLoginUserName();
        
        $newsid = $this->_db->add($data);
        
        if($newsid){
           $content = htmlspecialchars($data['content']);
           $rst = D('NewsContent')->insert(array('news_id'=>$newsid,'content'=>$content));
           return $rst;
        }else{
            return 0;
        }
    }
    
    /**
     * 更新文章
     * @return number
     */
    public function newsupdate($id,$data=array())
    {
        if(!is_array($data) || !$data || !$id || !is_numeric($id)){
            return 0;
        }
        $data['update_time'] = time();
        $data['count'] = 0;
        $data['status'] = '0';
        $data['username'] = getLoginUserName();
        
        $count = $this->_db->where("news_id=".$id)->save($data);
        if($count){
            $rst = D('NewsContent')->updateContent($id,$data['content']);
            return $rst;
        }else{
            return false;
        }
    }
    
    /**
     * 获取文章
     * @return array 
     */
    public function getContents($data,$page,$pagesize=2) 
    {
        $data['status'] = array('neq',-1);
        $offset = ($page-1)*$pagesize;
        $rst = $this->_db->where($data)->order('listorder desc,news_id desc')->limit($offset,$pagesize)->select();
        return $rst;
    }
    
    /**
     * 查询指定文章
     * @param number $id
     * @return number|array
     */
    public function getContent($id)
    {
        if(isset($id)){
            $data['status'] = array('neq',-1);
            $data['news_id'] = $id;
            $rst = $this->_db->where($data)->find($id);
            return $rst;
        }
        return false;
    }
    
    
    /**
     * 获取文章总数
     * @return array
     */
    public function getContentCount($data)
    {
        $data['status'] = array('neq',-1);
        $count = $this->_db->where($data)->count();
        return $count;
    }
    
    /**
     * 文章列表排序
     * @param number $id
     * @param number $value
     * @return boolean
     */
    public function updateListOrder($id,$value)
    {
        if(is_numeric($id)){
            $rst = $this->_db->where('news_id='.$id)->save(array('listorder'=>(int)$value));
            
            return $rst;
        }
        
        return false;
    }

    
    /**
     * 文章列表删除
     * @param number $id
     * @return boolean
     */
    public function contentDelete($id,$status)
    {
        if(is_numeric($id)){
            $rst = $this->_db->where('news_id='.$id)->save(array('status'=>$status));
            return $rst;
        }
        return false;
    }
}