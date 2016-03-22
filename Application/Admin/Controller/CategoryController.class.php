<?php
namespace Admin\Controller;
use Admin\Controller;
/*
 * 分类管理
 */
class CategoryController extends CommonController
{
    public function index($key="")
    {
        if(trim($_REQUEST['key'])!='')
        {
            $map['title'] = array('like','%'.trim($_REQUEST['key']).'%');
            //$map['name'] = array('like','%'.trim($_REQUEST['key']).'%');
            //$map['_logic'] = 'or';
        }   
        $this->assign("default_map",$map);
        parent::index();
    }
    
    /**
     * 添加分类
     */
    public function add()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('category')->select();
            $cate = getSortedCategory($model);
    
            $this->assign('cate',$cate);
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("Category");
            if (!$model->create()) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->ajaxReturn(array('info' => $model->getError()));
                exit();
            } else {   
                if ($model->add()) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('category/index')
                    );
                    $this->ajaxReturn($message);
                } else {
                    $this->ajaxReturn(array('info' => "分类添加失败"));
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
                $this->ajaxReturn(array('info' => $model->getError()));
            }else{
                //   dd(I());die;
                if ($model->save()) {
                    $message = array(
                        'info' => 'ok',
                        'callback' => U('category/index')
                    );
                    $this->ajaxReturn($message);
                } else {
                    $this->ajaxReturn(array('info' => '分类更新失败'));
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
        new \Extend\Slog('./logs0321.text',serialize($id),__FILE__);
        $model = M('category');
        //查询属于这个分类的文章
        $posts = M('post')->where("cate_id= %d",$id)->select();
        if($posts){
            $this->ajaxReturn(array('info' => '禁止删除含有文章的分类'));
        }
        //禁止删除含有子分类的分类
        $hasChild = $model->where("pid= %d",$id)->select();
        if($hasChild){
            $this->ajaxReturn(array('info' => '禁止删除含有子分类的分类'));
        }
        //验证通过
        $result = $model->delete(intval($id));
        if($result){
            $message = array(
                'info' => 'ok',
                'callback' => U('category/index')
            );
            $this->ajaxReturn($message);
        }else{
            $this->ajaxReturn(array('info' => '分类删除失败'));
        }
    }
}