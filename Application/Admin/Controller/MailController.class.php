<?php
namespace Admin\Controller;
use Think\Controller;
class MailController extends CommonController {
    public function index($key="")
    {
        if(trim($_REQUEST['key'])!='')
        {
            $map['mail_server'] = array('like','%'.trim($_REQUEST['key']).'%');
        }
        $map['is_effect'] = array('eq',1);
        $map['type'] =array('eq',0);
        $this->assign("default_map",$map);
        parent::index();    
    }
    
    public function add()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $this->assign("cate", M('course')->where('image_status = 0 AND image != ""')->select());
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("Course");
            $post_sort = I('post.image_sort');
            $result = M('course')->where('image_sort = %d AND image_sort != 0', $post_sort)->select();
            if($result) {
                $this->ajaxReturn(array('info' => '此轮播顺序已有，请选择其他顺序'));
                exit();
            }
            $data = $model->create();
            if (!$data) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->ajaxReturn(array('info' => $model->getError()));
                exit();
            } else {
                if ($model->save()) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('mobile/index')
                    );
                    $this->ajaxReturn($message);
                } else {
                    $this->ajaxReturn(array('info' => "添加失败"));
                }
            }
        }
    }
    
    public function update($id)
    {
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('course')->where("id= %d",$id)->find();
            $this->assign('course',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D('course');
            $post_sort = I('post.image_sort');
            $result = M('course')->where('image_sort = %d AND image_sort != 0', $post_sort)->select();
            if($result) {
                $this->ajaxReturn(array('info' => '此轮播顺序已有，请选择其他顺序'));
                exit();
            }
            if (!$model->create()) {
                $this->ajaxReturn(array('info' => $model->getError()));
            }else{
                if ($model->save()) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('mobile/index')
                    );
                    $this->ajaxReturn($message);
                } else {
                    $this->ajaxReturn(array('info' => "更新失败"));
                }
            }
        }
    }
    public function delete($id)
    {
        $model = M('course');
        $data = $model->create();
        $data['id'] = $id;
        $data['image_status'] = 0;
        $data['image_sort'] = 0;
        if ($model->save($data)) {
            $message = array(
                'info' => 'ok',
                'callback' => U('mobile/index')
            );
            $this->ajaxReturn($message);
        } else {
            $this->ajaxReturn(array('info' => "删除失败"));
        }
    }
}