<div id="dialog" class="dialog" style="width: 500px; height: 400px; ">
    <div class="dialog-head">
        <div class="dialog-title flt"><?php if ($this->router->method == 'add_column'): ?>添加<?php else: ?>编辑<?php endif; ?>栏目</div><a href="javascript:void(0)" class="btn-close frt" onclick="Mui.box.close()" title="关闭"><b>关闭</b></a>
    </div>
    <form id="submit_form" method="post" action="<?php echo current_url(); ?>" onsubmit="return false" >
    <div class="dialog-content">
        <fieldset class="box">
            <label class="box" for="name">栏目名 <span class="required">*</span></label>
            <input type="text" name="name" id="name" class="box" />
            <label class="box" for="fun_type">功能类别</label>
            <select name="fun_type" id="fun_type">
            <?php foreach ($fun_type_list as $k => $v): ?>
                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
            <?php endforeach; ?>
            </select>
            <label class="box" for="">前台显示</label>
            <input type="radio" name="display" id="display_show" value="show" checked="checked" />
            <label for="display_show">是</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="display" id="display_hide" value="hide" /><label for="display_hide">否</label>
            <label class="box" for="sort">排序</label>
            <input type="text" name="sort" id="sort" class="box only_num" />
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
        show_tip_msg(0, '请填写栏目名！');
        return ;
    }
    Mui.form.send_form('submit_form');
}
</script>