<?php include_once 'common/header.php';  ?>

<link rel="stylesheet" href="<?php echo $this->config->item('public_url'); ?>js/venus-slider/venus-slider.css" type="text/css" />

<script type="text/javascript" src="<?php echo $this->config->item('public_url'); ?>js/venus-slider/jquery.venus.slider.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#pic_slider').venusSlider({
        pic_width: '960',
        pic_height: '600px',
        pause_time: 3000
    });
});
</script>

<div id="top">
    <div id="logo"></div>
    <div id="pic_slider" class="venus-slider">
        <ul>
            <li><a href="#"><img src="<?php echo $this->config->item('public_url'); ?>img/front/banner_product_1.jpg" alt="MT1000" title="MT1000"/></a></li>
            <li><a href="#"><img src="<?php echo $this->config->item('public_url'); ?>img/front/banner_product_2.jpg" alt="MT1000" title="MT1000"/></a></li>
            <li><a href="#"><img src="<?php echo $this->config->item('public_url'); ?>img/front/banner_product_3.jpg" alt="MT1000" title="MT1000"/></a></li>
        </ul>
        <ol>
            <li class="current"></li>
            <li></li>
            <li></li>
        </ol>
    </div>

    <div id="nav">
        <ul class="parent">
            <li class="parent"><a href="<?php echo $this->config->item('base_url'); ?>" class="parent<?php if ($this->router->class == 'home'): ?> sel<?php endif; ?>">首页</a></li>
            <?php foreach ($this->config->item('view')['menu'] as $k => $v): ?>
            <li class="parent">
                <a href="<?php if ($v['fun_type'] == 'text_page'): echo site_url('view/tp/' . $v['id']); ?><?php elseif ($v['fun_type']=='content_list'): ?><?php echo site_url('view/cl/' . $v['default_content_id']); ?><?php elseif ($v['fun_type']=='type_list'): ?><?php echo site_url('lists/stl/' . $v['default_type_id']); ?><?php elseif ($v['fun_type']=='cover_content_list'): ?><?php echo site_url('lists/stl/' . $v['default_type_id']); ?><?php elseif ($v['fun_type']=='message'): ?><?php echo site_url('message/index/' . $v['id']); ?><?php endif; ?>" class="parent<?php if ($v['id'] == (isset($type_info['id']) ? $type_info['id'] : 0)): ?> sel<?php endif; ?>"><?php echo $v['name']; ?></a>
                <?php if (!empty($v['sub_menu'])): ?>
                <ul>
                <?php foreach ($v['sub_menu'] as $k2 => $v2): ?>
                    <li><a href="<?php echo site_url('lists/stl/' . $v2['id']); ?>"><?php echo $v2['name']; ?></a></li>
                <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php include_once 'common/footer.php';  ?>