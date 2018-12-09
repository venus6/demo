<div id="center">
    <header>
        <nav>
            <ul>
            <?php foreach ($this->config->item('menu_arr')['menu_top'] as $k => $v): ?>
                <li><a href="<?php echo site_url($v['left'][0]['module']); ?>" class="padding_l_10 <?php if (isset($this->config->item('menu_arr')['menu_top_id']) && $v['id'] == $this->config->item('menu_arr')['menu_top_id']): ?>selected<?php endif; ?>"><?php echo $v['name']; ?></a></li>
            <?php endforeach; ?>
            </ul>
        </nav>
        <div class="user_info">
            <ul>
                <li><a href="<?php echo site_url('home'); ?>" class="padding_l_10">桌面</a></li>
                <li><a href="javascript:void(0)" class="padding_l_10" onclick="Mui.box.show('<?php echo site_url('passport/modify_pwd'); ?>');" title="点击修改密码">当前用户: <b><?php echo $this->config->item('auth_user_info')['name']; ?></b></a></li>
                <li><a href="<?php echo site_url('passport/logout'); ?>" title="退出" class="padding_l_10 bg_red logout">退出</a></li>
            </ul>
        </div>
        <div class="cl"></div>
    </header>