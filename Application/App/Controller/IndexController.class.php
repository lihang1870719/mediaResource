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
        $info = M('Course')->select();
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
}