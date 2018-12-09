<?php include_once VIEWPATH . 'common/header.php';  ?>
<?php include_once VIEWPATH . 'common/lefter.php';  ?>
<?php include_once VIEWPATH . 'common/center_top.php';  ?>

<article>
    <div class="op_block">
        <div class="content">
            <div class="sleft">
                <div class="btnlist">
                <?php if ($this->config->item('auth_user_info')['supper'] == 8): ?>
                    <a href="javascript:void(0)" onclick="Mui.box.show('<?php echo site_url('content/type/add_column'); ?>');"  class="btn-normal"><b>添加栏目</b></a>
                <?php endif; ?>
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
                    <th>栏目名</th>
                <?php if ($this->config->item('auth_user_info')['supper'] == 8): ?>
                    <th>功能类别</th>
                    <th>显示</th>
                    <th>排序</th>
                <?php endif; ?>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pagination['list'] as $k => $v): ?>
                <tr class="<?php if ($k % 2 == 0): ?>tr_bg<?php endif; ?>">
                    <td><?php echo $v['name']; ?></td>
                <?php if ($this->config->item('auth_user_info')['supper'] == 8): ?>
                    <td><?php echo $v['fun_type_name']; ?></td>
                    <td><?php echo $v['display']; ?></td>
                    <td><span class="quick_edit_num" onclick="show_quick_edit_num(<?php echo $v['id']; ?>, this, '<?php echo site_url("content/type/ajax_edit_type_sort"); ?>');"><?php echo $v['sort']; ?></span></td>
                <?php endif; ?>
                    <td><a href="<?php echo site_url('content/type/into_column/' . $v['id']); ?>" class="btn-list-op">进入栏目</a> <?php if ($this->config->item('auth_user_info')['supper'] == 8): ?><a href="javascript:void(0)" onclick="Mui.box.show('<?php echo site_url("content/type/edit_column/{$v['id']}"); ?>');" class="btn-list-op">编辑</a> <a href="javascript:void(0)" onclick="del(<?php echo $v['id']; ?>);" class="btn-list-op del">删除</a><?php endif; ?></td>
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
    if (confirm('确定要删除此栏目吗？删除此栏目也将删除此栏目下的所有内容！')){
        do_get_op('<?php echo site_url("content/type/del_type"); ?>', venus.str_to_json('{id: ' + id + '}'));
    }
}
</script>