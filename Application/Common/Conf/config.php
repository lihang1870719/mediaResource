<?php
return array(
	//'配置项'=>'配置值'
    'MODULE_ALLOW_LIST' =>    array('Home','Admin','App'),
    'SHOW_PAGE_TRACE'   =>  true,
    'LOAD_EXT_CONFIG'   => 'db',
    'URL_CASE_INSENSITIVE'  =>  true,  //url不区分大小写
    'URL_MODEL'   => 2,
    //'URL_HTML_SUFFIX'  =>'html',
    'URL_HTML_SUFFIX'  => 'html',
    //'DEFAULT_FILTER'        => 'htmlspecialchars',
    'SUPER_ADMIN_ID'=>1,  //超级管理员id 删除用户的时候用这个禁止删除
    'SHOW_ERROR_MSG'        =>  true,
    //用户注册默认信息
    'DEFAULT_SCORE'=>100,
    'LOG_RECORD' => true, // 开启日志记录
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误
);