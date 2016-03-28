<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;Charset=utf-8");

class ArticleController extends Controller
{   
    public function edit($id=0){
        $Article   =   M('Article');
        $this->assign('vo',$Article->find($id));
        $this->display();
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