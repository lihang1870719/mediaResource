<?php

$SITE_URL = "http://1.thinkadmin.applinzi.com/";
define('URL_CALLBACK', "" . $SITE_URL . "Home/User/callback?type=");
return array(

    //腾讯QQ登录配置
    'THINK_SDK_QQ' => array(
        'APP_KEY' => '101305988', //应用注册成功后分配的 APP ID
        'APP_SECRET' => 'dee2016da2dbb761ea27d31631604b19', //应用注册成功后分配的KEY
        'CALLBACK' => URL_CALLBACK . 'qq',
    ),
    //新浪微博配置
    'THINK_SDK_SINA' => array(
        'APP_KEY' => '4060793441', //应用注册成功后分配的 APP ID
        'APP_SECRET' => 'e8699ac6c531859bb1eefcebad4b03f6', //应用注册成功后分配的KEY
        'CALLBACK' => URL_CALLBACK . 'sina',
    ),
    //人人网配置
    'THINK_SDK_RENREN' => array(
        'APP_KEY' => '', //应用注册成功后分配的 APP ID
        'APP_SECRET' => '', //应用注册成功后分配的KEY
        'CALLBACK' => URL_CALLBACK . 'renren',
    )
);
