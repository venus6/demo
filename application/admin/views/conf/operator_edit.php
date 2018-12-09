<div id="dialog" class="dialog" style="width: 600px; height: 650px; ">
    <div class="dialog-head">
        <div class="dialog-title flt">编辑操作员</div><a href="javascript:void(0)" class="btn-close frt" onclick="Mui.box.close()" title="关闭"><b>关闭</b></a>
    </div>
    <form id="submit_form" method="post" action="<?php echo current_url(); ?>" onsubmit="return false" >
    <input type="hidden" name="id" value="<?php echo $operator_info['id']; ?>" />
    <input type="hidden" name="supper" value="<?php echo $operator_info['supper']; ?>" />
    <div class="dialog-content">
        <fieldset class="box">
            <label class="box">操作员名 <?php echo $operator_info['name']; ?></label>
            <label class="box" for="rname">姓名</label>
            <input type="text" class="box" name="rname" id="rname" value="<?php echo $operator_info['rname']; ?>" />
            <label class="box" for="tel">电话</label>
            <input type="text" class="box" name="tel" id="tel" value="<?php echo $operator_info['tel']; ?>" />
            <label class="box" for="email">Email</label>
            <input type="text" class="box" name="email" id="email" value="<?php echo $operator_info['email']; ?>" />
            <?php if ($operator_info['supper'] == 0): ?>
            <label class="box" for="status">状态</label>
            <select name="status" id="status">
                <option value="1" <?php if ($operator_info['status'] == 1): ?>selected="selected"<?php endif; ?> >启用</option>
                <option value="0" <?php if ($operator_info['status'] == 0): ?>selected="selected"<?php endif; ?> >停用</option>
            </select>
            <label class="box">角色</label>
            <?php foreach ($roles_list as $k => $v): ?>
                <input type="checkbox" name="roles[]" id="roles_id_<?php echo $k; ?>" value="<?php echo $v['id']; ?>" title="<?php echo $v['name']; ?>" class="ml_5" <?php if (v_is_substr_in_str($operator_info['roles'], $v['id'])): ?>checked="checked"<?php endif; ?> /><label for="roles_id_<?php echo $k; ?>" class="ml_5"><?php echo $v['name']; ?></label>
            <?php endforeach; ?>
            <?php endif; ?>
            <label class="box" for="note">备注</label>
            <textarea name="note" id="note" cols="50" rows="2" class="box"><?php echo $operator_info['note']; ?></textarea>
        </fieldset>
    </div>
    <div class="dialog-foot">
        <div class="btnlist">
            <a href="javascript:void(0);" onclick="check_form();" class="btn-normal-box"><b>保存</b></a>
            <a href="javascript:void(0);" onclick="Mui.box.close();" class="btn-normal-box"><b>关闭</b></a>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript">
function check_form() {
    Mui.form.send_form('submit_form');
}
</script>