<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;Charset=utf-8");

class CourseController extends Controller
{  
    public function add(){
        $Course = M('Course');
        $data = $Course->create();
        if ($data) {
            $result = $Course->add($data);
            if ($result) {
                $this->success('提交成功！');
            } else {
                $this->error('提交失败！');
            }
        } else {
            $this->error($User->getError());
        }
    }
        
    public function addPage(){
        $category=M("category");
        $catedata=$category->select();
        if ($catedata) {
            $this->assign( "catedata", $catedata);
           //dump($catedata);
           $this->display('add'); 
        }
    }
    
    public function show(){
        $this->display('show');
    }
    
} 