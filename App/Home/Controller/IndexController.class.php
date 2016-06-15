<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    
    // 加入数据
    public function insert(){
        $m = D('Form');
        
        if($m->create()){
            $rst = $m->add();
            if($rst){
                $this->success('数据添加成功');
            }else{
                $this->error('数据添加失败');
            }
        }else{
            $this->error($m->getError());
        }
    }
    
    // 读取数据
    public function read($id = 0)
    {
        $m = M('Form');
        
        $rst = $m->find($id);
        
        if($rst){
            $this->assign('result',$rst);
        }else {
            $this->error('读取数据失败');   
        }
        
        $this->display('index');
    }
    
    // 更新数据
    public function update()
    {
        $m = D('Form');
        if($m->create()){
            $rst = $m->save();
            if($rst){
                $this->success('更新数据成功');
            }else{
                $this->error('更新数据失败');
            }
        }else {
            $this->error($m->getError());
        }
    }
}