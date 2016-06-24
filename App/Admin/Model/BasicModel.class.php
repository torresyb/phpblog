<?php
namespace Admin\Model;

class BasicModel
{
    public function save($data=array()) {
        if (!is_array($data)){
            throw_exception('没有提交数据');
        }
        return F('basic_config',$data);
    }
    
    public function show() {
        return F('basic_config');
    }
}