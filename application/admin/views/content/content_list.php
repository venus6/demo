<?php include_once VIEWPATH . 'common/header.php';  ?>
<?php include_once VIEWPATH . 'common/lefter.php';  ?>
<?php include_once VIEWPATH . 'common/center_top.php';  ?>

<article>
    <div class="title">
        <span class="nav"><a href="<?php echo site_url('content/type/column_list'); ?>">栏目管理</a><?php if (isset($p_type_info)): ?> &gt; <a href="<?php echo site_url('content/type/into_column/' . $p_type_info['id']); ?>"><?php echo $p_type_info['name']; ?></a><?php endif; ?> &gt; <?php echo $type_info['name']; ?></span>
        <span class="count_info"></span>
    </div>
    <div class="op_block">
        <div class="content">
            <div class="sleft">
                <div class="btnlist">
                    <a href="<?php if ($type_info['fun_type'] == 'cover_content_list'): ?><?php echo site_url('content/type/add_content_cover/' . $type_info['id']); ?><?php elseif ($type_info['fun_type'] == 'content_list'): ?><?php echo site_url('content/type/add_content_title/' . $type_info['id']); ?><?php elseif ($type_info['fun_type'] == 'file_content_list'): ?><?php echo site_url('content/type/add_content_file/' . $type_info['id']); ?><?php endif; ?>" class="btn-normal"><b>添加内容</b></a>
                </div>
            </div>
            <div class="sright-right">
            </div>
        </div>
    </div>
    <div class="table_list">
        <table cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>标题</th>
                    <th>点击量</th>
                    <th>排序</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pagination['list'] as $k => $v): ?>
                <tr class="<?php if ($k % 2 == 0): ?>tr_bg<?php endif; ?>">
                    <td><?php echo $v['title']; ?></td>
                    <td><?php echo $v['click_count']; ?></td>
                    <td><span class="quick_edit_num" onclick="show_quick_edit_num(<?php echo $v['id']; ?>, this, '<?php echo site_url("content/type/ajax_edit_content_sort"); ?>');"><?php echo $v['sort']; ?></span></td>
                    <td><?php echo $v['add_time']; ?></td>
                    <td><a href="<?php if ($type_info['fun_type'] == 'cover_content_list'): ?><?php echo site_url('content/type/edit_content_cover/' . $v['id']); ?><?php elseif ($type_info['fun_type'] == 'content_list'): ?><?php echo site_url('content/type/edit_content_title/' . $v['id']); ?><?php elseif ($type_info['fun_type'] == 'file_content_list'): ?><?php echo site_url('content/type/edit_content_file/' . $v['id']); ?><?php endif; ?>" class="btn-list-op">编辑</a> <a href="javascript:void(0)" onclick="del(<?php echo $v['id']; ?>);" class="btn-list-op del">删除</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="table_foot">
            <span class="info_left">每页最多显示：<b><?php echo $this->pagination->per_page; ?></b> 条</span>
            <span class="info_right"><?php echo $pagination['show']; ?></span>
        </div>
    </div>
</article>

<?php include_once VIEWPATH . 'common/footer.php';  ?>

<script type="text/javascript">
function del(id) {
    if (confirm('确定要删除此内容吗？')){
        do_get_op('<?php echo site_url("content/type/del_content"); ?>', venus.str_to_json('{id: ' + id + '}'));
    }
}
</script>