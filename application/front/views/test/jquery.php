<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>test</title>
        <meta name="description" content="">
        <meta name="keywords" content="">

        <style>
            .focused {
                background: #abcdef;
            }
        </style>

        <script src="<?php echo $this->config->item('public_url'); ?>js/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function () {
                $('body').on('click', '#btn', function(event) {
                    event.preventDefault();
                    $.post({
                        url: '<?php echo site_url("test/jquery_ajax"); ?>',
                        data: {<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>', name: 'venus', age: 30, fav: ['one', 'two']},
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <div id="test" data-tel='13856256588'>我的哈你叫呢长城哈</div>
        <button id="btn">ajax click</button>
        <form>
          <input type="text" name="uname" value="23">
        </form>
    </body>
</html>