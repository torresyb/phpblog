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
    
    public function insert($data=array()) 
    {
        if(!is_array($data) || !$data){
            return 0;
        }
        $data['create_time'] = time();
        $data['count'] = 0;
        $data['status'] = '0';
        $data['username'] = getLoginUser();
        
        $newsid = $this->_db->add($data);
        
        if($newsid){
           $rst = D('NewsContent')->insert(array('news_id'=>$newsid,'content'=>$data['content']));
           if($rst){
               show(1, '提交成功');
           }else{
               show(0, '提交失败');
           }
        }else{
            show(0, '提交失败');
        }
    }
}