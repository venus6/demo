<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>test</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link rel="stylesheet" href="<?php echo $this->config->item('public_url'); ?>layui/css/layui.css">

        <script src="<?php echo $this->config->item('public_url'); ?>js/jquery-3.3.1.min.js"></script>
        <script src="<?php echo $this->config->item('public_url'); ?>layui/layui.js"></script>
        <script>
            $(document).ready(function() {
                alert(12)
            });
        </script>
    </head>
    <body>
        <button id="test" class="layui-btn">一个标准的按钮</button>
    </body>
</html>