<?php include_once 'common/header.php';  ?>
<?php include_once 'common/top.php';  ?>

<article>
    <?php include_once 'common/sider_list.php';  ?>
    <div id="center">
        <h3 class="nav">您的位置 : &nbsp;&nbsp; <a href="<?php echo $this->config->item('base_url'); ?>"><?php echo $this->config->item('view')['seo']['title']; ?></a> > <a href="<?php echo site_url('lists/stl/' . $sub_type_info['id']); ?>"><?php echo $type_info['name']; ?></a> > <a href=""><?php echo $sub_type_info['name']; ?></a></h3>
        <div class="cover_list">
            <ul>
            <?php foreach ($pagination['list'] as $k => $v): ?>
                <li><a href="<?php echo site_url('view/lv/' . $v['id']); ?>" class="cover"><img src="<?php echo $v['cover']; ?>" width="210" height="395"  /></a><a href="<?php echo site_url('view/lv/' . $v['id']); ?>" class="title"><?php echo $v['title']; ?></a></li>
            <?php endforeach; ?>
            </ul>
        </div>
        <div class="clear_both"></div>
        <?php echo $pagination['show']; ?>
    </div>
    <div class="clear_both"></div>
</article>

<?php include_once 'common/footer.php';  ?>