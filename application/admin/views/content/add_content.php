<?php include_once VIEWPATH . 'common/header.php';  ?>
<?php include_once VIEWPATH . 'common/lefter.php';  ?>
<?php include_once VIEWPATH . 'common/center_top.php';  ?>

<script type="text/javascript" src="<?php echo $this->config->item('public_url'); ?>js/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#article_content', {
            uploadJson : '<?php echo $this->config->item('public_url'); ?>js/kindeditor/php/upload_json.php',
            fileManagerJson : '<?php echo $this->config->item('public_url'); ?>js/kindeditor/php/file_manager_json.php',
            allowFileManager : true
        });
    });
</script>

<article>
    <div class="title">
        <span class="nav"><a href="<?php echo site_url('content/type/column_list'); ?>">栏目管理</a> > <?php echo $type_info['name']; ?></span>
        <span class="count_info"></span>
    </div>
    <form id="submit_form" method="post" action="<?php echo $form_action; ?>" >
    <input type="hidden" name="type_id" value="<?php echo $type_info['id']; ?>" />
    <input type="hidden" name="title" value="<?php echo $type_info['name']; ?>" />
    <div class="op_block">
        <div class="form_content">
            <textarea name="content" id="article_content" style="width:100%;height:500px;"></textarea>
            <div class="form_foot">
                <div class="btnlist">
                    <a href="javascript:void(0);" onclick="check_form();" class="btn-normal"><b>保存</b></a>
                </div>
            </div>
        </div>
    </div>
    </form>
</article>

<?php include_once VIEWPATH . 'common/footer.php';  ?>

<script type="text/javascript">
function check_form() {
    editor.sync();
    if ($('#article_content').val() == ''){
        show_tip_msg(0, '内容不能为空!');
        return ;
    }
    Mui.form.send_form('submit_form');
}
</script>