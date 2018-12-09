<?php include_once VIEWPATH . 'common/header.php';  ?>
<?php include_once VIEWPATH . 'common/lefter.php';  ?>
<?php include_once VIEWPATH . 'common/center_top.php';  ?>

<article>
    <div class="title">
        <span class="nav">友情链接</span>
        <span class="count_info"></span>
    </div>
    <div class="op_block">
        <div class="content">
            <div class="sleft">
                <div class="btnlist">
                    <a href="javascript:void(0)" onclick="Mui.box.show('<?php echo site_url('conf/conf/add_url_link/' . $type_id); ?>');"  class="btn-normal"><b>添加链接</b></a>
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
                    <th>名称</th>
                    <th>地址</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pagination['list'] as $k => $v): ?>
                <tr class="<?php if ($k % 2 == 0): ?>tr_bg<?php endif; ?>">
                    <td><?php echo $v['title']; ?></td>
                    <td><?php echo $v['url_link']; ?></td>
                    <td><span class="quick_edit_num" onclick="show_quick_edit_num(<?php echo $v['id']; ?>, this, '<?php echo site_url("content/type/ajax_edit_content_sort"); ?>');"><?php echo $v['sort']; ?></span></td>
                    <td><a href="javascript:void(0)" onclick="Mui.box.show('<?php echo site_url("conf/conf/edit_url_link/{$v['id']}"); ?>');" class="btn-list-op">编辑</a> <a href="javascript:void(0)" onclick="del(<?php echo $v['id']; ?>);" class="btn-list-op del">删除</a></td>
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
    if (confirm('确定要删除此链接吗？')){
        do_get_op('<?php echo site_url("content/type/del_content"); ?>', venus.str_to_json('{id: ' + id + '}'));
    }
}
</script>