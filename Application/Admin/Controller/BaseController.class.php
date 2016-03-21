<?php
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller{
    
    //后台基础类构造
    public function __construct()
    {
        parent::__construct();
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
