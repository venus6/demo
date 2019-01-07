<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 将完整的datetime转换为格式化的datetime
 *
 * @param	string
 * @param	array
 * @return	string
 */
function v_datetime2date($datetime, $format = '%Y-%m-%d') {
	if ($datetime != '') {
        $timestamp = strtotime($datetime);
        return date($format, $timestamp);
    } else {
        return ;
    }
}

/**
 * 将状态结果返回给前端JS处理，返回值json化
 *
 * @param	int (1:'success', 0:'fail')
 * @param   string
 * @param   string ('no_op':'什么都不做', 'page':'', 'box':'', 'self_page':'本页面重载', 'error_op':'', 'url':'用于普通 页面，配合$data参数使用,跳转到指定url', 'box_url':'用于弹出层，配合$data参数使用,跳转到指定url')
 * @param   string (something data)
 * @return  json
 */
function v_show_tips($status, $msg, $front_op = 'no_op', $data= '') {
    $arr = array('status'=>$status, 'msg'=>$msg, 'front_op'=>$front_op, 'data'=>$data);
    echo json_encode($arr);
    exit;
}

/**
 * 将多维关联数组的某字段数组单独提取出，形成一个新的普通数组
 *
 * @param   array
 * @param   string
 * @return  array
 */
function v_db_get_column_arr($rs, $column_name) {
    foreach ($rs as $k => $v) {
        $arr[] = $v[$column_name];
    }
    return $arr;
}

/**
 * 判断子字符串是否存在于大字符串中（用于模板中）
 *
 * @param   string
 * @param   string
 * @param   string
 * @return  bool
 */
function v_is_substr_in_str($str, $substr, $delimiter = ',') {
    if(strpos($delimiter . $str . $delimiter, $delimiter . $substr . $delimiter) === false) {
        return false;
    } else {
        return true;
    }
}

function test111() {
    echo 12;
}