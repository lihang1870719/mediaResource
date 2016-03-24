<?php
namespace Admin\Controller;
use Think\Controller;

class RoleController extends CommonController
{
    public function index($key="")
    {
        if(trim($_REQUEST['key'])!='')
        {
            $map['role.name'] = array('like','%'.trim($_REQUEST['key']).'%');
        }   
        $this->assign("default_map",$map);
        parent::index();
    }
    
    public function add()
    {
        //默认显示添加表单
        if (!IS_POST) {
            //输出module与action
            $access_list = M("RoleModule")->where("is_delete=0 and is_effect=1 and module <> 'Index'")->order("module asc")->select();
            foreach($access_list as $k=>$v)
            {
                $access_list[$k]['node_list'] = M("RoleNode")->where("is_delete=0 and is_effect=1 and module_id=".$v['id'])->select();
            }
            $this->assign("model",$access_list);
            $this->display();
        }
    }
    
    public function update($id)
    {
        //默认显示添加表单
        if (!IS_POST) {
            //输出module与action
            $access_list = M("RoleModule")->where("is_delete=0 and is_effect=1 and module <> 'Index'")->order("module asc")->select();
            foreach($access_list as $k=>$v)
            {
                $access_list[$k]['node_list'] = M("RoleNode")->where("is_delete=0 and is_effect=1 and module_id=".$v['id'])->select();
            }
            $access_check = M("RoleAccess")->where("role_id= %d",$id)->select();
            $access_name = M("role")->where("id= %d", $id)->find();
            $this->assign("role", $access_name);
            $this->assign("check",$access_check);
            $this->assign("model",$access_list);
            $this->display();
        }
        if (IS_POST) {
            $data['name'] = I('post.name');
            $data['is_effect'] = I('post.is_effect');
            $data['is_delete'] = 0;
            M('role')->where('id ='.$id)->save($data);
            $role_id = $id;
            if (false !== $role_id) {
                //开始关联节点
                M("RoleAccess")->where("role_id=".$role_id)->delete();
                $role_access = $_REQUEST['role_access'];
                foreach($role_access as $k=>$v)
                {
                    //开始提交关联
                    $item = explode("_",$v);
                    if($item[1]==0)
                    {
                        //模块授权
                        M("RoleAccess")->where("role_id=".$role_id." and module_id=".$item[0])->delete();
                    }
                    else
                    {
                        //节点授权
                        M("RoleAccess")->where("role_id=".$role_id." and module_id=".$item[0]." and node_id=".$item[1])->delete();
                    }
                    $access_item['role_id'] = $role_id;
                    $access_item['node_id'] = $item[1];
                    $access_item['module_id'] = $item[0];
                    M("RoleAccess")->add($access_item);
                }
                $this->success(L("INSERT_SUCCESS"),U('role/index'));
            } else {
                $this->error(L("INSERT_FAILED"));
            }          
        }
    }
    
    public function delete($id)
    {
        $model = M('role');
        $admin = M('admin');
        $exist = $admin->where('role_id = %d', $id)->find();
        if($exist) {
            $this->error("删除失败，该组还存在管理员，请先删除管理员或修改管理员分组");
        }
        $result = $model->where("id= %d",$id)->delete();
        if($result){
            $this->success("删除成功", U('role/index'));
        }else{
            $this->error("删除失败");
        }
    }
    
    public function insert()
    {
        if (IS_POST) {
            $data['name'] = I('post.name');
            $data['is_effect'] = I('post.is_effect');
            $member = M('role')->where('name ="'.$data['name'].'"')->find();
            if(is_null($member)){
                $data['is_delete'] = 0;
                $role_id = D('role')->add($data);
                if (false !== $role_id) {
                    //开始关联节点
                    $role_access = $_REQUEST['role_access'];
                    foreach($role_access as $k=>$v)
                    {
                        //开始提交关联
                        $item = explode("_",$v);
                        if($item[1]==0)
                        {
                            //模块授权
                            M("RoleAccess")->where("role_id=".$role_id." and module_id=".$item[0])->delete();
                        }
                        else
                        {
                            //节点授权
                            M("RoleAccess")->where("role_id=".$role_id." and module_id=".$item[0]." and node_id=".$item[1])->delete();
                        }
                        $access_item['role_id'] = $role_id;
                        $access_item['node_id'] = $item[1];
                        $access_item['module_id'] = $item[0];
                        M("RoleAccess")->add($access_item);
                    }
                    $this->success(L("INSERT_SUCCESS"),U('role/index'));
                } else {
                    $this->error(L("INSERT_FAILED"));
                }
            }
        
        }
    }
}
