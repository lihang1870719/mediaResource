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
            $model = M('role')->select();
            $this->assign('group',$model);
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("Admin");
            $data = $model->create();
            if(M("Admin")->where("username='".$data['username']."'")->count()>0)
            {
                $this->error("管理员账户已存在");
            }
            if (!$data) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($model->getError());
                exit();
            } else {
                $data['password'] = md5($data['password']);
                $data['login_time'] = date("Y-m-d h:i:s",time());
                if ($model->add($data)) {
                    $this->success("管理员添加成功", U('admin/index'));
                } else {
                    $this->error("分类添加失败");
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
            $model = M('category')->find(I('id'));
    
            $this->assign('cate',getSortedCategory(M('category')->select()));
            $this->assign('model',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("Category");
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                //   dd(I());die;
                if ($model->save()) {
                    $this->success("分类更新成功", U('category/index'));
                } else {
                    $this->error("分类更新失败");
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
        $model = M('category');
        //查询属于这个分类的文章
        $posts = M('post')->where("cate_id= %d",$id)->select();
        if($posts){
            $this->error("禁止删除含有文章的分类");
        }
        //禁止删除含有子分类的分类
        $hasChild = $model->where("pid= %d",$id)->select();
        if($hasChild){
            $this->error("禁止删除含有子分类的分类");
        }
        //验证通过
        $result = $model->delete(intval($id));
        if($result){
            $this->success("分类删除成功", U('category/index'));
        }else{
            $this->error("分类删除失败");
        }
    }
}
