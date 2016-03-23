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
            if($status == 0) {
                $this->ajaxReturn(array('info' => "审核未通过，请修改课程标题"));
            } else {
                $data = $model->create();
                if (!$data) {
                    $this->ajaxReturn(array('info' => $model->getError()));
                }else{
                    $data['status'] = 1;
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
     * 删除文章
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
}