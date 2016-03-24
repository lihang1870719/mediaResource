<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class AdminViewModel extends ViewModel {
    public $viewFields = array(
        'admin' => array('id', 'username', 'password', 'is_effect', 'is_delete', 'role_id', 'login_time', 'login_ip'),
        'role' => array('name','_on'=>'role.id = admin.role_id'),
    );
}