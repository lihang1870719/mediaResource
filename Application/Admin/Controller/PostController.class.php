<?php
namespace Admin\Controller;
use Admin\Controller;

class PostController extends CommonController
{
    /**
     * 文章列表
     * @return [type] [description]
     */
    public function index($key="")
    {
        if(trim($_REQUEST['key'])!='')
        {
            $map['post.title'] = array('like','%'.trim($_REQUEST['key']).'%');
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
            $this->assign("category",getSortedCategory(M('category')->where('pid = 0')->select()));
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("Post");
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
                        'callback' => U('post/index')
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
            $model = M('post')->where("id= %d",$id)->find();
            $this->assign("category",getSortedCategory(M('category')->select()));
            $this->assign('post',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("Post");
            if (!$model->create()) {
                $this->ajaxReturn(array('info' => $model->getError()));
            }else{
                if ($model->save()) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('post/index')
                    );
                    $this->ajaxReturn($message);
                } else {
                    $this->ajaxReturn(array('info' => "更新失败"));
                }
            }
        }
    }
    
    /**
     * 审核文章信息
     * @param  [type] $id [文章ID]
     * @return [type]     [description]
     */
    public function approve($id)
    {
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('post')->where("id= %d",$id)->find();
            $this->assign("category",getSortedCategory(M('category')->select()));
            $this->assign('post',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("Post");
            if (!$model->create()) {
                $this->ajaxReturn(array('info' => $model->getError()));
            }else{
                if ($model->save()) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('post/index')
                    );
                    $this->ajaxReturn($message);
                } else {
                    $this->ajaxReturn(array('info' => "审核失败"));
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
        $model = M('post');
        $result = $model->where("id= %d",$id)->delete();
        if($result){
            $message = array(
                'info' => 'ok',
                'callback' => U('post/index')
            );
            $this->ajaxReturn($message);
        }else{
            $this->ajaxReturn(array('info' => "删除失败"));
        }
    }
    
}
