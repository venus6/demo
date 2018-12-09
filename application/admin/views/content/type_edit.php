<div id="dialog" class="dialog" style="width: 500px; height: 400px; ">
    <div class="dialog-head">
        <div class="dialog-title flt">编辑子类别</div><a href="javascript:void(0)" class="btn-close frt" onclick="Mui.box.close()" title="关闭"><b>关闭</b></a>
    </div>
    <form id="submit_form" method="post" action="<?php echo current_url(); ?>" onsubmit="return false" >
    <input type="hidden" name="id" value="<?php echo $type_info['id']; ?>" />
    <div class="dialog-content">
        <fieldset class="box">
            <label class="box" for="name">类别名 <span class="required">*</span></label>
            <input type="text" name="name" id="name" class="box" value="<?php echo $type_info['name']; ?>" />
            <label class="box" for="fun_type">功能类别</label>
            <select name="fun_type" id="fun_type">
            <?php foreach ($fun_type_list as $k => $v): ?>
                <option value="<?php echo $k; ?>" <?php if ($type_info['fun_type'] == $k): ?>selected="selected"<?php endif; ?>><?php echo $v; ?></option>
            <?php endforeach; ?>
            </select>
            <label class="box" for="">前台显示</label>
            <input type="radio" name="display" id="display_show" value="show" <?php if ($type_info['display'] == 'show'): ?>checked="checked"<?php endif; ?> />
            <label for="display_show">是</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="display" id="display_hide" value="hide" <?php if ($type_info['display'] == 'hide'): ?>checked="checked"<?php endif; ?> /><label for="display_hide">否</label>
            <label class="box" for="sort">排序</label>
            <input type="text" name="sort" id="sort" class="box only_num" value="<?php echo $type_info['sort']; ?>" />
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
        show_tip_msg(0, '请填写类别名！');
        return ;
    }
    if ($('#sort').val() == ''){
        show_tip_msg(0, '排序不能为空!');
        return ;
    }
    Mui.form.send_form('submit_form');
}
</script>