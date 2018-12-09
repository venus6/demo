<div id="dialog" class="dialog" style="width: 500px; height: 500px; ">
    <div class="dialog-head">
        <div class="dialog-title flt"><?php if ($this->router->method == 'add'): ?>添加<?php else: ?>编辑<?php endif; ?>模块</div><a href="javascript:void(0)" class="btn-close frt" onclick="Mui.box.close()" title="关闭"><b>关闭</b></a>
    </div>
    <form id="submit_form" method="post" action="<?php echo current_url(); ?>" onsubmit="return false" >
    <div class="dialog-content">
        <fieldset class="box">
            <label class="box" for="name">菜单名 <span class="required">*</span></label>
            <input type="text" name="name" id="name" class="box" />
            <label class="box" for="module">模块值</label>
            <input type="text" name="module" id="module" class="box" />
            <label class="box" for="p_id">父菜单</label>
            <select name="p_id" id="p_id">
                <option value="0">--顶级菜单--</option>
            <?php foreach ($menu_list as $k => $v): ?>
                <optgroup label="<?php echo $v['name']; ?>">
                    <option value="<?php echo $v['id']; ?>">二级菜单</option>
                <?php foreach ($v['child'] as $k2 => $v2): ?>
                    <option value="<?php echo $v2['id']; ?>"><?php echo $v2['name']; ?></option>
                <?php endforeach; ?>
                </optgroup>
            <?php endforeach; ?>
            </select>
            <label class="box" for="display">显示</label>
            <select name="display" id="display">
                <option value="1">是</option>
                <option value="0">否</option>
            </select>
            <label class="box" for="">新建标签页</label>
            <label for="blank_page_1">是</label>
            <input type="radio" name="blank_page" id="blank_page_1" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="blank_page_0">否</label>
            <input type="radio" name="blank_page" id="blank_page_0" value="0" checked="checked" />
            <label class="box" for="orders">排序</label>
            <input type="text" name="orders" id="orders" value="1" class="box" />
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
        show_tip_msg(0, '请填写菜单名！');
        return ;
    }
    Mui.form.send_form('submit_form');
}
</script>