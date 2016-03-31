<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {
    
    public function index()
    {
        if(trim($_REQUEST['key'])!='')
        {
            $map['admin.username'] =array('like','%'.trim($_REQUEST['key']).'%');
        }
        $this->assign("default_map",$map);
        $ModelView = true;
        parent::index($ModelView);
    }
    
    /**
     * 添加分类
     */
    public function add()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('role')->where('is_effect = 1')->select();
            $this->assign('group',$model);
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("Admin");
            $data = $model->create();
            if(M("Admin")->where("username='".$data['username']."'")->count()>0)
            {
                $this->ajaxReturn(array('info' => "管理员账户已存在"));
                exit();
            }
            if (!$data) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->ajaxReturn(array('info' => $model->getError()));
                exit();
            } else {
                $data['password'] = md5($data['password']);
                $data['login_time'] = date("Y-m-d h:i:s",time());
                if ($model->add($data)) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('admin/index')
                    );
                    save_log("管理员添加成功",1);
                    $this->ajaxReturn($message);
                } else {
                    save_log("管理员添加失败",0);
                    $this->ajaxReturn(array('info' => "管理员添加失败"));
                }
            }
        }
    }
    /**
     * 更新分类信息
     * @param  [type] $id [分类ID]
     * @return [type]     [description]
     */
    public function update()
    {
        
        //默认显示添加表单
        if (!IS_POST) {
            $group = M('role')->where('is_effect = 1')->select();
            $admin = M('admin')->find(I('id'));
            $this->assign('admin',$admin);
            $this->assign('group',$group);
            $this->display();
        }
        if (IS_POST) {
            $model = D("admin");
            $data = $model->create();
            if (!$data) {
                $this->ajaxReturn(array('info' => $model->getError()));
            }else{
                //   dd(I());die;
                $data['password'] = md5($data['password']);
                //$log_info = M(MODULE_NAME)->where("id=".intval($data['id']))->getField("username");
                if ($model->save($data)) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('admin/index')
                    );
                    save_log("管理员更新成功",1);
                    $this->ajaxReturn($message);
                } else {
                    save_log("管理员更新失败",0);
                    $this->ajaxReturn(array('info' => "管理员更新失败"));
                }
            }
        }
    }
    /**
     * 删除分类
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $model = M('admin');
        $result = $model->delete(intval($id));
        if($result){
            $message = array(
                'info' => 'ok',
                'callback' => U('admin/index')
            );
            save_log("管理员删除成功",1);
            $this->ajaxReturn($message);
        }else{
            save_log("管理员删除失败",0);
            $this->ajaxReturn(array('info' => "管理员删除失败"));
        }
    }
}
