<?php include_once VIEWPATH . 'common/header.php';  ?>
<?php include_once VIEWPATH . 'common/lefter.php';  ?>
<?php include_once VIEWPATH . 'common/center_top.php';  ?>

<article>
    <div class="title">
        <span class="nav">SEO配置</span>
        <span class="count_info"></span>
    </div>
    <form id="submit_form" method="post" action="<?php echo site_url('conf/conf/seo_conf'); ?>" >
    <div class="op_block">
        <div class="form_content">
            <label class="box" for="title">标题</label>
            <input type="text" class="box" name="title" id="title" value="<?php echo $seo_info['title']; ?>" />
            <label class="box" for="key">关键字</label>
            <input type="text" class="box" name="key" id="key" value="<?php echo $seo_info['key']; ?>" />
            <label class="box" for="desc">描述</label>
            <input type="text" class="box" name="desc" id="desc" value="<?php echo $seo_info['desc']; ?>" />
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
    Mui.form.send_form('submit_form');
}
</script>