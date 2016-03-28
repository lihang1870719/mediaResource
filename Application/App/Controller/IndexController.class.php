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
    
    /*＊
     * 课程api 
     */    
    public function getCourse(){
        $r_page = I('get.page');
        if(!$r_page) {
            $this->returnApiError( '请输入page参数(+_+)！');
            return;
        }
        $count = M('Course')->where('pid = 0')->count();
        $list_row = 10;
        $page  = round($count/$list_row);
        $mod = $count%$list_row;
        $temp = array();
        if ($r_page == $page) { 
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
    
    /**
     * 直播api
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
     * 文章api
     */
    public function getPost(){
        $info = M('Post')->select();
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
        }
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
    
    /**
     * 留言api
     */
    public function getComments(){
        $info = M('Comments')->select();
        if($info) {
            $this->returnApiSuccess('',$info);
        } else {
            $this->returnApiError( '什么也没查到(+_+)！');
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
    
    /*
     * http://xxx/mediaResource/app/index/getCourseIndex
     */
    public function getCourseIndex(){
        $id = I('post.id');
        if(!IS_POST){
            $this->returnApiError( '请求方式错误，请用POST方法(+_+)！');
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
     * http://xxx/mediaResource/app/index/getCourseComments
     */
    public function getCourseComments(){
        $id = I('post.id');
        if(!IS_POST){
            $this->returnApiError( '请求方式错误，请用POST方法(+_+)！');
            return;
        }
        $comments = M('Comments')->where('course_id = %d and style = 0', $id)->select();
        $course = M('Course')->where('id = %d',$id)->select();
        $chart = M('Course')->where('pid = %d', $id)->select();
        $temp = array();
        if($comments) {
            array_push($temp, $comments);
        }
        foreach ($chart as $k => $v) {
            $section = M('Course')->where('pid = %d', $v['id'])->select();
            $temp_comments = M('Comments')->where('course_id = %d and style = 0', $v['id'])->select();
            if($temp_comments){
                array_push($temp, $temp_comments);
            }
            if($section) {
                foreach ($section as $m => $n) {
                    $temp_comments_section = M('Comments')->where('course_id = %d and style = 0', $n['id'])->select();                       
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
    
    /*
     * http://xxx/mediaResource/app/index/getCourseDetails
     */
    public function getCourseDetails(){
        $id = I('post.id');
        if(!IS_POST){
            $this->returnApiError( '请求方式错误，请用POST方法(+_+)！');
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
}