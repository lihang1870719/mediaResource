<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function indexPage()
    {
        $hotcoursedata = $course->where(array("status"=>"4","type"=>"3"))->limit(7)->select();
        session("hotcoursedata", $hotcoursedata);
        $this->display('index');
    }

    public function indexLoginPage()
    {
        $this->display('indexLogin');
    }

    public function personal()
    {
        $course = M("course");
        $coursedata = $course->where("status=4")->limit(10)->select();
        $hotcoursedata = $course->where(array("status"=>"4","type"=>"3"))->limit(7)->select();
        session("hotcoursedata", $hotcoursedata);
        $Article=M("Article");
        $Articledata=$Article->limit(10)->select();
        if ($Article) {
            $this->assign( "articledata", $Articledata);
        }
        if ($course) {
            $this->assign("hotcoursedata", $hotcoursedata);
            $this->assign("coursedata", $coursedata);
            $this->display('personal');
        }
    }

    public function exitLogin()
    {
        sleep(3);
        session(null);
        $this->display('index');
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
            $condition['cate_id'] = $cateid;
            $condition['pid'] =$cateid;
            $condition['_logic'] = 'OR';
            $coursedata=$course->where($condition)->select();
        }
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
    $this->assign("coursedata", $coursedata);
    $this->display("courseResult");
}

}