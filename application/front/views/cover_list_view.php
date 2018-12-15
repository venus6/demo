<?php include_once 'common/header.php';  ?>
<?php include_once 'common/top.php';  ?>

<article>
    <?php include_once 'common/sider_list.php';  ?>
    <div id="center">
        <h3 class="nav">您的位置 : &nbsp;&nbsp; <a href="<?php echo $this->config->item('base_url'); ?>"><?php echo $this->config->item('view')['seo']['title']; ?></a> > <a href="<?php echo site_url('lists/stl/' . $sub_type_info['id']); ?>"><?php echo $type_info['name']; ?></a> > <a href="<?php echo site_url('lists/stl/' . $sub_type_info['id']); ?>"><?php echo $sub_type_info['name']; ?></a> > <?php echo $content_info['title']; ?></h3>
        <div class="article">
            <div class="cover"><img src="<?php echo $content_info['cover']; ?>"  /></div>
            <h3 class="title2"><?php echo $content_info['title']; ?> 详细介绍</h3>
            <div class="content"><?php echo $content_info['content']; ?></div>
        </div>
    </div>
    <div class="clear_both"></div>
</article>

<?php include_once 'common/footer.php';  ?>