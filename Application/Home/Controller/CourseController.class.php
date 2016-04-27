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
    public function edit($id){
        $category=M("category");
        $catedata=$category->select();
        if ($catedata) {
            $this->assign( "catedata", $catedata);      
        }
        $Course=M("course");
        $coursedata=$Course->where("id=".$id)->select();
        if($coursedata){
            session("cid",$id);
            $this->assign( "coursedata", $coursedata);
            $this->display('edit');
        }
    }

    public function update(){
        $Course=M("course");
        $id=session("cid");
        $result=$Course->where("id=".$id)->save($_POST);
        if ($result) {
            session("cid","");
            $this->success('课程更新成功！');
        } else {
            $this->error('课程更新失败！');
        }
    }

    public function delete(){
        $course=M("course");
        $id=$_POST['id'];
        $result=$course->delete($id);
        if($result){
            $this->success('文章删除成功！');
        }
        else{
            $this->error('文章删除失败！');            
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
        $list = $course->limit($Page->firstRow.','.$Page->listRows)->select();
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


public function courselist($cateid)
{
    $category=M("category");
    $catedata=$category->select();
    if ($catedata) {
        session("catedata",$catedata);
        $this->assign( "catedata", $catedata);
    }

    $course=M("course");
    if ($course) {
        if($cateid==1){
           $coursedata=$course->select();
       }
       else{
       // $condition['cate_id'] = $cateid;
                    $cid=$category->where('pid='.$cateid)->select();
            $arr1=array();
            array_push($arr1, $cateid);
            $count1=count($cid);
            for ($i=0; $i <$count1 ; $i++) { 
                array_push($arr1, $cid[$i]['id']);
            }
            $map["cate_id"]=array("in",$arr1);
        $coursedata=$course->where($map)->select();
    }
    $count=count($coursedata);
    if($count==0){
        $error["msg"]="暂无记录！";
        $this->assign('error', $error);
    }
    if($count>7){
               $Page       = new \Think\Page($count,7);// 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        //$list = $course->page($_GET['p'].',7')->select();
        $list = $course->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
             $this->assign('page',$show);// 赋值分页输出
         }
         else{
             $this->assign("coursedata", $coursedata);
         }
         $this->display('courselist');
     }
 }

 public function searchCourse($keywords){
    $this->assign( "catedata",  session("catedata"));
    $course=M("course");
    $map['title'] = array('like','%'.$keywords.'%');
    $map['content'] = array('like','%'.$keywords.'%');
    $map['_logic'] = 'or';
    $coursedata=$course->where($map)->select();
    $count=count($coursedata);
    if($count==0){
        $error["msg"]="暂无记录！";
        $this->assign('error', $error);
    }
    else if($count>7){
            // 分页显示
               $Page       = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出   
        $list = $course->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
    }
    else{
     $this->assign("coursedata", $coursedata);
 }
 $this->display("courseResult");
}

} 