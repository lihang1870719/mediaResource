<?php
namespace Home\Controller;

use Think\Controller;
use Extend\Oauth\ThinkOauth;
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
    public function login($type=null)
    {
        //方式1：本地账号登陆
        if(empty($type)){
            $User = D('User');
            $result = $User->where(array(
                'username' => $_POST['username']
            ))->find();
            $password=md5($_POST['password']);
            if (! $result) {
                $data['status'] = 1;
                $data['content'] = '该用户名尚未注册';
                $this->ajaxReturn($data);
            } else if (! ($result['password'] ==$password)) {
                $data['status'] = 1;
                $data['content'] = '密码不正确';
                $this->ajaxReturn($data);
            } else {
                $data['status'] = 0;
                $data['content'] = '登录成功';
                session('user_id', $result['id']);
                session('nickname', $result['nickname']);
                $this->ajaxReturn($data);
            }
            return;
        }
        //方式2：如果是微信登录（微信内部浏览器登录，非扫码登录）
        /*         if(strtolower($type) == "weixin"){
         $appid = C('WX_APPID');
         $redirect = C('WX_DOMAIN').U('Login/wechatCallback');
         $scope = "snsapi_userinfo";
         $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect&response_type=code&scope=$scope&state=STATE#wechat_redirect";
         redirect($url);
         } */
        if(strtolower($type) == "weixin"){
            $appid = C('WX_APPID');
            $redirect = C('WX_DOMAIN').U('Login/wechatCallback');
            $scope = "snsapi_userinfo";
            $url = "https://open.weixin.qq.com/connect/qrconnect?appid=$appid&redirect_uri=$redirect&response_type=code&scope=$scope&state=STATE#wechat_redirect";
            //$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect&response_type=code&scope=$scope&state=STATE#wechat_redirect";
            redirect($url);
        }
        
        
        //方式3：QQ  weibo  github第三方登陆
        //验证允许实用的登陆方式，可在后台用代码实现
        $can_use = in_array(strtolower($type), array('qq','sina','github'));
        if(!$can_use){
            $this->error("不允许使用此方式登陆");
        }
        //验证通过  使用第三方登陆
        if($type != null){
            $sns = ThinkOauth::getInstance($type);
            redirect($sns->getRequestCodeURL());
        }
        
    }
       
    //QQ weibo  github登录回调地址
    public function callback($type = null, $code = null)
    {
    
        if(empty($type) || empty($code)){
            $this->error('参数错误');
        }      
        $sns = ThinkOauth::getInstance($type);    
        //腾讯微博需传递的额外参数
        $extend = null;
        if ($type == 'tencent') {
            $extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
        }
        $tokenArray = $sns->getAccessToken($code, $extend);
        $openid = $tokenArray['openid'];
        //请记住每个用户的openid都是唯一的,所以把openid存到数据库即可
        $member = D('User');
        $result = $member->where("openid = $openid")->find();
        if($result){
            //表示用户曾经登录过
            $this->redirect(U('Index/indexLoginPage'));
        }else{
            $data['open_id'] = $openid;
            if($member->add($data)){
                $this->redirect(U('Index/indexLoginPage'));
            }
        }
    }
    
    /**
     * 微信登陆回调地址
     * 如果需要手机微信注册 请用这个方法
     * 参考文档：http://mp.weixin.qq.com/wiki/9/01f711493b5a02f24b04365ac5d8fd95.html
     * @return [type] [description]
     */
    public function wechatCallback()
    {
        $data=array();
        $wechat = new \Extend\Wechat($this->options);
        $wxdata = $wechat->getOauthAccessToken();
        /**
         $wxdata 字段
         {
         "access_token":"ACCESS_TOKEN",
         "expires_in":7200,
         "refresh_token":"REFRESH_TOKEN",
         "openid":"OPENID",
         "scope":"SCOPE",
         "unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL"
         }
         **/
        $openid = $wxdata['openid'];
        $access_token = $wxdata['access_token'];
        session('openid',$openid);
        session('access_token',$access_token);
        //获取AUTH用户资料
        $oauthUserinfo = $wechat->getOauthUserinfo($access_token,$openid);
        /**
         {
         "openid":" OPENID",
         "nickname": NICKNAME,
         "sex":"1",
         "province":"PROVINCE"
         "city":"CITY",
         "country":"COUNTRY",
         "headimgurl":    "http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/46",
         "privilege":[
         "PRIVILEGE1"
         "PRIVILEGE2"
         ],
         "unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL"
         }
         **/
        //是否关注微信号 1：关注  0：未关注  根据实际情况确定是不是要用
        //session('subscribe',$userInfo['subscribe']);
        //组合数据库中的用户字段
        $data['openid'] = $oauthUserinfo['openid'];
        $data['avatar'] =$oauthUserinfo['headimgurl'];
        $data['status'] = 1;
        $data['create_at'] = time();
        $data['update_at'] = time();
    
        #
        #
        #  判断用户是否存在和和注册用户的代码自己实现。
        #
        #
        #
    
    }
      
    // 验证用户名存在方法
    public function ifuser()
    {
        $User = D('User');
        $result = $User->where(array(
            'username' => $_POST['username']
        ))->find();
        if (! $result) {
            $data['status'] = 1;
            $data['content'] = '该用户名尚未注册';
            $this->ajaxReturn($data);
        } else{
            $data['status'] = 0;
            $data['content'] = '该用户名已存在';
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
    
    // 发送短信方法(4位验证码)
    public function sendSMS()
    {
        $Code = M('Verifycode');
        $data = $Code->create();
        $mobile_code = random(4,1);
        $content="您的验证码是：【".$mobile_code."】。请不要把验证码泄露给其他人。如非本人操作，可不用理会！";
        $data["verifycode"]=$mobile_code;
        $data["content"]=$content;
        if ($data) {
            $result = $Code->add($data);
            if ($result) {
                //插入成功
            } else {
                //插入失败
            }
        }        
        $mobile=$_POST["username"];
        $res=sendMessage($mobile,$content);
        //返回值2代表发送成功
        $return['status']=$res['code'];
        $return['msg']=$res['msg'];
        $return['id']=$result;
        $return['verifycode']=$mobile_code;
        $this->ajaxReturn($return);
    }
    
    // 发送邮件方法(6位验证码)
    public function sendEmail()
    {
        $email = $_POST["username"];
        $verifycode = $_POST["verifycode"];
        $Code = M('Verifycode');
        $data = $Code->create();
        $content="亲爱的用户,您好,您在媒资管理平台上注册的验证码是".$verifycode;
        if ($data) {
            $data["content"]= $content;
            $result = $Code->add($data);
            if ($result) {
                //插入成功
            } else {
                //插入失败
            }
        }
        else {
            $this->error($Code->getError());
        }
        
        if (sendMail($email, "这是一封验证邮件", $content)) {
            //$this->success('验证邮件发送成功！');
            $return['status'] = 0;
            $return['info'] = '验证邮件发送成功';
            $return['id'] =$result;
            $this->ajaxReturn($return);
        } else {
                $return['status'] = 1;
                $return['info'] = '验证邮件发送失败';
                $return['id'] =$result;
                $this->ajaxReturn($return);
        }
    }
    
    //更新验证码
    public function changeCodeState()
    {
        $Code = M('Verifycode');
        $data = $Code->create();
        //要修改的对应记录
        $id=$_POST['id'];
        if ($data) {
            $result = $Code->where('id='.$id)->setField('state','1');
            if ($result) {
                //更新成功
                $this->success('更新发送状态成功！');
            } else {
                //更新失败
                $this->error('更新发送状态失败');
            }
        }
        else {
            $this->error($Code->getError());
        }
    }
    
    // 重置密码
    public function resetPwd()
    {
        $User = D('User');
        $data = $User->create();
        if ($data) {
            $uname = $_POST['username'];
            $result = $User->where(array(
                'username' => $uname
            ))->select();
            $rnum = count($result);
            // 首先校验手机号（用户名）是否存在
            if ($rnum == 0) {
                $this->error('用户名尚未注册！');
            } else {
                $data["password"]=md5($_POST['password']);
                    $result1 = $User->where(array(
                        'username' => $uname
                    ))->save($data);
                    if (false !== $result1) {
                        $this->success('重置密码成功,即将跳转至登陆页面！');
                    } else {
                        $this->error('重置密码失败！');
                    }
            }
        } else {
            $this->error($User->getError());
        }
    }
        
} 