<?php include_once 'common/header.php';  ?>
<?php include_once 'common/top.php';  ?>

<article>
    <div id="center" class="center_one">
        <h3 class="nav">您的位置 : &nbsp;&nbsp; <a href="<?php echo $this->config->item('base_url'); ?>"><?php echo $this->config->item('view')['seo']['title']; ?></a> > <a href=""><?php echo $content_info['title']; ?></a></h3>
        <div class="article">
            <div class="content"><?php echo $content_info['content']; ?></div>
        </div>
    </div>
    <div class="clear_both"></div>
</article>

<?php include_once 'common/footer.php';  ?>