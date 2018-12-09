<?php include_once VIEWPATH . 'common/header.php';  ?>
<?php include_once VIEWPATH . 'common/lefter.php';  ?>
<?php include_once VIEWPATH . 'common/center_top.php';  ?>

<article>
    <div class="op_block">
        <div class="content">
            <div class="sleft">
                <div class="btnlist">
                    <a href="javascript:void(0)" onclick="Mui.box.show('<?php echo site_url('conf/priv/add'); ?>');"  class="btn-normal"><b>添加模块</b></a>
                </div>
            </div>
            <div class="sright-right">
                <form id="search_form" method="get" action="<?php echo current_url(); ?>" name="search" class="search" onsubmit="return check_search_form();" >
                    <div class="search_box">
                        <label for="search_content">输入您想查找的模块名称(可模糊查询)</label>
                        <input type="text" name="name" class="search_content" id="search_content" onfocus="hide_label();" onblur="show_label();" /><input type="submit" class="input_btn bg_color_1" value="查询" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="table_list">
        <table cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>模块名</th>
                    <th>模块级别</th>
                    <th>父模块</th>
                    <th>模块值</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pagination['list'] as $k => $v): ?>
                <tr class="<?php if ($k % 2 == 0): ?>tr_bg<?php endif; ?>">
                    <td><?php echo $v['name']; ?></td>
                    <td><?php echo $v['m_type']; ?></td>
                    <td><?php echo $v['p_name']; ?></td>
                    <td><a href="<?php echo site_url($v['module']); ?>" target="_blank"><?php echo $v['module']; ?></a></td>
                    <td><?php echo $v['orders']; ?></td>
                    <td><a href="javascript:void(0)" onclick="Mui.box.show('<?php echo site_url("conf/priv/edit/{$v['id']}"); ?>');" class="btn-list-op">编辑</a> <a href="javascript:void(0)" onclick="del(<?php echo $v['id']; ?>);" class="btn-list-op del">删除</a></td>
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
    if (confirm('确定要删除此模块吗？')){
        do_get_op('<?php echo site_url("conf/priv/del"); ?>', venus.str_to_json('{id: ' + id + '}'));
    }
}
</script>