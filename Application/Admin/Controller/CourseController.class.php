<?php
namespace Admin\Controller;
use Think\Controller;
class CourseController extends CommonController {
    /**
     * 课程列表
     * @return [type] [description]
     */
    public function index($key="")
    {
        if(trim($_REQUEST['key'])!='')
        {
            $map['course.title'] = array('like','%'.trim($_REQUEST['key']).'%');
        }
        $this->assign("default_map",$map);
        parent::index(true);
       
    }
    /**
     * 添加文章
     */
    public function add()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $this->assign("category",getSortedCategory(M('category')->select()));
            $this->assign("cate",getSortedCategory(M('course')->select()));
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("Course");
            $data = $model->create();
            if (!$data) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->ajaxReturn(array('info' => $model->getError()));
                exit();
            } else {
                $data['time'] = time();
                $data['user_id'] = session('admin_id');
                if ($model->add($data)) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('course/index')
                    );
                    $this->ajaxReturn($message);
                } else {
                    $this->ajaxReturn(array('info' => "添加失败"));
                }
            }
        }
    }
    /**
     * 更新文章信息
     * @param  [type] $id [文章ID]
     * @return [type]     [description]
     */
    public function update($id)
    {
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('course')->where("id= %d",$id)->find();
            $this->assign("category",getSortedCategory(M('category')->select()));
            $this->assign('course',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("course");
            if (!$model->create()) {
                $this->ajaxReturn(array('info' => $model->getError()));
            }else{
                if ($model->save()) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('course/index')
                    );
                    $this->ajaxReturn($message);
                } else {
                    $this->ajaxReturn(array('info' => "更新失败"));
                }
            }
        }
    }
    
    /**
     * 审批课程
     */
    
    public function approve($id)
    {
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('course')->where("id= %d",$id)->find();
            $this->assign("category",getSortedCategory(M('category')->select()));
            $this->assign('course',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("course");
            $status = I('post.status');
            if($status == 5) {
                $this->ajaxReturn(array('info' => "审核未通过，请修改课程标题"));
            } else {
                $data = $model->create();
                if (!$data) {
                    $this->ajaxReturn(array('info' => $model->getError()));
                }else{
                    if ($model->save()) {
                        $message = array(
                            'info' => 'ok',
                            'callback' => U('course/index')
                        );
                        $this->ajaxReturn($message);
                    } else {
                        $this->ajaxReturn(array('info' => "审核失败，请联系管理员"));
                    }
                }
            }
        }
    }
    /**
     * 删除课程
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $model = M('course');
        $result = $model->where("id= %d",$id)->delete();
        if($result){
            $message = array(
                'info' => 'ok',
                'callback' => U('course/index')
            );
            $this->ajaxReturn($message);
        }else{
            $this->ajaxReturn(array('info' => "删除失败"));
        }
    }

    public function uploader(){
        //关闭缓存
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    
        $uploader = new \Extend\FileUpload();
    
        //用于断点续传，验证指定分块是否已经存在，避免重复上传
        if(isset($_POST['status'])){
            if($_POST['status'] == 'chunkCheck'){
                $target = './uploads/'.$_POST['name'].'/'.$_POST['chunkIndex'];
                if(file_exists($target) && filesize($target) == $_POST['size']){
                    die('{"ifExist":1}');
                }
                die('{"ifExist":0}');
    
            }elseif($_POST['status'] == 'md5Check'){
    
                //todo 模拟持久层查询
                $dataArr = array(
                    'b0201e4d41b2eeefc7d3d355a44c6f5a' => 'kazaff2.jpg'
                );
    
                if(isset($dataArr[$_POST['md5']])){
                    die('{"ifExist":1, "path":"'.$dataArr[$_POST['md5']].'"}');
                }
                die('{"ifExist":0}');
            }elseif($_POST['status'] == 'chunksMerge'){
    
                if($path = $uploader->chunksMerge($_POST['name'], $_POST['chunks'], $_POST['ext'])){
                    //todo 把md5签名存入持久层，供未来的秒传验证
                    die('{"status":1, "path": "'.$path.'"}');
                }
                die('{"status":0');
            }
        }
    
        if(($path = $uploader->upload('file', $_POST)) !== false){
            die('{"status":1, "path": "'.$path.'"}');
        }
        die('{"status":0}');
    }
}