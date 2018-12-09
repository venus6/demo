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

        K('#sel_img').click(function() {
            editor.loadPlugin('image', function() {
                editor.plugin.imageDialog({
                    showRemote : false,
                    imageUrl : K('#img_url').val(),
                    clickFn : function(url, title, width, height, border, align) {
                        K('#img_url').val(url);
                        K('#cover_pre').attr('src', url);
                        editor.hideDialog();
                    }
                });
            });
        });

        K('#filemanager').click(function() {
            editor.loadPlugin('filemanager', function() {
                editor.plugin.filemanagerDialog({
                    viewType : 'VIEW',
                    dirName : 'image',
                    clickFn : function(url, title) {
                        K('#img_url').val(url);
                        K('#cover_pre').attr('src', url);
                        editor.hideDialog();
                    }
                });
            });
        });
    });
</script>

<article>
    <div class="title">
        <span class="nav"><a href="<?php echo site_url('content/type/column_list'); ?>">栏目管理</a><?php if (isset($p_type_info)): ?> &gt; <a href="<?php echo site_url('content/type/into_column/' . $p_type_info['id']); ?>"><?php echo $p_type_info['name']; ?></a><?php endif; ?> &gt; <a href="<?php echo site_url('content/type/into_column/' . $type_info['id']); ?>"><?php echo $type_info['name']; ?></a> &gt; 添加内容</span>
        <span class="count_info"></span>
    </div>
    <form id="submit_form" method="post" action="<?php echo site_url('content/type/do_add_content'); ?>" >
    <input type="hidden" name="type_id" value="<?php echo $type_info['id']; ?>" />
    <div class="op_block">
        <div class="form_content">
            <label class="box" for="title">标题 <span class="required">*</span></label>
            <input type="text" class="box" name="title" id="title" />
            <label class="box" for="article_content">内容</label>
            <textarea name="content" id="article_content" style="width:100%;height:500px;"></textarea>
            <label class="box" for="sel_img">封面 <span class="required">图片大小不能超过1MB</span></label>
            <a href="javascript:void(0)" id="sel_img" class="btn-normal"><b>选择图片</b></a> <a href="javascript:void(0)" id="filemanager" class="btn-normal"><b>从已上传图片中选择</b></a>
            <input id="img_url" name="cover" type="hidden" />
            <label class="box" for="cover_pre">封面预览</label>
            <img id="cover_pre" src="<?php echo $this->config->item('public_url'); ?>img/nopicture.jpg" />
            <label class="box" for="sort">排序 <span class="required">*</span></label>
            <input type="text" class="box only_num" name="sort" id="sort" value="1" />
            <div class="form_foot">
                <div class="btnlist">
                    <a href="javascript:void(0);" onclick="check_form();" class="btn-normal-box"><b>保存</b></a>
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
    if ($('#title').val() == ''){
        show_tip_msg(0, '标题不能为空!');
        return ;
    }
    if ($('#article_content').val() == ''){
        show_tip_msg(0, '内容不能为空!');
        return ;
    }
    if ($('#sort').val() == ''){
        show_tip_msg(0, '排序不能为空!');
        return ;
    }
    Mui.form.send_form('submit_form');
}
</script>