<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>扬州捷科科技有限公司 - 管理后台</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" href="<?php echo $this->config->item('public_url'); ?>css/reset.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $this->config->item('public_url'); ?>css/main.css" type="text/css" />
    </head>
    <body style="background-color: #252639;">
        <div id="login_div">
            <h1>扬州捷科科技有限公司</h1>
            <?php if ($flag == 1): ?>
            <div class="message">
                <strong>恭喜</strong>，您已成功退出！
            </div>
            <?php elseif ($flag == 2): ?>
            <div class="login_error">
                <strong>错误</strong>：用户名不能为空。
            </div>
            <?php elseif ($flag == 3): ?>
            <div class="login_error">
                <strong>错误</strong>：密码不能为空。
            </div>
            <?php elseif ($flag == 4): ?>
            <div class="login_error">
                <strong>错误</strong>：用户名密码错误。
            </div>
            <?php elseif ($flag == 5): ?>
            <div class="login_error">
                <strong>错误</strong>：操作员帐号已经被停用或被删除，请与管理员联系！
            </div>
            <?php elseif ($flag == 6): ?>
            <div class="login_error">
                <strong>错误</strong>：您所属的角色已被管理员停用，请与管理员联系！
            </div>
            <?php else: ?>
            <?php endif; ?>
            <form method="post" action="<?php echo site_url('passport/login'); ?>" name="login">
            <p>
                用户名 <input type="text" class="" name="name" size="50" />&nbsp;&nbsp;密码 <input type="password" class="" name="pwd" size="50" />
            </p>
            <p>
                <input type="submit" name="submit" value="登录" class="login-btn" />
            </p>
            </form>
        </div>
    </body>
</html>