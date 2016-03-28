<?php
namespace Home\Controller;

use Think\Controller;
header("Content-Type:text/html;Charset=utf-8");

class UserController extends Controller
{

    public function loginPage()
    {
        $this->display('login');
    }

    public function registerPage()
    {
        $this->display('register');
    }

    public function forgetPage()
    {
        $this->display('forgetPwd');
    }
    
    // 登录方法
    public function login()
    {
        $User = D('User');
        $result = $User->where(array(
            'username' => $_POST['username']
        ))->find();
        if (! $result) {
            $data['status'] = 1;
            $data['content'] = '该手机号尚未注册';
            $this->ajaxReturn($data);
        } else 
            if (! ($result['password'] == $_POST['password'])) {
                $data['status'] = 1;
                $data['content'] = '密码不正确';
                $this->ajaxReturn($data);
            } else {
                $data['status'] = 0;
                $data['content'] = '登录成功';
                session('user_id',$result['id']);
                session('nickname',$result['nickname']);
                $this->ajaxReturn($data);
            }
    }
    
    // 注册方法
    public function register()
    {
        $User = D('User');
        $data = $User->create();
        if ($data) {
            $result = $User->add($data);
            if ($result) {
                $this->success('注册成功！');
            } else {
                $this->error('注册失败！');
            }
        } else {
            $this->error($User->getError());
        }
    }

    //重置密码
    public function resetPwd()
    {
        $User = D('User');
        $data = $User->create();
        if ($data) {
            $uname = $_POST['username'];
            $email = $_POST['email'];
            $result = $User->where(array(
                'username' => $uname
            ))->select();
            $rnum = count($result);
            // 首先校验手机号（用户名）是否存在
            if ($rnum == 0) {
                $this->error('该手机号尚未注册！');
            } else {
                $email1 = $result[0]['email'];
                if ($email1 == $email) {
                    $result1 = $User->where(array(
                        'username' => $uname
                    ))->save($data);
                    if (false !== $result1) {
                        $this->success('重置密码成功！');
                    } else {
                        $this->error('重置密码失败！');
                    }
                } else {
                    $this->error('手机号邮箱不匹配！');
                }
            }
        } else {
            $this->error($User->getError());
        }
    }
} 