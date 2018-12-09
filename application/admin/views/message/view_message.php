<div id="dialog" class="dialog" style="width: 600px; height: 500px; ">
    <div class="dialog-head">
        <div class="dialog-title flt">查看留言内容</div><a href="javascript:void(0)" class="btn-close frt" onclick="Mui.box.close()" title="关闭"><b>关闭</b></a>
    </div>
    <form id="submit_form" method="post" action="<?php echo current_url(); ?>" onsubmit="return false" >
    <div class="dialog-content">
        <fieldset class="note">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <th>客户名</th>
                    <td>
                        <?php echo $message_info['name']; ?>
                    </td>
                </tr>
                <tr>
                    <th>留言内容</th>
                    <td>
                        <?php echo $message_info['content']; ?>
                    </td>
                </tr>
                <tr>
                    <th>电话/手机</th>
                    <td>
                        <?php echo $message_info['tel']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <?php echo $message_info['email']; ?>
                    </td>
                </tr>
                <tr>
                    <th>留言时间</th>
                    <td>
                        <?php echo $message_info['add_time']; ?>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
    <div class="dialog-foot">
        <div class="btnlist">
            <a href="javascript:void(0);" onclick="sign_finish(<?php echo $message_info['id']; ?>);" class="btn-normal-box"><b>标志为已读</b></a>
            <a href="javascript:void(0);" onclick="Mui.box.close();" class="btn-normal-box"><b>关闭</b></a>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript">
function sign_finish(id) {
    do_get_op('<?php echo site_url("message/message/sign_finish"); ?>', venus.str_to_json('{id: ' + id + '}'));
}
</script>