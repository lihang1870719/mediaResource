<?php
namespace Home\Model;
use Think\Model;
header("Content-Type:text/html;Charset=utf-8");
class UserModel extends Model{
    // 定义自动验证
    protected $_validate    =   array(
        //array('username','','该帐号已被注册！',1,'unique',1), // 验证用户名是否已经存在
        array('password2','password','确认密码不一致',0,'confirm'),// 验证确认密码是否和密码一致
    );
    // 定义自动完成
    protected $_auto    =   array(
        array('create_time','time',1,'function'),
        array('update_time','time',1,'function'),
        array('status',0),
    );
}
?>