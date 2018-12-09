<div id="dialog" class="dialog" style="width: 500px; height: 400px; ">
    <div class="dialog-head">
        <div class="dialog-title flt">添加友情链接</div><a href="javascript:void(0)" class="btn-close frt" onclick="Mui.box.close()" title="关闭"><b>关闭</b></a>
    </div>
    <form id="submit_form" method="post" action="<?php echo current_url(); ?>" onsubmit="return false" >
    <input type="hidden" name="type_id" value="<?php echo $type_id; ?>" />
    <div class="dialog-content">
        <fieldset class="box">
            <label class="box" for="title">名称 <span class="required">*</span></label>
            <input type="text" name="title" id="title" class="box" />
            <label class="box" for="url_link">链接 <span class="required">*</span></label>
            <input type="text" name="url_link" id="url_link" value="http://" class="box" />
            <label class="box" for="sort">排序  <span class="required">*</span></label>
            <input type="text" name="sort" id="sort" value="1" class="box only_num" />
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
    if($('#title').val() == ''){
        show_tip_msg(0, '请填写名称！');
        return ;
    }
    if($('#url_link').val() == ''){
        show_tip_msg(0, '请填写链接！');
        return ;
    }
    if ($('#sort').val() == ''){
        show_tip_msg(0, '排序不能为空!');
        return ;
    }
    Mui.form.send_form('submit_form');
}
</script>