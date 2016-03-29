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
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("Mail");
            $data = $model->create();
            if (!$data) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->ajaxReturn(array('info' => $model->getError()));
                exit();
            } else {
                if ($model->add()) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('mail/index')
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
            $model = M('mail')->where("id= %d",$id)->find();
            $this->assign('mail',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D('mail');
            if (!$model->create()) {
                $this->ajaxReturn(array('info' => $model->getError()));
            }else{
                if ($model->save()) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('mail/index')
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
        $model = M('mail');
        $result = $model->where("id= %d",$id)->delete();
        if($result){
            $message = array(
                'info' => 'ok',
                'callback' => U('mail/index')
            );
            $this->ajaxReturn($message);
        }else{
            $this->ajaxReturn(array('info' => "删除失败"));
        }
    }
}