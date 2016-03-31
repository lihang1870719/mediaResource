<?php 

function getHref($module)
{
    $result = "{:U('".$module."/index')}";
    return $result;
}

function dd($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function check_empty($data)
{
    if(trim($data)=='')
    {
        return false;
    }
    return true;
}

/**
 * 获取排序后的分类
 * @param  [type]  $data  [description]
 * @param  integer $pid   [description]
 * @param  string  $html  [description]
 * @param  integer $level [description]
 * @return [type]         [description]
 */
function getSortedCategory($data,$pid=0,$html="|---",$level=0)
{
	$temp = array();
	foreach ($data as $k => $v) {
		if($v['pid'] == $pid){
	
			$str = str_repeat($html, $level);
			$v['html'] = $str;
			$temp[] = $v;

			$temp = array_merge($temp,getSortedCategory($data,$v['id'],'|---',$level+1));
		}
		
	}
	return $temp;
}

/**
 * 根据key，返回当前行的所有数据
 * @param  string  $key  字段key
 * @return array         当前行的所有数据
 */
function getSettingValueDataByKey($key)
{
	return M('setting')->getByKey($key);
}

/**
 * 根据key返回field字段
 * @param  string $key   [description]
 * @param  string $field [description]
 * @return string        [description]
 */
function getSettingValueFieldByKey($key,$field)
{
	return M('setting')->getFieldByKey($key,$field);
}

function get_gmtime()
{
    return (time() - date('Z'));
}

//后台日志记录
function save_log($msg,$status)
{
    $log_data['log_info'] = $msg;
    $log_data['log_time'] = get_gmtime();
    $log_data['log_admin'] = session('admin_id');
    $log_data['log_ip']	= get_client_ip();
    $log_data['log_status'] = $status;
    $log_data['module']	=	MODULE_NAME;
    $log_data['action'] = 	ACTION_NAME;
    M("Log")->add($log_data);
}