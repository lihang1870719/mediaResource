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
           $this->display('add'); 
        }
    }
    
    public function show(){
        $course=M("course");
        $coursedata=$course->select();
        $count=count($coursedata);
      if($count==0){
            $error["msg"]="暂无记录！";
            $this->assign('error', $error);
        }
        else if($count>10){
            // 分页显示
        $Page       = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $list = $course->page($_GET['p'].',7')->select();
        $this->assign('list',$list);// 赋值数据集
    }
    else{
       $this->assign("coursedata", $coursedata);
   }
        if ($course) {
            $this->assign("hotcoursedata", session("hotcoursedata"));
            $this->display('show');
        }
    }
    
} 