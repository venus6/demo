<?php include_once VIEWPATH . 'common/header.php';  ?>
<?php include_once VIEWPATH . 'common/lefter.php';  ?>
<?php include_once VIEWPATH . 'common/center_top.php';  ?>

<article>
    <div class="op_block">
        <div class="content">
            <div class="sleft">
                <div class="btnlist">
                    <a href="<?php echo site_url('message/message/message_list?finish=no'); ?>" class="btn-normal"><b>未读</b></a>
                    <a href="<?php echo site_url('message/message/message_list?finish=yes'); ?>" class="btn-normal"><b>已读</b></a>
                </div>
            </div>
            <div class="sright-right">
                <form id="search_form" method="get" action="<?php echo current_url(); ?>" name="search" class="search" onsubmit="return check_search_form();" >
                    <div class="search_box">
                        <label for="search_content">输入您想查找的客户名(可模糊查询)</label>
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
                    <th>客户名</th>
                    <th>电话/手机</th>
                    <th>email</th>
                    <th>状态</th>
                    <th>留言时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pagination['list'] as $k => $v): ?>
                <tr class="<?php if ($k % 2 == 0): ?>tr_bg<?php endif; ?>">
                    <td><?php echo $v['name']; ?></td>
                    <td><?php echo $v['tel']; ?></td>
                    <td><?php echo $v['email']; ?></td>
                    <td><?php if ($v['finish'] == 'yes'): ?>已读<?php else: ?>未读<?php endif; ?></td>
                    <td><?php echo $v['add_time']; ?></td>
                    <td><a href="javascript:void(0)" onclick="Mui.box.show('<?php echo site_url("message/message/view_message/{$v['id']}"); ?>');" class="btn-list-op">查看</a> <a href="javascript:void(0)" onclick="del(<?php echo $v['id']; ?>);" class="btn-list-op del">删除</a></td>
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
    if (confirm('确定要删除此留言吗？')){
        do_get_op('<?php echo site_url("message/message/del"); ?>', venus.str_to_json('{id: ' + id + '}'));
    }
}
</script>