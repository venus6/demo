<div id="lefter-out">
    <div id="lefter">
        <div class="logo">
            <a href="<?php echo $this->config->item('base_url'); ?>" title="回到前台" target="_blank"><b>回到前台</b></a>
        </div>
        <?php if ($this->router->directory == '' && $this->router->class == 'home' && $this->router->method == 'index'): ?>
        <div class="notice_block">
            <h1>您上次登陆时间</h1>
            <div class="notice_list">
                <ul>
                    <li><?php echo $this->config->item('auth_user_info')['update_time']; ?></li>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($this->router->directory != ''): ?>
        <div class="group">
            <div class="child_list">
                <ul>
                <?php foreach ($this->config->item('menu_arr')['menu_left'] as $k => $v): ?>
                    <li class="group"><?php echo $v['group']['name']; ?></li>
                    <?php foreach ($v['child'] as $k2 => $v2): ?>
                        <?php if ($v2['display'] == '0'): else: ?>
                        <li><a href="<?php echo site_url($v2['module']); ?>" <?php if ($v2['module'] == $this->config->item('menu_arr')['menu_left_module']): ?>class="selected"<?php else: endif; ?> <?php if ($v2['blank_page'] == '1'): ?>target="_blank"<?php else: endif; ?>><b><?php echo $v2['name']; ?></b></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>