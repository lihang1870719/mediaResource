<?php 
namespace Admin\Model;
use Think\Model\ViewModel;
class CommentsViewModel extends ViewModel {
   public $viewFields = array(
     'comments'=>array('id','comments','comments_links','time', 'user_id','course_id','type', 'style'),
     'course'=>array('title'=>'course_title', '_on'=>'comments.course_id=course.id'),
     'admin'=>array('username', '_on'=>'comments.user_id=admin.id'),
   );
 }

?>