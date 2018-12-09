<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 分页配置数组 */
//$config['base_url'] = site_url();    //在具体控制器中提供
//$config['total_rows'] = 100;  //在具体控制器中提供
$config['per_page'] = 15;

//$config['uri_segment'] = 4;

//放在你当前页码的前面和后面的“数字”链接的数量。比方说值为 2 就会在每一边放置两个数字链接
//$config['num_links'] = 2;

//默认分页的 URL 中显示的是你当前正在从哪条记录开始分页，如果你希望显示实际的页数，将该参数设置为 TRUE
$config['use_page_numbers'] = TRUE;

//默认情况下你的查询字符串参数会被忽略，将这个参数设置为 TRUE ，将会将查询字符串参数添加到 URI 分段的后面 以及 URL 后缀的前面。
$config['reuse_query_string'] = True;

//给路径添加一个自定义前缀，前缀位于偏移段的前面。
$config['prefix'] = '';
//给路径添加一个自定义后缀，后缀位于偏移段的后面。
$config['suffix'] = '';
//当该参数设置为 TRUE 时，会使用 application/config/config.php 配置文件中定义的 $config['url_suffix'] 参数 重写 $config['suffix'] 的值。
$config['use_global_url_suffix'] = TRUE;

//如果你希望在整个分页的周围用一些标签包起来，你可以通过下面这两个参数：（起始标签放在所有结果的左侧，结束标签放在所有结果的右侧。）
$config['full_tag_open'] = '<div class="pagination">';
$config['full_tag_close'] = '<span>（共 <strong>total_rows</strong> 条记录）</span></div>';

//左边第一个链接显示的文本，如果你不想显示该链接，将其设置为 FALSE
$config['first_link'] = '首页';
$config['first_tag_open'] = '<span class="pagination_first">';
$config['first_tag_close'] = '</span>';
$config['first_url'] = '';  //自定义首页的链接

//右边最后一个链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
$config['last_link'] = '尾页';
$config['last_tag_open'] = '<span class="pagination_last">';
$config['last_tag_close'] = '</span>';

//下一页链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
$config['next_link'] = '下一页';
$config['next_tag_open'] = '<span class="pagination_next">';
$config['next_tag_close'] = '</span>';

//上一页链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
$config['prev_link'] = '上一页';
$config['prev_tag_open'] = '<span class="pagination_prev">';
$config['prev_tag_close'] = '</span>';

//自定义当前页链接的外标签
$config['cur_tag_open'] = '<span class="pagination_cur">';
$config['cur_tag_close'] = '</span>';

//自定义数字链接的外标签
$config['num_tag_open'] = '<span class="pagination_num">';
$config['num_tag_close'] = '</span>';

//如果你不想显示数字链接（例如你只想显示上一页和下一页链接），你可以通过下面的代码来阻止它显示
$config['display_pages'] = True;

//如果你想为分页类生成的每个链接添加额外的属性，你可以通过键值对设置 "attributes" 参数
//$config['attributes'] = array('class' => '');