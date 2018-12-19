<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>test</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link rel="stylesheet" href="<?php echo $this->config->item('public_url'); ?>layui/css/layui.css">
    </head>
    <body>
        <script src="<?php echo $this->config->item('public_url'); ?>layui/layui.js"></script>
        <script>
            /*layui.use(['layer', 'form'], function() {
                var layer = layui.layer;
                var form = layui.form;

                layer.msg('Hello venus');
            });*/
            var device = layui.device();
            console.log(device);
        </script>
    </body>
</html>