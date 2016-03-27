<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 系统共用类，包括搜索，查询，上传等共用方法
 * @author lh
 *
 */
class CommonController extends AuthController{
    
    public function index($view = false) {
        //列表过滤器，生成查询Map对象
        $map = $this->_search ($view);
        //追加默认参数
        if($this->get("default_map"))
        $map = array_merge($map,$this->get("default_map"));

        if (method_exists ( $this, '_filter' )) {
            $this->_filter ( $map );
        }
        if ($view) {
           $name = CONTROLLER_NAME.'View';
        } else {
           $name=CONTROLLER_NAME;
        }
        $model = D ($name);
        if (! empty ( $model )) {
            $this->_list ( $model, $map );
        }
        $this->display ();
        return;
    }
    
    /**
     +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $name 数据对象名称
     +----------------------------------------------------------
     * @return HashMap
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    protected function _search($view, $name = '') {
        //生成查询条件
        if (empty ( $name )) {
            $name = CONTROLLER_NAME;
        }
        if ($view) {
            $name = CONTROLLER_NAME.'View';
        } else {
            $name=CONTROLLER_NAME;
        }
        $model = D ( $name );
        $map = array ();
        foreach ( $model->getDbFields () as $key => $val ) {
            if (isset ( $_REQUEST [$val] ) && $_REQUEST [$val] != '') {
                $map [$val] = $_REQUEST [$val];
            }
        }
        return $map;
    
    }
    
    /**
     +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param Model $model 数据对象
     * @param HashMap $map 过滤条件
     * @param string $sortBy 排序
     * @param boolean $asc 是否正序
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    protected function _list($model, $map, $sortBy = '', $asc = false) {
        //排序字段 默认为主键名
        if (isset ( $_REQUEST ['_order'] )) {
            $order = $_REQUEST ['_order'];
        } else {
            $order = ! empty ( $sortBy ) ? $sortBy : $model->getPk ();
        }
        //排序方式默认按照倒序排列
        //接受 sost参数 0 表示倒序 非0都 表示正序
        if (isset ( $_REQUEST ['_sort'] )) {
            $sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
        } else {
            $sort = $asc ? 'asc' : 'desc';
        }
        //取得满足条件的记录数
        $count = $model->where ( $map )->count ();
    
        if ($count > 0) {
            //创建分页对象
            if (! empty ( $_REQUEST ['listRows'] )) {
                $listRows = $_REQUEST ['listRows'];
            } else {
                $listRows = 15;
                //$listRows = '';
            }
            $p = new \Extend\Page ( $count, $listRows );
            //分页查询数据
    
            $voList = $model->where($map)->order( "`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select ( );
            	
            //echo $model->getlastsql();
            //分页跳转的时候保证查询条件
            foreach ( $map as $key => $val ) {
                new \Extend\Slog('./logs0320.text',serialize($val),__FILE__);
                if (! is_array ( $val )) {
                    $p->parameter .= "$key=" . urlencode ( $val ) . "&";
                }
            }
            //分页显示
    
            $page = $p->show ();
            
            //列表排序显示
            $sortImg = $sort; //排序图标
            $sortAlt = $sort == 'desc' ? l("ASC_SORT") : l("DESC_SORT"); //排序提示
            $sort = $sort == 'desc' ? 1 : 0; //排序方式

            //catergory 增加|--
            if ((CONTROLLER_NAME === 'Course' || CONTROLLER_NAME === 'Category') && empty($map) ) {
                $voList = "";
                $voList = $model->where($map)->order('id ASC')->select();
                $voList = array_slice(getSortedCategory($voList),$p->firstRow,$p->listRows);
            } 
            
            //模板赋值显示            
            $this->assign ( 'model', $voList );
            $this->assign ( 'sort', $sort );
            $this->assign ( 'order', $order );
            $this->assign ( 'sortImg', $sortImg );
            $this->assign ( 'sortType', $sortAlt );
            $this->assign ( "page", $page );
            $this->assign ( "nowPage",$p->nowPage);
        }
        return;
    }
    
    
    /**
     * 上传图片的通公基础方法
     *
     * @return array
     */
    protected function uploadImage()
    {
       
    }
}