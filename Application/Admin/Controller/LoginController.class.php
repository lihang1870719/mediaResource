<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    //主页
    public function index(){
        $this->display();
    }
    //登录验证
    public function login(){
        if(!IS_AJAX){
            $this->ajaxReturn(array(
                    'info' => '非法访问方式'
            ));
        }
        $member = M('admin');
        $username = I('username','','addslashes');
        $password = I('password','','md5');
        $code = I('verify','','strtolower');
        if(!($this->check_verify($code))){
            $this->ajaxReturn(array(
                'info' => '验证码错误',
            ));
        }
        $user = $member->where('username = "'.$username.'" and password="'.$password.'"')->find();
        if(!$user) {
            $this->ajaxReturn(array(
                'info' => '账号或密码错误 :(',
            ));
        }
        //验证账户是否被禁用
        if($user['is_effect'] == 0){
            $this->ajaxReturn(array(
                'info' => '账号被禁用，请联系超级管理员 :(',
                'callback' => U('Index/index')
            ));
        }
        //验证是否为管理员
        //更新登陆信息
        $data =array(
            'id' => $user['id'],
            'login_time' => time(),
            'login_ip' => get_client_ip(),
        );
        
        //如果数据更新成功  跳转到后台主页
        if($member->save($data)){
            session('admin_id',$user['id']);
            session('admin_name',$user['username']);
            $message = array(
                'info' => 'ok',
                'callback' => U('Index/index')
            );
        }
        
        $this->ajaxReturn($message);
    }
    
    //验证码
    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->codeSet = '0123456789';
        $Verify->fontSize = 17;
        $Verify->length = 4;
        $Verify->entry();
    }
    
    protected function check_verify($code){
        $verify = new \Think\Verify();
        return $verify->check($code);
    }
    
    public function logout(){
        session('admin_id',null);
        session('admin_name',null);
        redirect(U('Login/index'));
    }
}