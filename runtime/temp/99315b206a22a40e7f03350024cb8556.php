<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"D:\wwwroot\xszzglzx\wwwroot/app/admin\view\index\iframe.php";i:1538657144;s:57:"D:\wwwroot\xszzglzx\wwwroot\app\admin\view\block\menu.php";i:1538657140;s:58:"D:\wwwroot\xszzglzx\wwwroot\app\admin\view\block\layui.php";i:1538657140;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title>管理控制台</title>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link rel="stylesheet" href="/static/admin/js/layui/css/layui.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/admin/css/theme.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/admin/css/style.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/fonts/typicons/min.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/fonts/font-awesome/min.css?v=<?php echo config('hisiphp.version'); ?>">
    <style type="text/css">
        .hs-iframe{width:100%;height:100%;}
        .layui-tab{position:absolute;left:0;top:0;height:100%;width:100%;z-index:10;margin:0;border:none;overflow:hidden;}
        .layui-tab-content{padding:0 0 0 10px;height:100%;}
        .layui-tab-item{height:100%;}
        .footer{position:fixed;left:0;bottom:0;z-index:998;}
    </style>
</head>
<body class="hisi-theme-<?php echo cookie('hisi_admin_theme'); ?>">
<?php 
$ca = strtolower(request()->controller().'/'.request()->action());
 ?>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header" style="z-index:999!important;">
    <div class="fl header-logo">管理控制台</div>
    <div class="fl header-fold"><a href="javascript:;" title="打开/关闭左侧导航" class="aicon ai-caidan" id="foldSwitch"></a></div>
    <ul class="layui-nav fl nobg main-nav">
        <?php if(is_array($_admin_menu) || $_admin_menu instanceof \think\Collection || $_admin_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $_admin_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(($_admin_menu_parents['pid'] == $vo['id'] and $ca != 'plugins/run') or ($ca == 'plugins/run' and $vo['id'] == 3)): ?>
           <li class="layui-nav-item layui-this">
            <?php else: ?>
            <li class="layui-nav-item">
            <?php endif; ?> 
            <a href="javascript:;"><?php echo $vo['title']; ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <ul class="layui-nav fr nobg head-info">
        <li class="layui-nav-item"><a href="/" target="_blank" class="aicon ai-ai-home" title="前台"></a></li>
        <li class="layui-nav-item"><a href="<?php echo url('admin/index/clear'); ?>" class="j-ajax aicon ai-qingchu" refresh="yes" title="清缓存"></a></li>
        <li class="layui-nav-item"><a href="javascript:void(0);" class="aicon ai-suo" id="lockScreen" title="锁屏"></a></li>
        <li class="layui-nav-item">
            <a href="<?php echo url('admin/user/setTheme'); ?>" id="admin-theme-setting" class="aicon ai-theme"></a>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:void(0);"><?php echo $admin_user['nick']; ?>&nbsp;&nbsp;</a>
            <dl class="layui-nav-child">
                <dd><a data-id="00" class="admin-nav-item top-nav-item" href="<?php echo url('admin/user/info'); ?>">个人设置</a></dd>
                <dd><a href="<?php echo url('admin/user/iframe'); ?>" class="j-ajax" refresh="yes"><?php echo input('cookie.hisi_iframe') ? '单页布局' : '框架布局'; ?></a></dd>
                <?php if(is_array($languages) || $languages instanceof \think\Collection || $languages instanceof \think\Paginator): $i = 0; $__LIST__ = $languages;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pack']): ?>
                    <dd><a href="<?php echo url('admin/index/index'); ?>?lang=<?php echo $vo['code']; ?>"><?php echo $vo['name']; ?></a></dd>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                <dd><a data-id="000" class="admin-nav-item top-nav-item" href="<?php echo url('admin/language/index'); ?>">语言包管理</a></dd>
                <dd><a href="<?php echo url('admin/publics/logout'); ?>">退出登陆</a></dd>
            </dl>
        </li>
    </ul>
</div>
<div class="layui-side layui-bg-black" id="switchNav">
    <div class="layui-side-scroll">
        <?php if(is_array($_admin_menu) || $_admin_menu instanceof \think\Collection || $_admin_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $_admin_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if(($_admin_menu_parents['pid'] == $v['id'] and $ca != 'plugins/run') or ($ca == 'plugins/run' and $v['id'] == 3)): ?>
        <ul class="layui-nav layui-nav-tree">
        <?php else: ?>
        <ul class="layui-nav layui-nav-tree" style="display:none;">
        <?php endif; if(is_array($v['childs']) || $v['childs'] instanceof \think\Collection || $v['childs'] instanceof \think\Paginator): $kk = 0; $__LIST__ = $v['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?>
            <li class="layui-nav-item <?php if($kk == 1): ?>layui-nav-itemed<?php endif; ?>">
                <a href="javascript:;"><i class="<?php echo $vv['icon']; ?>"></i><?php echo $vv['title']; ?><span class="layui-nav-more"></span></a>
                <dl class="layui-nav-child">
                    <?php if($vv['title'] == '快捷菜单'): ?>
                        <dd><a class="admin-nav-item" data-id="0" href="<?php echo input('cookie.hisi_iframe') ? url('admin/index/welcome') : url('admin/index/index'); ?>"><i class="aicon ai-shouye"></i> 后台首页</a></dd>
                        <?php if(is_array($vv['childs']) || $vv['childs'] instanceof \think\Collection || $vv['childs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vv['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($i % 2 );++$i;?>
                        <dd><a class="admin-nav-item" data-id="<?php echo $vvv['id']; ?>" href="<?php if(strpos('http', $vvv['url']) === false): ?><?php echo url($vvv['url'], $vvv['param']); else: ?><?php echo $vvv['url']; endif; ?>"><?php if(file_exists('.'.$vvv['icon'])): ?><img src="<?php echo $vvv['icon']; ?>" width="16" height="16" /><?php else: ?><i class="<?php echo $vvv['icon']; ?>"></i><?php endif; ?> <?php echo $vvv['title']; ?></a><i data-href="<?php echo url('menu/del?ids='.$vvv['id']); ?>" class="layui-icon j-del-menu">&#xe640;</i></dd>
                        <?php endforeach; endif; else: echo "" ;endif; else: if(is_array($vv['childs']) || $vv['childs'] instanceof \think\Collection || $vv['childs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vv['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($i % 2 );++$i;?>
                        <dd><a class="admin-nav-item" data-id="<?php echo $vvv['id']; ?>" href="<?php if(strpos('http', $vvv['url']) === false): ?><?php echo url($vvv['url'], $vvv['param']); else: ?><?php echo $vvv['url']; endif; ?>"><?php if(file_exists('.'.$vvv['icon'])): ?><img src="<?php echo $vvv['icon']; ?>" width="16" height="16" /><?php else: ?><i class="<?php echo $vvv['icon']; ?>"></i><?php endif; ?> <?php echo $vvv['title']; ?></a></dd>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </dl>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<script type="text/html" id="hisi-theme-tpl">
    <ul class="hisi-themes">
        <?php $_result=session('hisi_admin_themes');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li data-theme="<?php echo $vo; ?>" class="hisi-theme-item-<?php echo $vo; ?>"></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</script>
    <div class="layui-body" id="switchBody" >
        <div class="layui-tab layui-tab-card" lay-filter="hisiTab" lay-allowClose="true">
            <ul class="layui-tab-title">
                <li lay-id="0" class="layui-this">后台首页</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe lay-id="0" src="<?php echo url('index/welcome'); ?>" width="100%" height="100%" frameborder="0" scrolling="yes" class="hs-iframe"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="layui-footer footer">
        <span class="fl">Powered by <a href="<?php echo config('hisiphp.url'); ?>" target="_blank"></a></span>
        <span class="fr"> © 2017-2018 <a href="<?php echo config('hisiphp.url'); ?>" target="_blank"></a></span>
    </div>-->
</div>
<script src="/static/admin/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo $_SERVER['SCRIPT_NAME']; ?>";
    layui.config({
        base: '/static/admin/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script type="text/javascript">
    layui.use(['jquery', 'element', 'layer'], function() {
        var $ = layui.jquery, element = layui.element, layer = layui.layer;
        $('.layui-tab-content').height($(window).height() - 145);
        var tab = {
                add: function(title, url, id) {
                    element.tabAdd('hisiTab', {
                        title: '<i class="layui-icon j-ajax" data-href="<?php echo url('admin/menu/quick'); ?>?id='+id+'">&#xe600;&nbsp;</i>'+title,
                        content: '<iframe width="100%" height="100%" lay-id="'+id+'" frameborder="0" src="'+url+'" scrolling="yes" class="x-iframe"></iframe>',
                        id: id
                    });
                }, change: function(id) {
                  element.tabChange('hisiTab', id);
                }
            };
        $('.admin-nav-item').click(function(event) {
            var that = $(this);
            if ($('iframe[src="'+that.attr('href')+'"]')[0]) {
                tab.change(that.attr('data-id'));
                event.stopPropagation();
                return false;
            }
            
            if (!that.hasClass('top-nav-item')) {
                that.css({color:'#fff'});
            }
            tab.add(that.text(), that.attr('href'), that.attr('data-id'));
            tab.change(that.attr('data-id'));
            event.stopPropagation();
            return false;
        });

        $(document).on('click', '.layui-tab-close', function() {
            $('.layui-nav-child a[data-id="'+$(this).parent('li').attr('lay-id')+'"]').css({color:'rgba(255,255,255,.7)'});
        });
    });
</script>
</body>
</html>