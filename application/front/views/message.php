<?php include_once 'common/header.php';  ?>
<?php include_once 'common/top.php';  ?>

<article>
    <div id="center" class="center_one">
        <h3 class="nav">您的位置 : &nbsp;&nbsp; <a href="<?php echo $this->config->item('base_url'); ?>"><?php echo $this->config->item('view')['seo']['title']; ?></a> > <?php echo $type_info['name']; ?></h3>
        <div class="message">
            <form id="submit_form" method="post" action="" >
                <label class="form_title" for="name">客户名/联系人 <span class="required">*</span></label>
                <input type="text" name="name" id="name" size="50" maxlength="50" value="venus" />
                <label class="form_title" for="tel">手机/电话 <span class="required">*</span></label>
                <input type="text" name="tel" id="tel" size="50" maxlength="50" value="15986562233" />
                <label class="form_title" for="email">Email</label>
                <input type="text" name="email" id="email" size="50" maxlength="100" />
                <label class="form_title" for="content">您对我们的留言 <span class="required">*</span></label>
                <textarea name="content" id="content" cols="100" rows="10"></textarea>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                <div class="btnlist">
                    <a href="javascript:void(0);" onclick="check_form();" class="btn-normal"><b>保存</b></a>
                </div>
            </form>
        </div>
    </div>
    <div class="clear_both"></div>
</article>

<?php include_once 'common/footer.php';  ?>

<script type="text/javascript">
function check_form() {
    if ($('#name').val() == ''){
        show_tip_msg(0, '请填写客户名/联系人!');
        return ;
    }
    if ($('#tel').val() == ''){
        show_tip_msg(0, '请填写手机/电话!');
        return ;
    }
    if ($('#content').val() == ''){
        show_tip_msg(0, '请填写留言!');
        return ;
    }
    Mui.form.send_form('submit_form');
}
</script>