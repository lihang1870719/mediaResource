<?php
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller{
    
    //后台基础类构造
    public function __construct()
    {
        parent::__construct();
        $this->sidebar();
    }
    
    public function sidebar()
    {
        $sidebar = M("RoleModule")->where("is_delete=0 and is_effect=1")->order("module asc")->select();
        $this->assign("sidebar",$sidebar);
    }

    protected function error($message,$ajax = 0)
    {

        if(!$this->get("jumpUrl"))
        {
            if($_SERVER["HTTP_REFERER"]) $default_jump = $_SERVER["HTTP_REFERER"]; else $default_jump = u("Index/main");
            $this->assign("jumpUrl",$default_jump);
        }
        parent::error($message,$ajax);
    }
    protected function success($message,$ajax = 0)
    {

        if(!$this->get("jumpUrl"))
        {
            if($_SERVER["HTTP_REFERER"]) $default_jump = $_SERVER["HTTP_REFERER"]; else $default_jump = u("Index/main");
            $this->assign("jumpUrl",$default_jump);
        }
        parent::success($message,$ajax);
    }
}
?>
