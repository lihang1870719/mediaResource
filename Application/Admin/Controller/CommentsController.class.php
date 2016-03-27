<?php
namespace Admin\Controller;
use Admin\Controller;

class CommentsController extends CommonController
{
    /**
     * 评论留言列表
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
     * 添加评论
     */
    public function add()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $this->assign("course",getSortedCategory(M('course')->select()));
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("Comments");
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
                        'callback' => U('comments/index')
                    );
                    $this->ajaxReturn($message);
                } else {
                    $this->ajaxReturn(array('info' => "添加失败"));
                }
            }
        }
    }
    /**
     * 更新
     * @param  [type] $id [文章ID]
     * @return [type]     [description]
     */
    public function update($id)
    {
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('comments')->where("id= %d",$id)->find();
            $this->assign("course",getSortedCategory(M('course')->select()));
            $this->assign('comments',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("Comments");
            if (!$model->create()) {
                $this->ajaxReturn(array('info' => $model->getError()));
            }else{
                if ($model->save()) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('comments/index')
                    );
                    $this->ajaxReturn($message);
                } else {
                    $this->ajaxReturn(array('info' => "更新失败"));
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
        $model = M('comments');
        $result = $model->where("id= %d",$id)->delete();
        if($result){
            $message = array(
                'info' => 'ok',
                'callback' => U('comments/index')
            );
            $this->ajaxReturn($message);
        }else{
            $this->ajaxReturn(array('info' => "删除失败"));
        }
    }
    
}
