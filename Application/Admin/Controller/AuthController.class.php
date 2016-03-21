<?php
namespace Admin\Controller;
use Think\Controller;

class AuthController extends BaseController{
    
    protected  $DEFALUT_ADMIN = 'admin';
    
    public function __construct()
    {
        parent::__construct();
        $this->check_autha();
    }
    
     public function check_autha(){
        //判断用户登录情况
        //new \Extend\Slog('./logs0315.text','测试信息',__FILE__);
        //\Think\Log::record('测试日志信息，这是警告级别','WARN');
        $sid = session('admin_id');
        if(!isset($sid)) {
            redirect(U('/Admin/Login/index'));
        }
    }
    
    /**
     * 验证检限
     * 已登录时验证用户权限, Index模块下的所有函数无需权限验证
     * 未登录时跳转登录
     */
    private function check_auth()
    {           
        $adm_name = session('admin_name');
        $adm_id = session('admin_id');
        //开始验证权限，当管理员名称不为默认管理员时
        //开始验证模块是否需要授权
        if(!check_empty($adm_id) || !check_empty($adm_id)) {
            $this->error('session已过期，请重新登录',U('/Admin/Login/index'));
        }
        $sql = "select count(*) as c from "."role_node as role_node left join ".
            "role_module as role_module on role_module.id = role_node.module_id ".
            " where role_node.action ='".ACTION_NAME."' and role_module.module = '".CONTROLLER_NAME."' ".
            " and role_node.is_effect = 1 and role_node.is_delete = 0 and role_module.is_effect = 1 and role_module.is_delete = 0 ";
        $count = M()->query($sql);
        $count = $count[0]['c'];      
        if($adm_name != $this->DEFALUT_ADMIN && ACTION_NAME!='index' && $count>0)
        {
            //除IndexAction外需验证的权限列表
            $sql = "select count(*) as c from "."role_node as role_node left join ".
                "role_access as role_access on role_node.id=role_access.node_id left join ".
                "role as role on role_access.role_id = role.id left join ".
                "role_module as role_module on role_module.id = role_node.module_id left join ".
                "admin as admin on admin.role_id = role.id ".
                " where admin.id = ".$adm_id." and role_node.action ='".ACTION_NAME."' and role_module.module = '".CONTROLLER_NAME."' ".
                " and role_node.is_effect = 1 and role_node.is_delete = 0 and role_module.is_effect = 1 and role_module.is_delete = 0 and role.is_effect = 1 and role.is_delete = 0";
                $count = M()->query($sql);
                $count = $count[0]['c'];
                if($count == 0)
                {
                    //节点授权不足，开始判断是否有模块授权
                    $module_sql = "select count(*) as c from "."role_access as role_access left join ".
                        "role as role on role_access.role_id = role.id left join ".
                        "role_module as role_module on role_module.id = role_access.module_id left join ".
                        "admin as admin on admin.role_id = role.id ".
                        " where admin.id = ".$adm_id." and role_module.module = '".CONTROLLER_NAME."' ".
                        " and role_access.node_id = 0".
                        " and role_module.is_effect = 1 and role_module.is_delete = 0 and role.is_effect = 1 and role.is_delete = 0";                        
                        $module_count = M()->query($module_sql);
                        $module_count = $module_count[0]['c'];
                        if($module_count == 0)
                        {
                                $this->error(L("NO_AUTH"),$ajax);
                        }
                }
        }
    }
    
    //index列表的前置通知,输出页面标题
    public function _before_index()
    {
        $this->assign("main_title",L(MODULE_NAME."_INDEX"));
    }
    public function _before_trash()
    {
        $this->assign("main_title",L(MODULE_NAME."_INDEX"));
    }
}