<div id="sider">
    <h3><?php echo $type_info['name']; ?></h3>
    <ul>
    <?php foreach ($content_list as $k => $v): ?>
        <li><a href="<?php echo site_url('view/cl/' . $v['id']); ?>" <?php if ($v['id'] == $content_info['id']): ?>class="sel"<?php endif; ?>><?php echo $v['title']; ?></a></li>
    <?php endforeach; ?>
    </ul>
</div>