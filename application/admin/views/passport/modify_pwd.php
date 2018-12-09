<div id="dialog" class="dialog" style="width: 500px; height: 350px; ">
    <div class="dialog-head">
        <div class="dialog-title flt">修改当前登陆者的密码</div><a href="javascript:void(0)" class="btn-close frt" onclick="Mui.box.close()" title="关闭"><b>关闭</b></a>
    </div>
    <form id="submit_form" method="post" action="<?php echo site_url('passport/modify_pwd'); ?>" onsubmit="return false" >
    <div class="dialog-content">
        <fieldset class="box">
            <label class="box" for="o_pwd">原始密码 <span class="required">*</span></label>
            <input type="password" class="box" name="o_pwd" id="o_pwd" />
            <label class="box" for="pwd">新密码 <span class="required">*</span></label>
            <input type="password" class="box" name="pwd" id="pwd"  />
            <label class="box" for="pwd2">再一次输入新密码 <span class="required">*</span></label>
            <input type="password" class="box" name="pwd2" id="pwd2"  />
        </fieldset>
    </div>
    <div class="dialog-foot">
        <div class="btnlist">
            <a href="javascript:void(0);" onclick="check_form();" class="btn-normal-box"><b>保存</b></a>
            <a href="javascript:void(0);" onclick="Mui.box.close();" class="btn-normal-box"><b>关闭</b></a>
        </div>
    </div>
    </form>
    <div class="dialog-resize"></div>
</div>

<script type="text/javascript">
function check_form() {
    if($('#o_pwd').val() == ''){
        show_tip_msg(0, '请填写原始密码！');
        return ;
    }
    if($('#pwd').val() == ''){
        show_tip_msg(0, '请填写新密码！');
        return ;
    }
    if($('#pwd').val() != $('#pwd2').val()){
        show_tip_msg(0, '新密码两次输入不匹配！');
        return ;
    }
    Mui.form.send_form('submit_form');
}
</script>