<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;Charset=utf-8");

class ArticleController extends Controller
{   
    public function add(){
        $Article = M('Article');
        $data = $Article->create();
        if ($data) {
            $result = $Article->add($data);
            if ($result) {
                $this->success('文章提交成功！');
            } else {
                $this->error('文章提交失败！');
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
        $Article=M("Article");
        $Articledata=$Article->limit(10)->select();
        if ($Article) {
            $this->assign( "articledata", $Articledata);
            $this->assign("hotcoursedata", session("hotcoursedata"));
            $this->display('show');
        }
    }
} 