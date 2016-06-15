<?php
namespace Home\Model;

use Think\Model;

class FormModel extends Model
{
    protected $_validate = array(
      array('title','require','标题不能为空'),  
    );
    
    protected $_auto = array(
        array('createtime','time',3,'function'),
    );
}

