<div id="dialog" class="dialog" style="width: 600px; height: 650px; ">
    <div class="dialog-head">
        <div class="dialog-title flt">添加操作员</div><a href="javascript:void(0)" class="btn-close frt" onclick="Mui.box.close()" title="关闭"><b>关闭</b></a>
    </div>
    <form id="submit_form" method="post" action="<?php echo current_url(); ?>" onsubmit="return false" >
    <div class="dialog-content">
        <fieldset class="box">
            <label class="box" for="name">操作员名 <span class="required">*</span></label>
            <input type="text" class="box" name="name" id="name" />
            <label class="box" for="pwd">密码 <span class="required">*</span></label>
            <input type="password" class="box" name="pwd" id="pwd"  />
            <label class="box" for="pwd2">再一次输入密码</label>
            <input type="password" class="box" name="pwd2" id="pwd2"  />
            <label class="box" for="rname">姓名</label>
            <input type="text" class="box" name="rname" id="rname" />
            <label class="box" for="tel">电话</label>
            <input type="text" class="box" name="tel" id="tel" />
            <label class="box" for="email">Email</label>
            <input type="text" class="box" name="email" id="email" />
            <label class="box" for="status">状态</label>
            <select name="status" id="status">
                <option value="1" selected="selected">启用</option>
                <option value="0">停用</option>
            </select>
            <label class="box">角色</label>
            <?php foreach ($roles_list as $k => $v): ?>
                <input type="checkbox" name="roles[]" id="roles_id_<?php echo $k; ?>" value="<?php echo $v['id']; ?>" title="<?php echo $v['name']; ?>" class="ml_5" /><label for="roles_id_<?php echo $k; ?>" class="ml_5"><?php echo $v['name']; ?></label>
            <?php endforeach; ?>
            <label class="box" for="note">备注</label>
            <textarea name="note" id="note" cols="50" rows="2" class="box"></textarea>
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
        show_tip_msg(0, '请填写操作员名！');
        return ;
    }
    if($('#pwd').val() == ''){
        show_tip_msg(0, '请填写密码！');
        return ;
    }
    if($('#pwd').val() != $('#pwd2').val()){
        show_tip_msg(0, '密码两次输入不匹配！');
        return ;
    }
    Mui.form.send_form('submit_form');
}
</script>