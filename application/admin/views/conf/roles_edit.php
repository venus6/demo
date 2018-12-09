<div id="dialog" class="dialog" style="width: 800px; height: 500px; ">
    <div class="dialog-head">
        <div class="dialog-title flt"><?php if ($this->router->method == 'add'): ?>添加<?php else: ?>编辑<?php endif; ?>角色</div><a href="javascript:void(0)" class="btn-close frt" onclick="Mui.box.close()" title="关闭"><b>关闭</b></a>
    </div>
    <form id="submit_form" method="post" action="<?php echo current_url(); ?>" onsubmit="return false" >
    <input type="hidden" name="id" value="<?php echo $roles_info['id']; ?>" />
    <div class="dialog-content">
        <fieldset class="box">
            <label class="box" for="name">角色名 <span class="required">*</span></label>
            <input type="text" name="name" id="name" value="<?php echo $roles_info['name']; ?>" class="box" />
            <label class="box" for="">选择权限</label>
            <?php foreach ($priv_list as $k => $v): ?>
            <label class="box ml_5"><?php echo $v['name']; ?></label>
            <?php foreach ($v['second'] as $k2 => $v2): ?>
                <input type="checkbox" name="priv[]" id="priv_id_<?php echo $k; ?>_<?php echo $k2; ?>" value="<?php echo $v2['id']; ?>" <?php if (v_is_substr_in_str($roles_info['priv'], $v2['id'])): ?>checked="checked"<?php endif; ?> class="ml_5" /><label for="priv_id_<?php echo $k; ?>_<?php echo $k2; ?>" class="ml_5"><?php echo $v2['name']; ?></label>
            <?php endforeach; ?>
            <?php endforeach; ?>
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
    if($('#name').val() == ''){
        show_tip_msg(0, '请填写角色名！');
        return ;
    }
    Mui.form.send_form('submit_form');
}
</script>