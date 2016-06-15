<?php
namespace Admin\Controller;

use Think\Controller;

class ImageController extends Controller
{   
    private $uploadObj = null;
    
    public function __construct()
    {
        $this->uploadObj = new \Common\library\UploadImage();
    }
    
    /**
     *  上传图片
     */
    public function ajaxuploadimage()
    {
        $rst = $this->uploadObj->imageUpload();
        if($rst){
            show(1, '上传成功',$rst);
        }else{
            show(0, '上传失败');
        }
    }
    
    /**
     * kindediter 编辑器上传图片 
     */
    public function kindupload()
    {
        $rst = $this->uploadObj->upload();
        if($rst){
            echo json_encode(array('error'=>0,'url'=>$rst));
        }else{
            echo json_encode(array('error'=>1,'message'=>'上传失败'));
        }
    }
}