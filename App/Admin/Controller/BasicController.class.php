<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Model;

class BasicController extends CommonController
{
    public function index()
    {
        $rst = D('Basic')->show();
        $this->assign('basic',$rst);
        $this->assign('title','基本管理');
        $this->assign('navname','基本管理');
        $this->display();
    }
    
    public function add() {
        if(IS_POST){
            $data = array();
            $str = I('data','','strip_tags,trim');
            parse_str($str);
            $data['title'] = $title;
            $data['keyword'] = $keyword;
            $data['description'] = $description;
            if (!$data['title']){
                show(0, '请填写标题');
            }
            if (!$data['keyword']){
                show(0, '请填写关键字');
            }
            if (!$data['description']){
                show(0, '请填写描述');
            }
            try {
                $basic = new \Admin\Model\BasicModel();
                $basic->save($data);
                show(1, '添加基本配置成功');
            } catch (Exception $e) {
                show(0, $e->getMessage());
            }
        }else{
            show(0, '没有提交的数据');
        }
    }
}