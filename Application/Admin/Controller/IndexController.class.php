<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){ 
        $info = array(
            'course' => M('Course')->where('pid = 0')->count(), 
            'post' => M('Post')->count(),
            'comments' => M('Comments')->count(),
            'admin' => M('admin')->count()
        );
        $this->assign('info', $info);
        $this->display();
    }
}