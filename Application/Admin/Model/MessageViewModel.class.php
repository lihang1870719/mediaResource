<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class MessageViewModel extends ViewModel {
    public $viewFields = array(
        'mail'=>array('id','username','password','mail_server','is_effect','type')
    );
}