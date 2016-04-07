<?php
namespace App\Controller;

use Think\Controller;
header("Content-Type:text/html;Charset=utf-8");

/**
 * 用户api 统一地址：http://xxx/app/user/funtionname
 */
/**
 * 用户api
 */
class UserController extends BaseController
{

    /**
     * 用户注册
     */
    public function UserRegister()
    {
        // 获取post来的data数据
        if (! IS_POST) {
            $this->returnApiError('请求方式错误，请用POST方法(+_+)！');
            return;
        }
        $data = I('post.');
        $data["type"] = 0;
        $User = M("User");
        $username=I("post.username");
        $password=I("post.password");
        $verifycode=I("post.verifycode");
        if(!$username){
            $this->returnApiError("请输入用户名！");
            return ;
        }
        if(!$password){
            $this->returnApiError("请输入密码！");
            return ;
        }
        if(!$verifycode){
            $this->returnApiError("请输入验证码！");
            return ;
        }
        $result = $User->where(array(
            'username' =>$username
            ))->find();
        if (! $result) {
            if ($User->create()) {
                if($verifycode!=session("verifycode")){
                    $this->returnApiError("验证码错误");
                    return;
                }
                $data["password"]=md5($password);
                $result1 = $User->add($data);
                $info = $User->where("username=" . $username)->select();
                if ($result1) {
                    $this->returnApiSuccess("注册成功", $info);
                } else {
                 $this->returnApiError("注册失败");
             }
         } else {
            $this->returnApiError($User->getError());
        }
    } else {
        $this->returnApiError("该用户名已存在");
    }
}

    /**
     * 登陆
     */
    public function UserLogin()
    {
        if (! IS_POST) {
            $this->returnApiError('请求方式错误，请用POST方法(+_+)！');
            return;
        }
        $username = I('post.username');
        $password = md5(I('post.password'));
        $User = M('User');
        $result = $User->where(array(
            'username' => $username
            ))->find();
        if (! $result) {
            $this->returnApiError("用户名不存在");
        } else 
        if (! ($result['password'] == $password)) {
            $this->returnApiError("登陆失败，密码不正确");
        } else {
            $info = $User->where("username=" . $username)->select();
            $this->returnApiSuccess("登录成功", $info);
        }
    }

    /**
     * 获取用户信息
     */
    public function getUserInfo()
    {
        $username = I('get.username');
        if (! $username) {
            $this->returnApiError('请输入username参数！');
            return;
        } else {
            $User = M('User');
            $info = $User->where("username=" . $username)->select();
            if ($info) {
                $this->returnApiSuccess("获取用户信息成功", $info);
            } else {
                $this->returnApiError('用户名不存在！');
            }
        }
    }

        /**
     * 更新用户信息
     */
        public function updateUserInfo()
        {
            if (! IS_POST) {
                $this->returnApiError('请求方式错误，请用POST方法(+_+)！');
                return;
            }
            $username = I('post.username');
            $data = I('post.');
            if (! $username) {
                $this->returnApiError('请输入username参数！');
                return;
            } else {
                $User = M('User');
                $info = $User->where("username=" . $username)->sava($data);
                if ($info) {
                    $this->returnApiSuccess("更新用户信息成功", $info);
                } else {
                    $this->returnApiError('更新用户信息失败！');
                }
            }
        }

    /**
     * 发送短信验证码方法(4位验证码)
     */
    public function sendSMS()
    {
        $Code = M('Verifycode');
        $data = $Code->create();
        $mobile_code = random(4, 1);
        $content = "您的验证码是：【" . $mobile_code . "】。请不要把验证码泄露给其他人。如非本人操作，可不用理会！";
        $data["verifycode"] = $mobile_code;
        $data["content"] = $content;
        if ($data) {
            $result = $Code->add($data);
            if ($result) {
                // 插入成功
            } else {
                // 插入失败
            }
        }
        $username = I('get.username');
        $res = sendMessage($username, $content);
        $return['status'] = $res['code'];
        $return['msg'] = $res['msg'];
        $return['id'] = $result;
        $return['verifycode'] = $mobile_code;
        session("verifycode",$mobile_code);
        $this->returnApiSuccess("验证码请求发送成功", $return);
    }
}