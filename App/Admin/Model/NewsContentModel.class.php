<?php
namespace Admin\Model;

use Think\Model;

class NewsContentModel extends Model
{
    private $_db = null;
    
    public function __construct()
    {
        $this->_db = M('news_content');
    }
    
    /**
     * 插入文章内容
     * @param array $data
     * @return number>
     */
    public function insert($data=array()) 
    {
        if(!is_array($data) || !$data){
            return 0;
        }
        $data['create_time'] = time();
        if(isset($data['content']) && $data['content']){
            $data['content'] = htmlspecialchars($data['content']);
        }
        return $this->_db->add($data);
    }
    
    /**
     * 查询指定文章内容
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
    
    /**
     * 更新文章副表 文章内容
     * @param number $id
     * @param string $content
     * @return boolean
     */
    public function updateContent($id,$content)
    {
        $rst = $this->_db->where("news_id=".$id)->save(array('content'=>$content,'update_time'=>time()));
        return $rst;
    }
}