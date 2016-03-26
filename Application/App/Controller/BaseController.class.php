<?php
namespace App\Controller;
use Think\Controller;

class BaseController extends Controller{   
    //后台基础类构造
    public function __construct()
    {
        parent::__construct();
    }
    
    public function check()
    {
        
    }
    
    public function returnApiSuccess($msg = null,$data = array()){
        $result = array(
            'flag' => 'Success',
            'msg' => $msg,
            'data' =>$data
        );
        $this->ajaxReturn(json_encode($result), 'JSON');
    }
    
    public function returnApiError($msg = null){
        $result = array(
            'flag' => 'Error',
            'msg' => $msg,
        );
        $this->ajaxReturn(json_encode($result), 'JSON');
    }
    
    public function returnApiErrorExample(){
        $result = array(
            'flag' => 'Error',
            'msg' => '当前系统繁忙，请稍后重试！',
        );
        print json_encode($result);
    }
    
    public function checkDataPost($data = null){
        if(!empty($data)){
            $data = explode(',',$data);
            foreach($data as $k=>$v){
                if((!isset($_POST[$k]))||(empty($_POST[$k]))){
                    if($_POST[$k]!==0 && $_POST[$k]!=='0'){
                        $this->returnApiError($k.'值为空！');
                    }
                }
            }
            unset($data);
            $data = I('post.');
            unset($data['_URL_'],$data['token']);
            return $data;
        }
    }
    
    public function checkDataGet($data = null){
        if(!empty($data)){
            $data = explode(',',$data);
            foreach($data as $k=>$v){
                if((!isset($_GET[$k]))||(empty($_GET[$k]))){
                    if($_GET[$k]!==0 && $_GET[$k]!=='0'){
                        $this->returnApiError($k.'值为空！');
                    }
                }
            }
            unset($data);
            $data = I('get.');
            unset($data['_URL_'],$data['token']);
            return $data;
        }
    }
   
}