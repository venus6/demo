<div id="sider">
    <h3><?php echo $type_info['name']; ?></h3>
    <ul>
    <?php foreach ($sub_type_list as $k => $v): ?>
        <li><a href="<?php echo site_url('lists/stl/' . $v['id']); ?>" <?php if ($v['id'] == $sub_type_id): ?>class="sel"<?php endif; ?>><?php echo $v['name']; ?></a></li>
    <?php endforeach; ?>
    </ul>
</div>