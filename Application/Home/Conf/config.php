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
);