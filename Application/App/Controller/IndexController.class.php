<?php
namespace App\Controller;
use Think\Controller;
/**
 * api 统一地址：http://xxx/app/index/funtionname
 * 例如 获得所有分类：
 * http://hostname/app/index/getCategory
 * @author lh
 *
 */
class IndexController extends BaseController {
    public function index(){
        //验证客户端的合法性
        $this->check();
        $this->returnApiError( '什么也没查到(+_+)！'); 
    }
    
    /* 
     * 获得移动段首页相关信息，包括轮播，课程列表，分类
     * */
    public function getIndex(){
        $category = M('Category')->select();
        $course = M('Course')->select();
        $carousel = M('Course')->where('image_sort != 0 AND image_status = 1')->select();
        $info = array(
            'category' => $category,
            'course'  => $course,
            'carousel' => $carousel
        );
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
    }
    
    /**
     * 分类api
     *
     */
    public function getCategory(){
        //检查是否通过post方法得到数据
        //$field[] = 'id,pid,name,title,keywords,description';
        $info = M('Category')->select();       
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');            
        }
    }
    
    /**
     * 指定分类下的课程列表
     * 
     * getCategoryCourse/id/2
     */
    public function getCategoryCourse(){
        //检查是否通过post方法得到数据
        $id = I('get.id');
        //$field[] = 'id,pid,name,title,keywords,description';
        $info = M('Course')->where("cate_id = $id")->select();
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
    }
    
    
    /*************************course****************************************************************8/
    /*＊
     * 课程api  权限还没有加上去 选择可以点播的，也就是加上status=4
     */    
    public function getCourse(){
        $r_page = I('get.page');
        if(!$r_page) {
            $this->returnApiError( '请输入page参数(+_+)！');
            return;
        }
        $count = M('Course')->where('pid = 0')->count();
        $list_row = 10;
        $page  = ceil($count/$list_row);
        $mod = $count%$list_row;
        $temp = array();
        if($r_page > $page) {
            $this->returnApiError( 'page参数超过了最大值(+_+)！');
        } else if ($r_page == $page) { 
            $course = M('Course')->where('pid = 0')->limit(0 + 10*($r_page-1),$mod)->select();
            $last = true;
        } else {
            $course = M('Course')->where('pid = 0')->limit(0 + 10*($r_page-1),10)->select(); 
            $last = false;
        }
        array_push($temp, $course);
        $info = array(
            'course' => $course,
            'page' => $r_page,
            'last' => $last
        );
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        } 
    }
    
    /*
     * http://xxx/mediaResource/app/index/getCourseIndex
     */
    public function getCourseIndex(){
        $id = I('get.id');
        if(!$id){
            $this->returnApiError( '请求参数有误方法(+_+)！');
            return;
        }
        $course = M('Course')->where('id = %d', $id)->select();
        $chart = M('Course')->where('pid = %d', $id)->select();
        $temp = array();
        foreach ($chart as $k => $v) {
            $section = M('Course')->where('pid = %d', $v['id'])->select();
            if($section) {
        	       $temp1 = array(
        	           'chart' => $v,
        	           'section' => $section
        	       );
        	       array_push($temp, $temp1);
            }else {
                $temp1 = array(
                    'chart' => $v,
                    'section' => '',
                );
                array_push($temp, $temp1);
            }
        }
        $info = array(
            'course' => $course,
            'chart_section' => $temp
        );
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
    }
    
    /*
     * http://xxx/mediaResource/app/index/getCourseComments/id/xxx
     */
    public function getCourseComments(){
        $id = I('get.id');
        if(!$id){
            $this->returnApiError( '请求参数有误方法(+_+)！');
            return;
        }
        $sql = "select ms_comments.id,ms_comments.comments,
            ms_comments.course_id,ms_comments.user_id,
            ms_user.username as username from ms_comments left join ms_user 
            on ms_comments.user_id = ms_user.id 
            where ms_comments.style = 0 and ms_comments.course_id = ";
        $comments= M()->query($sql.$id);
        $course = M('Course')->where('id = %d',$id)->select();
        $chart = M('Course')->where('pid = %d', $id)->select();
        $temp = array();
        if($comments) {
            array_push($temp, $comments);
        }
        foreach ($chart as $k => $v) {
            $section = M('Course')->where('pid = %d', $v['id'])->select();
            $temp_comments = M()->query($sql.$v['id']);
            if($temp_comments){
                array_push($temp, $temp_comments);
            }
            if($section) {
                foreach ($section as $m => $n) {
                    $temp_comments_section = M()->query($sql.$n['id']);
                    if($temp_comments_section){
                        array_push($temp, $temp_comments_section);
                    }
                }
            }
        }
        $info = $temp;
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
    }
    
    
    /**
     * 获取客户端提交的评论 post请求
     *  http://xxx/mediaResource/app/index/getComments
     *  course_id:xx
     *  user_id:xxx
     *  comments:xxx
     */
    public function getComments(){
        $courseId = I('post.course_id');
        $userId = I('post.user_id');
        $comments = I('post.comments');
        $result = M('course')->where('id=%d and user_id=%d', $courseId, $userId)->find();
        if(!$result) {
            $this->returnApiError( 'userId courseId 错误(+_+)！');
            return;
        }
        $data = array(
            'comments' => $comments,
            'course_id' => $courseId,
            'user_id' => $userId,
            'type' => 1,
            'style' => 0
        );
        if(M('comments')->add($data)){
            $info = "留言插入成功";
            $this->returnApiSuccess('',$info);
        }else{
            $this->returnApiError( '什么也没查到(+_+)！');
        }
       
    }
    /*
     * http://xxx/mediaResource/app/index/getCourseDetails
     */
    public function getCourseDetails(){
        $id = I('get.id');
        if(!$id){
            $this->returnApiError( '请求参数有误方法(+_+)！');
            return;
        }
        $course = M('course')->where('id=%d', $id)->select();
        //这里用的是admin表后期替换成user
        //$user = M('user')->where('id=%d', $course[0]['user_id'])->select();
        $user = M('admin')->where('id=%d', $course[0]['user_id'])->select();
        $relate_course = M('course')->where('cate_id=%d', $course[0]['cate_id'])->limit(3)->select();
        $info = array(
            'course' => $course,
            'user' => $user,
            'relate_course' => $relate_course
        );
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
    }
    
    
    /************live***********************************************************************/
    /**
     * 直播api 还没加上直播中 也就是status为2才能是直播中的
     */
    public function getLive(){
        $map['status'] = array('in', '1,2,3,4');
        $info = M('Course')->where($map)->select();
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        } 
    }
    
    /**
     * 用户的历史记录。客户端向服务器传递用户正在学习什么课程
     * http://xxx/mediaResource/app/index/getHistory/user_id/xxx/course_id/xxx
     * 
     */
    public function getHistory(){
        $user_id = I('get.user_id');
        $course_id = I('get.course_id');
        if(!$user_id || !$course_id){
            $this->returnApiError( '参数有问题(+_+)！');
            return;
        }
        $data = array(
            'user_id' => $user_id,
            'course_history' => $course_id
        );
        $model = M('user_course');
        if($model->where('user_id = %d and course_history=%d',$user_id,$course_id)->select()){
            $this->returnApiError( '记录已经存在啦(+_+)！');
            return;
        }
        if ($model->add($data)) {
            $this->returnApiSuccess('','');
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
    }
    
    
    /************************post**************************************************************/
    /**
     * 获得全部文章api 文章的api也是需要加上  status = 1
     */
    public function getPost(){
        $r_page = I('get.page');
        if(!$r_page) {
            $this->returnApiError( '请输入page参数(+_+)！');
            return;
        }
        $count = M('Post')->count();
        $list_row = 10;
        $page  = ceil($count/$list_row);
        $mod = $count%$list_row;
        $temp = array();
        $sql = 'select ms_post.id,ms_post.title,ms_post.content,ms_post.crt,ms_category.title as cate_title from ms_post left join ms_category on ms_post.cate_id = ms_category.id ';
        if($r_page > $page) {
            $this->returnApiError( 'page参数超过了最大值(+_+)！');
        } else if ($r_page == $page) {
            $start = 0 +10*($r_page-1);
            $limit = 'limit '.$start.','.$mod;
            $post = M()->query($sql.$limit);     
            $last = true;
        } else {
            $start = 0 +10*($r_page-1);
            $end = 10;
            $limit = 'limit '.$start.','.$end;
            $post = M()->query($sql.$limit);  
            $last = false;
        }
        array_push($temp, $post);
        $info = array(
            'post' => $post,
            'page' => $r_page,
            'last' => $last
        );
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        } 
    }
    
    /*
     * 获得指定分类的文章 同上
     * 
     */
    public function getCatePost(){
        $r_page = I('get.page');
        $cate_id = I('get.cate_id');
        if(!$r_page && !$cate_id) {
            $this->returnApiError( '请输入page参数(+_+)！');
            return;
        }
        $count = M('Post')->where('cate_id = %d', $cate_id)->count();
        $list_row = 10;
        $page  = ceil($count/$list_row);
        new \Extend\Slog('./logs0401.text',$page."===".$r_page,__FILE__);
        $mod = $count%$list_row;
        $temp = array();
        $sql = "select ms_post.id,ms_post.title,ms_post.content,ms_post.crt,ms_category.title as cate_title from ms_post left join ms_category on ms_post.cate_id = ms_category.id where ms_post.cate_id = $cate_id ";
        if($r_page > $page) {
            $this->returnApiError( 'page参数超过了最大值(+_+)！');
        } else if ($r_page == $page) {
            $start = 0 +10*($r_page-1);
            $limit = 'limit '.$start.','.$mod;
            $post = M()->query($sql.$limit);     
            $last = true;
        } else {
            $start = 0 +10*($r_page-1);
            $end = 10;
            $limit = 'limit '.$start.','.$end;
            $post = M()->query($sql.$limit);  
            $last = false;
        }
        array_push($temp, $post);
        $info = array(
            'post' => $post,
            'page' => $r_page,
            'last' => $last
        );
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
    }
    
    /**
     * 获得指定文章的详情页面 客户端需要发送两个get请求 同上
     * http://xxx/mediaResource/App/Index/getPostHtml/id/1 生成对应的html文件
     * http://xxx/mediaResource/App/Index/getPostDetail/id/1 获得html，user等文章的详细信息
     */
    public function getPostDetail(){
        $post_id = I('get.id');
        $post = M('Post')->where('id=%d', $post_id)->select();
        $user = M()->query('select ms_user.username as username from ms_user left join ms_post on ms_user.id = ms_post.user_id where ms_post.id = '.$post_id);
        $cate = M()->query('select ms_category.title as cate from ms_category left join ms_post on ms_category.id = ms_post.cate_id where ms_post.id = '.$post_id);
        if(!$post) {
            $this->returnApiError( '111什么也没查到(+_+)！');
            return ;
        }
        $links = U('App/Index/getPostHtml',array('id' => $post_id));
        $info = array(
            'links' => $links,
            'user' => $user,
            'cate_title' => $cate
        );
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }        
    }
    
    public function getPostHtml(){
        $post_id = I('get.id');
        $post = M('Post')->where('id=%d', $post_id)->select();
        $user = M()->query('select ms_user.username as username from ms_user left join ms_post on ms_user.id = ms_post.user_id where ms_post.id = '.$post_id);
        $cate = M()->query('select ms_category.title as cate from ms_category left join ms_post on ms_category.id = ms_post.cate_id where ms_post.id = '.$post_id);
        $this->assign('model', $post);
        $this->assign('user', $user[0]['username']);
        $this->assign('cate', $cate[0]['cate']);
        $this->display();
    }
    /**
     * 轮播api
     */
    public function getCarousel(){
        $info = M('Course')->where('image_sort != 0 AND image_status = 1')->select();
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
    }
    
    /*****************************笔记******************************************/
    /**
     * http://xxx/mediaResource/App/Index/getnote
     * post: type=1 user_id=1 course_id=1 note = xxx
     * 获得 客户端给服务端指定用户在指定课程做的笔记
     * type为1者是文字；type 为2者为语音
     * note 为 笔记内容
     */
    public function getnote(){
        $type = I('post.type');
        $courseId = I('post.course_id');
        $userId = I('post.user_id');
        $comments = I('post.note');
        $result = M('course')->where('id=%d and user_id=%d', $courseId, $userId)->find();
        if(!$result) {
            $this->returnApiError( 'userId courseId 错误(+_+)！');
            return;
        }
        if($type == 1) {
            /* 文字 */
            $data = array(
                'comments' => $comments,
                'course_id' => $courseId,
                'user_id' => $userId,
                'type' => $type,
                'style' => 1
            );
            if(M('comments')->add($data)){
                $info = "笔记插入成功";
                $this->returnApiSuccess('',$info);
            }else{
                $this->returnApiError( '什么也没查到(+_+)！');
            }
        } else if ($type == 2) {
            $data = array(
                'comments' => $comments,
                'course_id' => $courseId,
                'user_id' => $userId,
                'type' => $type,
                'style' => 2
            );
            if(M('comments')->add($data)){
                $info = "笔记插入成功";
                $this->returnApiSuccess('',$info);
            }else{
                $this->returnApiError( '什么也没查到(+_+)！');
            }
        }
    }
    
     public function uploader(){
        $base_path = "./uploads/"; //接收文件目录  
        $target_path = $base_path . basename ( $_FILES ['uploadedfile'] ['name'] );  
        if (move_uploaded_file ( $_FILES ['uploadedfile'] ['tmp_name'], $target_path )) {  
            $info = array ("message" => "uploads/".$_FILES ['uploadedfile'] ['name'] );  
            //echo json_encode ( $array );
            $this->returnApiSuccess('',$info);
        } else {  
            $array = array ("code" => "0", "message" => "There was an error uploading the file, please try again!" . $_FILES ['uploadfile'] ['error'] );  
            $this->returnApiError( '上传文件出错(+_+)！');
        }   
    }
    
    /**
     * 用户api
     */
    public function getUserInfo(){
        
    }
    
    /**
     * 课程搜索接口
     */
    public function searchCourse(){
        $map['title'] = array('like','%'.trim($_REQUEST['key']).'%');
        $map['pid'] = array('eq', 0);
        $info = M('Course')->where($map)->select();
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
    }
    
    /**
     * 文章搜索接口
     */
    public function searchPost(){
        $map['title'] = array('like','%'.trim($_REQUEST['key']).'%');
        $info = M('Post')->where($map)->select();
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
    }
   
}