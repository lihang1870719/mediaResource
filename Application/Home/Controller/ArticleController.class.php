<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;Charset=utf-8");

class ArticleController extends Controller
{   
	public function add(){
		$Article = M('post');
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

	public function edit($id){
		$category=M("category");
		$catedata=$category->select();
		if ($catedata) {
			$this->assign( "catedata", $catedata);		
		}
		$Article=M("post");
		$Articledata=$Article->where("id=".$id)->select();
		if($Articledata){
			session("aid",$id);
			$this->assign( "articledata", $Articledata);
			$this->display('edit'); 
		}
	}

	public function delete(){
		$Article=M("post");
		$id=$_POST['id'];
		$result=$Article->delete($id);
		if($result){
			$this->success('文章删除成功！');
		}
		else{
			$this->error('文章删除失败！');			
		}
	}

	public function update(){
		$Article=M("post");
		$id=session("aid");
		$result=$Article->where("id=".$id)->save($_POST);
		if ($result) {
			session("articleid","");
			$this->success('文章更新成功！');
		} else {
			$this->error('文章更新失败！');
		}
	}


	public function show(){
		$article=M("post");
		$articledata=$article->select();
		if ($article) {
			$count=count($articledata);
			if($count==0){
				$error["msg"]="暂无记录！";
				$this->assign('error', $error);
			}
			else if($count>10){
            // 分页显示
               $Page       = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $list = $article->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
    }
    else{
    	$this->assign("articledata", $articledata);
    }
    $this->display('show');
}
}

public function articlelist($cateid)
{
	$category=M("category");
	$catedata=$category->select();
	if ($catedata) {
		session("catedata",$catedata);
		$this->assign( "catedata", $catedata);
	}

	$article=M("post");
	if ($article) {
		if($cateid==1){
			$articledata=$article->select();
		}
		else{
			//$condition['cate_id'] = $cateid;
			$cid=$category->where('pid='.$cateid)->select();
			$arr1=array();
			array_push($arr1, $cateid);
			$count1=count($cid);
			for ($i=0; $i <$count1 ; $i++) { 
				array_push($arr1, $cid[$i]['id']);
			}
			$map["cate_id"]=array("in",$arr1);
			$articledata=$article->where($map)->select();
		}
		$count=count($articledata);
		if($count==0){
			$error["msg"]="暂无记录！";
			$this->assign('error', $error);
		}
		else if($count>10){
            // 分页显示
               $Page       = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $list = $article->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
    }
    else{
    	$this->assign("articledata", $articledata);
    }
    $this->display('articlelist');
}
}

public function searcharticle($keywords){
	$this->assign( "catedata",  session("catedata"));
	$article=M("post");
	$map['title'] = array('like','%'.$keywords.'%');
	$map['_logic'] = 'or';
	$articledata=$article->where($map)->select();
	$count=count($articledata);
	if($count==0){
		$error["msg"]="暂无记录！";
		$this->assign('error', $error);
	}
	else if($count>7){
            // 分页显示
               $Page       = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出   
        $list = $article->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
    }
    else{
    	$this->assign("articledata", $articledata);
    }
    $this->display("articleResult");
}

public function detail($id){
	$Article=M("post");
	$User=M("user");
	$Cate=M("category");
	$Articledata=$Article->where('id='.$id)->select();
	if ($Article) {
		$user_id=$Articledata["0"]["user_id"];
		$cate_id=$Articledata["0"]["cate_id"];
		$nickname=$User->where("id=".$user_id)->getField("nickname");
		$catetitle=$Cate->where("id=".$cate_id)->getField("title");
		$Articledata["0"]["nickname"]=$nickname;
		$Articledata["0"]["catetitle"]=$catetitle;
		$this->assign("articledata", $Articledata);
		$this->display('detail');
	}
}

} 