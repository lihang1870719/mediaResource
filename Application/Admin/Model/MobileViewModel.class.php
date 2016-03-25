<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class MobileViewModel extends ViewModel {
    public $viewFields = array(
        'course'=>array('id','pid','title','link','content','user_id','cate_id','time','status', 'type', 'image', 'image_status', 'image_sort')
    );
}