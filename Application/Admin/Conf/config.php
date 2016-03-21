<?php
$array = array(
    //'TMPL_ACTION_ERROR'     => 'Public:error', // 默认错误跳转对应的模板文件
    //'TMPL_ACTION_SUCCESS'   => 'Public:success', // 默认成功跳转对应的模板文件   

    'TMPL_PARSE_STRING' => array(
        'DEFAULT_ADMIN' => 'admin',
        '__STATIC__' => __ROOT__.'/Application/'.MODULE_NAME.'/View/' . 'Public/static',),
);
return $array;