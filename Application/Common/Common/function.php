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


/**
 * 生成验证码
 */
function random($length = 6 , $numeric = 0) {
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
    if($numeric) {
        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
    } else {
        $hash = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return $hash;
}


/**
 * 短信发送函数
 */
function Post($curlPost,$url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
    $return_str = curl_exec($curl);
    curl_close($curl);
    return $return_str;
}

function xml_to_array($xml){
    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
    if(preg_match_all($reg, $xml, $matches)){
        $count = count($matches[0]);
        for($i = 0; $i < $count; $i++){
            $subxml= $matches[2][$i];
            $key = $matches[1][$i];
            if(preg_match( $reg, $subxml )){
                $arr[$key] = xml_to_array( $subxml );
            }else{
                $arr[$key] = $subxml;
            }
        }
    }
    return $arr;
}

function sendMessage($mobile,$content) {
    $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
    $post_data = "account=cf_cjzc&password=cjzc927&mobile=".$mobile."&content=".rawurlencode($content);
    $gets =  xml_to_array(Post($post_data, $target));
    return $gets['SubmitResult'];
}