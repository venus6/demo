<?php include_once 'common/header.php';  ?>
<?php include_once 'common/top.php';  ?>

<article>
    <?php include_once 'common/sider_list.php';  ?>
    <div id="center">
        <h3 class="nav">您的位置 : &nbsp;&nbsp; <a href="<?php echo $this->config->item('base_url'); ?>"><?php echo $this->config->item('view')['seo']['title']; ?></a> > <a href="<?php echo site_url('lists/stl/' . $sub_type_info['id']); ?>"><?php echo $type_info['name']; ?></a> > <a href="<?php echo site_url('lists/stl/' . $sub_type_info['id']); ?>"><?php echo $sub_type_info['name']; ?></a> > <?php echo $content_info['title']; ?></h3>
        <div class="article">
            <h3 class="title2"><span><?php echo $content_info['title']; ?> 文件说明</span><a href="javascript:void(0);" onclick="down_file(<?php echo $content_info['id']; ?>);" class="down_file btn-down"><b>下载文件</b></a></h3>
            <h4 class="file_info">更新日期：<?php echo $content_info['update_time']; ?>&nbsp;&nbsp;&nbsp;&nbsp;下载量：<?php echo $content_info['download_count']; ?></h4>
            <div class="content"><?php echo $content_info['content']; ?></div>
        </div>
    </div>
    <div class="clear_both"></div>
</article>

<?php include_once 'common/footer.php';  ?>

<script type="text/javascript">
function down_file(id) {
    window.open("<?php echo $content_info['file_url']; ?>");
}
</script>