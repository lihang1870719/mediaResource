<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class CourseViewModel extends ViewModel {
    public $viewFields = array(
        'course'=>array('id','pid','title','link','content','user_id','cate_id','time','status', 'type'),
        'category'=>array('name'=>'category_name','title'=>'category_title', '_on'=>'course.cate_id=category.id'),
        'admin'=>array('username', '_on'=>'course.user_id=admin.id'),
    );
}

?>
