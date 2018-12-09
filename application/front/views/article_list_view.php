<?php include_once 'common/header.php';  ?>
<?php include_once 'common/top.php';  ?>

<article>
    <?php include_once 'common/sider_list.php';  ?>
    <div id="center">
        <h3 class="nav">您的位置 : &nbsp;&nbsp; <a href="<?php echo $this->config->item('base_url'); ?>"><?php echo $this->config->item('view')['seo']['title']; ?></a> > <a href="<?php echo site_url('lists/stl/' . $sub_type_info['id']); ?>"><?php echo $type_info['name']; ?></a> > <a href="<?php echo site_url('lists/stl/' . $sub_type_info['id']); ?>"><?php echo $sub_type_info['name']; ?></a> > <?php echo $content_info['title']; ?></h3>
        <div class="article">
            <h1 class="title"><?php echo $content_info['title']; ?></h1>
            <h1 class="sub_title"><?php echo v_datetime2date($content_info['add_time'], 'Y-m-d'); ?></h1>
            <div class="content"><?php echo $content_info['content']; ?></div>
        </div>
    </div>
    <div class="clear_both"></div>
</article>

<?php include_once 'common/footer.php';  ?>