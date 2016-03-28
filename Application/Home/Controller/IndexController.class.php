<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function indexPage(){
        $this->display('index');
    }
    public function indexLoginPage(){
        $this->display('indexLogin');
    }
    public function personal(){
        $this->display('personal');
    }
     public function exitLogin(){
        session(null);
        $this->display('index');
    }
}