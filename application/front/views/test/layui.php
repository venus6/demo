<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>test</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link rel="stylesheet" href="<?php echo $this->config->item('public_url'); ?>layui/css/layui.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('public_url'); ?>css/demo.css">

        <script src="<?php echo $this->config->item('public_url'); ?>layui/layui.js"></script>
        <script>
            layui.use(['form', 'layer'], function() {
                var form = layui.form;
                var layer = layui.layer;

                layer.open({
                    type: 0,
                    title: ['title', 'color: red;'],
                    content: '内容',
                    skin: 'layui-layer-lan'
                });

                form.on('submit(formDemo)', function(data) {
                    layer.msg(JSON.stringify(data.field));
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label for="" class="layui-form-label">输入框</label>
                <div class="layui-input-block">
                    <input type="text" name="title" required lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码框</label>
                <div class="layui-input-inline">
                  <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux" id="de">辅助文字</div>
              </div>
        </form>



    </body>
</html>