<?php
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__.'/Application/'.MODULE_NAME.'/View/' . 'Public/static',),
    
         // 配置邮件发送服务器
    'MAIL_SMTP'                     =>TRUE,
    'MAIL_HOST'                     =>'smtp.qq.com',
    'MAIL_PORT' =>'587',
    'MAIL_SECURE' =>'tls',
    'MAIL_SMTPAUTH'                 =>TRUE,
    'MAIL_USERNAME'                 =>'494970997@qq.com',
    'MAIL_PASSWORD'                 =>'abybujwqlkgscbbc',
    'MAIL_CHARSET'                  =>'utf-8',
    'MAIL_ISHTML'                   =>TRUE,
    'MAIL_FromName'              =>'武汉大学媒资管理平台',
    //CSRF
    'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true
    //是否开启模板布局 根据个人习惯设置
    'LAYOUT_ON'=>false,
);