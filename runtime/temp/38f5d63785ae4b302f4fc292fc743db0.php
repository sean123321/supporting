<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"/var/www/html/wwwroot/app/admin/view/publics/index.php";i:1538657167;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title>后台管理登陆</title>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link rel="stylesheet" href="/wwwroot/static/admin/js/layui/css/layui.css">
    <style type="text/css">
        body{background-color:#f5f5f5;}
        .login-head{position:fixed;left:0;top:0;width:80%;height:60px;line-height:60px;background:#000;padding:0 10%;}
        .login-head h1{color:#fff;font-size:20px;font-weight:600}
        .login-box{margin:240px auto 0;width:400px;background-color:#fff;padding:15px 30px;border-radius:10px;box-shadow: 5px 5px 15px #999;}
        .login-box .layui-input{font-size:15px;font-weight:400}
        .login-box input[name="password"]{letter-spacing:5px;font-weight:800}
        .login-box .layui-btn{width:100%;}
        .login-box .copyright{text-align:center;height:50px;line-height:50px;font-size:12px;color:#ccc}
        .login-box .copyright a{color:#ccc;}
    </style>
</head>
<body>
<div class="login-head">
    <h1><?php echo config('base.site_name'); ?></h1>
</div>
<div class="login-box">
    <form action="<?php echo url(); ?>" method="post" class="layui-form layui-form-pane">
        <fieldset class="layui-elem-field layui-field-title">
            <legend>管理后台登陆</legend>
        </fieldset>
        <div class="layui-form-item">
            <label class="layui-form-label">登陆账号</label>
            <div class="layui-input-block">
                <input type="text" name="username" class="layui-input" lay-verify="required" placeholder="请输入登陆账号" autofocus="autofocus" value="">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">登陆密码</label>
            <div class="layui-input-block">
                <input type="password" name="password" class="layui-input" lay-verify="required" placeholder="******" value="">
            </div>
        </div>
<!--         <div class="layui-form-item">
            <label class="layui-form-label">安全验证</label>
            <div class="layui-input-inline">
                <input type="text" name="code" class="layui-input">
            </div>
        </div> -->
        <?php echo token('__token__', 'sha1'); ?>
        <input type="submit" value="登陆" lay-submit="" lay-filter="formLogin" class="layui-btn">
    </form>

</div>
<script src="/wwwroot/static/admin/js/layui/layui.js"></script>
<script>
layui.config({
  base: '/wwwroot/static/admin/js/'
}).use('global');
</script>
<script type="text/javascript">
layui.define('form', function(exports) {
    var $ = layui.jquery, layer = layui.layer, form = layui.form;
    form.on('submit(formLogin)', function(data) {
        var _form = $(this).parents('form');
        layer.msg('数据提交中...',{time:500000});
        $.ajax({
            type: "POST",
            url: _form.attr('action'),
            data: _form.serialize(),
            success: function(res) {
                layer.msg(res.msg, {},function() {
                    if (res.code == 1) {
                        if (typeof(res.url) != 'undefined' && res.url != null && res.url != '') {
                            location.href = res.url;
                        } else {
                            location.reload();
                        }
                    } else {
                        location.reload();
                    }
                });
            }
        });
        return false;
    });
});
</script>
</body>
</html>