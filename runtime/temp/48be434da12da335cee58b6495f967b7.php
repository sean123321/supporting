<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:60:"/var/www/html/wwwroot/app/admin/view/student/studentshow.php";i:1538657169;s:47:"/var/www/html/wwwroot/app/admin/view/layout.php";i:1538657145;s:53:"/var/www/html/wwwroot/app/admin/view/block/header.php";i:1538657139;s:51:"/var/www/html/wwwroot/app/admin/view/block/menu.php";i:1538657140;s:52:"/var/www/html/wwwroot/app/admin/view/block/layui.php";i:1538657140;s:53:"/var/www/html/wwwroot/app/admin/view/block/footer.php";i:1538657139;}*/ ?>
<?php if(input('param.hisi_iframe') || cookie('hisi_iframe')): ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $_admin_menu_current['title']; ?> -  Powered by <?php echo config('hisiphp.name'); ?></title>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link rel="stylesheet" href="/wwwroot/static/admin/js/layui/css/layui.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/wwwroot/static/admin/css/theme.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/wwwroot/static/admin/css/style.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/wwwroot/static/fonts/typicons/min.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/wwwroot/static/fonts/font-awesome/min.css?v=<?php echo config('hisiphp.version'); ?>">
</head>
<body class="hisi-theme-<?php echo cookie('hisi_admin_theme'); ?>">
<div style="padding:0 10px;" class="mcolor"><?php echo runhook('system_admin_tips'); ?></div>
<?php else: ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php if($_admin_menu_current['url'] == 'admin/index/index'): ?>管理控制台<?php else: ?><?php echo $_admin_menu_current['title']; endif; ?> -  Powered by <?php echo config('hisiphp.name'); ?></title>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link rel="stylesheet" href="/wwwroot/static/admin/js/layui/css/layui.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/wwwroot/static/admin/css/theme.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/wwwroot/static/admin/css/style.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/wwwroot/static/fonts/typicons/min.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/wwwroot/static/fonts/font-awesome/min.css?v=<?php echo config('hisiphp.version'); ?>">
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
        <li class="layui-nav-item"><a href="/wwwroot/" target="_blank" class="aicon ai-ai-home" title="前台"></a></li>
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
    <div class="layui-body" id="switchBody">
        <ul class="bread-crumbs">
            <?php if(is_array($_bread_crumbs) || $_bread_crumbs instanceof \think\Collection || $_bread_crumbs instanceof \think\Paginator): $i = 0; $__LIST__ = $_bread_crumbs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($key > 0 && $i != count($_bread_crumbs)): ?>
                    <li>></li>
                    <li><a href="<?php echo url($v['url'].'?'.$v['param']); ?>"><?php echo $v['title']; ?></a></li>
                <?php elseif($i == count($_bread_crumbs)): ?>
                    <li>></li>
                    <li><a href="javascript:void(0);"><?php echo $v['title']; ?></a></li>
                <?php else: ?>
                    <li><a href="javascript:void(0);"><?php echo $v['title']; ?></a></li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <li><a href="<?php echo url('admin/menu/quick?id='.$_admin_menu_current['id']); ?>" title="添加到首页快捷菜单" class="j-ajax">[+]</a></li>
        </ul>
        <div style="padding:0 10px;" class="mcolor"><?php echo runhook('system_admin_tips'); ?></div>
        <div class="page-body">
<?php endif; switch($tab_type): case "1": ?>
    
        <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
                <?php if(is_array($tab_data['menu']) || $tab_data['menu'] instanceof \think\Collection || $tab_data['menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $tab_data['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['url'] == $_admin_menu_current['url'] or (url($vo['url']) == $tab_data['current'])): ?>
                    <li class="layui-this">
                    <?php else: ?>
                    <li>
                    <?php endif; if(substr($vo['url'], 0, 4) == 'http'): ?>
                        <a href="<?php echo $vo['url']; ?>" target="_blank"><?php echo $vo['title']; ?></a>
                    <?php else: ?>
                        <a href="<?php echo url($vo['url']); ?>"><?php echo $vo['title']; ?></a>
                    <?php endif; ?>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="tool-btns">
                    <a href="javascript:location.reload();" title="刷新当前页面" class="aicon ai-shuaxin2 font18"></a>
                    <a href="javascript:;" class="aicon ai-quanping1 font18" id="fullscreen-btn" title="打开/关闭全屏"></a>
                </div>
            </ul>
            <div class="layui-tab-content page-tab-content">
                <div class="layui-tab-item layui-show">
                    <form class="layui-form layui-form-pane" action="<?php echo url(); ?>" method="post" id="editForm">
<div class="layui-tab-item layui-show layui-form-pane">
    <div class="layui-form-item">
        <label class="layui-form-label">所在学校</label>
        <div class="layui-input-inline">
            <select name="school_id" class="field-shool_id" type="select" disabled>
                <?php echo $role_option; ?>
            </select>
        </div>
        <label class="layui-form-label">学期</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-year" name="year" lay-verify="required" autocomplete="off" placeholder="年" style="width:100%">

        </div>
        <div class="layui-input-inline" style="width: 90px">
            <input disabled type="text" class="layui-input field-semester" name="semester" lay-verify="required" autocomplete="off" placeholder="学期" style="width:100%">
        </div>
        <label class="layui-form-label">教师姓名</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-teacher_name" name="teacher_name" lay-verify="required" autocomplete="off" placeholder="请输入教师姓名">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">政治面貌</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-identity" name="identity" lay-verify="required" autocomplete="off" placeholder="请输入政治面貌">
        </div>
        <label class="layui-form-label">学生姓名</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-username" name="username" lay-verify="required" autocomplete="off" placeholder="学生姓名">
        </div>
        <label class="layui-form-label">性别</label>
        <div class="layui-input-inline">
            <select name="sex" class="field-sex" type="select" disabled>
                <option value="0">男</option>
                <option value="1">女</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-ages" name="ages" lay-verify="required" autocomplete="off" placeholder="年龄">
        </div>
        <label class="layui-form-label">年级</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-grade" name="grade" lay-verify="required" autocomplete="off" placeholder="年级">
        </div>
        <label class="layui-form-label">班级</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-class" name="class" lay-verify="required" autocomplete="off" placeholder="请输入班级">
        </div>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 135px">学生家庭情况</label>
    </div>
    <?php if(is_array($student_link) || $student_link instanceof \think\Collection || $student_link instanceof \think\Paginator): $i = 0; $__LIST__ = $student_link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="layui-form-item studenthomelink">
        <input type="hidden" value="<?php echo $vo['id']; ?>" name="ids[]">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-name" name="name[]" lay-verify="required" autocomplete="off" placeholder="姓名" value="<?php echo $vo['name']; ?>">
        </div>
        <label class="layui-form-label">亲属关系</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-homerelation" name="homerelation[]" lay-verify="required" autocomplete="off" placeholder="亲属关系" value="<?php echo $vo['homerelation']; ?>">
        </div>
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-birthday" name="age[]" lay-verify="required" autocomplete="off" placeholder="年龄" value="<?php echo $vo['age']; ?>">
        </div>
        <label class="layui-form-label">工作单位、务工务农地点
            或家庭所在地</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-workaddress" name="workaddress[]" lay-verify="required" autocomplete="off" placeholder="务工务农地点
或家庭所在地" value="<?php echo $vo['workaddress']; ?>">
        </div>
        <label class="layui-form-label">联系电话</label>
        <div class="layui-input-inline" style="width:100px">
            <input disabled type="text" class="layui-input field-mobile" name="mobile[]" lay-verify="required" autocomplete="off" placeholder="联系电话" value="<?php echo $vo['mobile']; ?>">
        </div>

    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 230px">学生思想行为表现和学业情况</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="imageandbehave" class="layui-textarea field-imageandbehave"></textarea>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 200px">帮扶计划</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="helpplan" class="layui-textarea field-helpplan"></textarea>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 200px">帮扶工作记录</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="helpworkmessage" class="layui-textarea field-helpworkmessage"></textarea>
    </div>
    <!--<div class="layui-form-item">
        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
        <div class="layui-input-inline">
            <input type="radio" class="field-status" name="status" value="1" title="启用" checked>
            <input type="radio" class="field-status" name="status" value="0" title="禁用">
        </div>
    </div>-->
</div>

<div class="layui-form-item" style="display:none">
    <div class="layui-input-block">
        <input type="hidden" class="field-id" name="id">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit">提交</button>
        <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
    </div>
</div>
</form>
<script src="/wwwroot/static/admin/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo $_SERVER['SCRIPT_NAME']; ?>";
    layui.config({
        base: '/wwwroot/static/admin/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script>
var formData = <?php echo json_encode($data_info); ?>;
layui.use(['form'], function() {
    var $ = layui.jquery, form = layui.form;
    /* 有BUG 待完善*/
    form.on('checkbox(roleAuth)', function(data) {
        var child = $(data.elem).parent('dt').siblings('dd').find('input');
        /* 自动选中父节点 */
        var check_parent = function (id) {
            var self = $('.role-list-form input[value="'+id+'"]');
            var pid = self.attr('data-pid') || '';
            self.prop('checked', true);
            if (pid == '') {
                return false;
            }
            check_parent(pid);
        };
        /* 自动选中子节点 */
        child.each(function(index, item) {
            item.checked = data.elem.checked;
        });
        check_parent($(data.elem).attr('data-pid'));
        form.render('checkbox');
    });

    /* 权限赋值 */
    if (formData) {
        for(var i in formData['auth']) {
            $('.role-list-form input[value="'+formData['auth'][i]+'"]').prop('checked', true);
        }
        form.render('checkbox');
    }

});
layui.use(['jquery'], function() {
    var $ = layui.jquery, input = '';
    $(document).on('click','.layui-btn-normal',function(){
        var studentHomeLinkHtml = $(this).parent('.studenthomelink').html();
        var studentHomeLink = "<div class='layui-form-item studenthomelink'>"+studentHomeLinkHtml+"</div>";
        $(this).parent('.studenthomelink').after(studentHomeLink);
    })

    $(document).on('click','.layui-btn-danger',function(){
        if($(".studenthomelink").size()>1)
            $(this).parent('.studenthomelink').remove();
    })

})
</script>
<script src="/wwwroot/static/admin/js/footer.js"></script>
                </div>
            </div>
        </div>
    <?php break; case "2": ?>
    
        <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
                <?php if(is_array($tab_data['menu']) || $tab_data['menu'] instanceof \think\Collection || $tab_data['menu'] instanceof \think\Paginator): $k = 0; $__LIST__ = $tab_data['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;if($k == 1): ?>
                    <li class="layui-this">
                    <?php else: ?>
                    <li>
                    <?php endif; ?>
                    <a href="javascript:;"><?php echo $vo['title']; ?></a>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="tool-btns">
                    <a href="javascript:location.reload();" title="刷新当前页面" class="aicon ai-shuaxin2 font18"></a>
                    <a href="javascript:;" class="aicon ai-quanping1 font18" id="fullscreen-btn" title="打开/关闭全屏"></a>
                </div>
            </ul>
            <div class="layui-tab-content page-tab-content">
                <form class="layui-form layui-form-pane" action="<?php echo url(); ?>" method="post" id="editForm">
<div class="layui-tab-item layui-show layui-form-pane">
    <div class="layui-form-item">
        <label class="layui-form-label">所在学校</label>
        <div class="layui-input-inline">
            <select name="school_id" class="field-shool_id" type="select" disabled>
                <?php echo $role_option; ?>
            </select>
        </div>
        <label class="layui-form-label">学期</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-year" name="year" lay-verify="required" autocomplete="off" placeholder="年" style="width:100%">

        </div>
        <div class="layui-input-inline" style="width: 90px">
            <input disabled type="text" class="layui-input field-semester" name="semester" lay-verify="required" autocomplete="off" placeholder="学期" style="width:100%">
        </div>
        <label class="layui-form-label">教师姓名</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-teacher_name" name="teacher_name" lay-verify="required" autocomplete="off" placeholder="请输入教师姓名">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">政治面貌</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-identity" name="identity" lay-verify="required" autocomplete="off" placeholder="请输入政治面貌">
        </div>
        <label class="layui-form-label">学生姓名</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-username" name="username" lay-verify="required" autocomplete="off" placeholder="学生姓名">
        </div>
        <label class="layui-form-label">性别</label>
        <div class="layui-input-inline">
            <select name="sex" class="field-sex" type="select" disabled>
                <option value="0">男</option>
                <option value="1">女</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-ages" name="ages" lay-verify="required" autocomplete="off" placeholder="年龄">
        </div>
        <label class="layui-form-label">年级</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-grade" name="grade" lay-verify="required" autocomplete="off" placeholder="年级">
        </div>
        <label class="layui-form-label">班级</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-class" name="class" lay-verify="required" autocomplete="off" placeholder="请输入班级">
        </div>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 135px">学生家庭情况</label>
    </div>
    <?php if(is_array($student_link) || $student_link instanceof \think\Collection || $student_link instanceof \think\Paginator): $i = 0; $__LIST__ = $student_link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="layui-form-item studenthomelink">
        <input type="hidden" value="<?php echo $vo['id']; ?>" name="ids[]">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-name" name="name[]" lay-verify="required" autocomplete="off" placeholder="姓名" value="<?php echo $vo['name']; ?>">
        </div>
        <label class="layui-form-label">亲属关系</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-homerelation" name="homerelation[]" lay-verify="required" autocomplete="off" placeholder="亲属关系" value="<?php echo $vo['homerelation']; ?>">
        </div>
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-birthday" name="age[]" lay-verify="required" autocomplete="off" placeholder="年龄" value="<?php echo $vo['age']; ?>">
        </div>
        <label class="layui-form-label">工作单位、务工务农地点
            或家庭所在地</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-workaddress" name="workaddress[]" lay-verify="required" autocomplete="off" placeholder="务工务农地点
或家庭所在地" value="<?php echo $vo['workaddress']; ?>">
        </div>
        <label class="layui-form-label">联系电话</label>
        <div class="layui-input-inline" style="width:100px">
            <input disabled type="text" class="layui-input field-mobile" name="mobile[]" lay-verify="required" autocomplete="off" placeholder="联系电话" value="<?php echo $vo['mobile']; ?>">
        </div>

    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 230px">学生思想行为表现和学业情况</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="imageandbehave" class="layui-textarea field-imageandbehave"></textarea>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 200px">帮扶计划</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="helpplan" class="layui-textarea field-helpplan"></textarea>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 200px">帮扶工作记录</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="helpworkmessage" class="layui-textarea field-helpworkmessage"></textarea>
    </div>
    <!--<div class="layui-form-item">
        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
        <div class="layui-input-inline">
            <input type="radio" class="field-status" name="status" value="1" title="启用" checked>
            <input type="radio" class="field-status" name="status" value="0" title="禁用">
        </div>
    </div>-->
</div>

<div class="layui-form-item" style="display:none">
    <div class="layui-input-block">
        <input type="hidden" class="field-id" name="id">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit">提交</button>
        <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
    </div>
</div>
</form>
<script src="/wwwroot/static/admin/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo $_SERVER['SCRIPT_NAME']; ?>";
    layui.config({
        base: '/wwwroot/static/admin/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script>
var formData = <?php echo json_encode($data_info); ?>;
layui.use(['form'], function() {
    var $ = layui.jquery, form = layui.form;
    /* 有BUG 待完善*/
    form.on('checkbox(roleAuth)', function(data) {
        var child = $(data.elem).parent('dt').siblings('dd').find('input');
        /* 自动选中父节点 */
        var check_parent = function (id) {
            var self = $('.role-list-form input[value="'+id+'"]');
            var pid = self.attr('data-pid') || '';
            self.prop('checked', true);
            if (pid == '') {
                return false;
            }
            check_parent(pid);
        };
        /* 自动选中子节点 */
        child.each(function(index, item) {
            item.checked = data.elem.checked;
        });
        check_parent($(data.elem).attr('data-pid'));
        form.render('checkbox');
    });

    /* 权限赋值 */
    if (formData) {
        for(var i in formData['auth']) {
            $('.role-list-form input[value="'+formData['auth'][i]+'"]').prop('checked', true);
        }
        form.render('checkbox');
    }

});
layui.use(['jquery'], function() {
    var $ = layui.jquery, input = '';
    $(document).on('click','.layui-btn-normal',function(){
        var studentHomeLinkHtml = $(this).parent('.studenthomelink').html();
        var studentHomeLink = "<div class='layui-form-item studenthomelink'>"+studentHomeLinkHtml+"</div>";
        $(this).parent('.studenthomelink').after(studentHomeLink);
    })

    $(document).on('click','.layui-btn-danger',function(){
        if($(".studenthomelink").size()>1)
            $(this).parent('.studenthomelink').remove();
    })

})
</script>
<script src="/wwwroot/static/admin/js/footer.js"></script>
            </div>
        </div>
    <?php break; case "3": ?>
    
        <form class="layui-form layui-form-pane" action="<?php echo url(); ?>" method="post" id="editForm">
<div class="layui-tab-item layui-show layui-form-pane">
    <div class="layui-form-item">
        <label class="layui-form-label">所在学校</label>
        <div class="layui-input-inline">
            <select name="school_id" class="field-shool_id" type="select" disabled>
                <?php echo $role_option; ?>
            </select>
        </div>
        <label class="layui-form-label">学期</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-year" name="year" lay-verify="required" autocomplete="off" placeholder="年" style="width:100%">

        </div>
        <div class="layui-input-inline" style="width: 90px">
            <input disabled type="text" class="layui-input field-semester" name="semester" lay-verify="required" autocomplete="off" placeholder="学期" style="width:100%">
        </div>
        <label class="layui-form-label">教师姓名</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-teacher_name" name="teacher_name" lay-verify="required" autocomplete="off" placeholder="请输入教师姓名">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">政治面貌</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-identity" name="identity" lay-verify="required" autocomplete="off" placeholder="请输入政治面貌">
        </div>
        <label class="layui-form-label">学生姓名</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-username" name="username" lay-verify="required" autocomplete="off" placeholder="学生姓名">
        </div>
        <label class="layui-form-label">性别</label>
        <div class="layui-input-inline">
            <select name="sex" class="field-sex" type="select" disabled>
                <option value="0">男</option>
                <option value="1">女</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-ages" name="ages" lay-verify="required" autocomplete="off" placeholder="年龄">
        </div>
        <label class="layui-form-label">年级</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-grade" name="grade" lay-verify="required" autocomplete="off" placeholder="年级">
        </div>
        <label class="layui-form-label">班级</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-class" name="class" lay-verify="required" autocomplete="off" placeholder="请输入班级">
        </div>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 135px">学生家庭情况</label>
    </div>
    <?php if(is_array($student_link) || $student_link instanceof \think\Collection || $student_link instanceof \think\Paginator): $i = 0; $__LIST__ = $student_link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="layui-form-item studenthomelink">
        <input type="hidden" value="<?php echo $vo['id']; ?>" name="ids[]">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-name" name="name[]" lay-verify="required" autocomplete="off" placeholder="姓名" value="<?php echo $vo['name']; ?>">
        </div>
        <label class="layui-form-label">亲属关系</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-homerelation" name="homerelation[]" lay-verify="required" autocomplete="off" placeholder="亲属关系" value="<?php echo $vo['homerelation']; ?>">
        </div>
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-birthday" name="age[]" lay-verify="required" autocomplete="off" placeholder="年龄" value="<?php echo $vo['age']; ?>">
        </div>
        <label class="layui-form-label">工作单位、务工务农地点
            或家庭所在地</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-workaddress" name="workaddress[]" lay-verify="required" autocomplete="off" placeholder="务工务农地点
或家庭所在地" value="<?php echo $vo['workaddress']; ?>">
        </div>
        <label class="layui-form-label">联系电话</label>
        <div class="layui-input-inline" style="width:100px">
            <input disabled type="text" class="layui-input field-mobile" name="mobile[]" lay-verify="required" autocomplete="off" placeholder="联系电话" value="<?php echo $vo['mobile']; ?>">
        </div>

    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 230px">学生思想行为表现和学业情况</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="imageandbehave" class="layui-textarea field-imageandbehave"></textarea>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 200px">帮扶计划</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="helpplan" class="layui-textarea field-helpplan"></textarea>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 200px">帮扶工作记录</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="helpworkmessage" class="layui-textarea field-helpworkmessage"></textarea>
    </div>
    <!--<div class="layui-form-item">
        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
        <div class="layui-input-inline">
            <input type="radio" class="field-status" name="status" value="1" title="启用" checked>
            <input type="radio" class="field-status" name="status" value="0" title="禁用">
        </div>
    </div>-->
</div>

<div class="layui-form-item" style="display:none">
    <div class="layui-input-block">
        <input type="hidden" class="field-id" name="id">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit">提交</button>
        <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
    </div>
</div>
</form>
<script src="/wwwroot/static/admin/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo $_SERVER['SCRIPT_NAME']; ?>";
    layui.config({
        base: '/wwwroot/static/admin/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script>
var formData = <?php echo json_encode($data_info); ?>;
layui.use(['form'], function() {
    var $ = layui.jquery, form = layui.form;
    /* 有BUG 待完善*/
    form.on('checkbox(roleAuth)', function(data) {
        var child = $(data.elem).parent('dt').siblings('dd').find('input');
        /* 自动选中父节点 */
        var check_parent = function (id) {
            var self = $('.role-list-form input[value="'+id+'"]');
            var pid = self.attr('data-pid') || '';
            self.prop('checked', true);
            if (pid == '') {
                return false;
            }
            check_parent(pid);
        };
        /* 自动选中子节点 */
        child.each(function(index, item) {
            item.checked = data.elem.checked;
        });
        check_parent($(data.elem).attr('data-pid'));
        form.render('checkbox');
    });

    /* 权限赋值 */
    if (formData) {
        for(var i in formData['auth']) {
            $('.role-list-form input[value="'+formData['auth'][i]+'"]').prop('checked', true);
        }
        form.render('checkbox');
    }

});
layui.use(['jquery'], function() {
    var $ = layui.jquery, input = '';
    $(document).on('click','.layui-btn-normal',function(){
        var studentHomeLinkHtml = $(this).parent('.studenthomelink').html();
        var studentHomeLink = "<div class='layui-form-item studenthomelink'>"+studentHomeLinkHtml+"</div>";
        $(this).parent('.studenthomelink').after(studentHomeLink);
    })

    $(document).on('click','.layui-btn-danger',function(){
        if($(".studenthomelink").size()>1)
            $(this).parent('.studenthomelink').remove();
    })

})
</script>
<script src="/wwwroot/static/admin/js/footer.js"></script>
    <?php break; default: ?>
    
        <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
                <li class="layui-this">
                    <a href="javascript:;" id="curTitle"><?php echo $_admin_menu_current['title']; ?></a>
                </li>
                <div class="tool-btns">
                    <a href="javascript:location.reload();" title="刷新当前页面" class="aicon ai-shuaxin2 font18"></a>
                    <a href="javascript:;" class="aicon ai-quanping1 font18" id="fullscreen-btn" title="打开/关闭全屏"></a>
                </div>
            </ul>
            <div class="layui-tab-content page-tab-content">
                <div class="layui-tab-item layui-show">
                    <form class="layui-form layui-form-pane" action="<?php echo url(); ?>" method="post" id="editForm">
<div class="layui-tab-item layui-show layui-form-pane">
    <div class="layui-form-item">
        <label class="layui-form-label">所在学校</label>
        <div class="layui-input-inline">
            <select name="school_id" class="field-shool_id" type="select" disabled>
                <?php echo $role_option; ?>
            </select>
        </div>
        <label class="layui-form-label">学期</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-year" name="year" lay-verify="required" autocomplete="off" placeholder="年" style="width:100%">

        </div>
        <div class="layui-input-inline" style="width: 90px">
            <input disabled type="text" class="layui-input field-semester" name="semester" lay-verify="required" autocomplete="off" placeholder="学期" style="width:100%">
        </div>
        <label class="layui-form-label">教师姓名</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-teacher_name" name="teacher_name" lay-verify="required" autocomplete="off" placeholder="请输入教师姓名">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">政治面貌</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-identity" name="identity" lay-verify="required" autocomplete="off" placeholder="请输入政治面貌">
        </div>
        <label class="layui-form-label">学生姓名</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-username" name="username" lay-verify="required" autocomplete="off" placeholder="学生姓名">
        </div>
        <label class="layui-form-label">性别</label>
        <div class="layui-input-inline">
            <select name="sex" class="field-sex" type="select" disabled>
                <option value="0">男</option>
                <option value="1">女</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-ages" name="ages" lay-verify="required" autocomplete="off" placeholder="年龄">
        </div>
        <label class="layui-form-label">年级</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-grade" name="grade" lay-verify="required" autocomplete="off" placeholder="年级">
        </div>
        <label class="layui-form-label">班级</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-class" name="class" lay-verify="required" autocomplete="off" placeholder="请输入班级">
        </div>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 135px">学生家庭情况</label>
    </div>
    <?php if(is_array($student_link) || $student_link instanceof \think\Collection || $student_link instanceof \think\Paginator): $i = 0; $__LIST__ = $student_link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="layui-form-item studenthomelink">
        <input type="hidden" value="<?php echo $vo['id']; ?>" name="ids[]">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-name" name="name[]" lay-verify="required" autocomplete="off" placeholder="姓名" value="<?php echo $vo['name']; ?>">
        </div>
        <label class="layui-form-label">亲属关系</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-homerelation" name="homerelation[]" lay-verify="required" autocomplete="off" placeholder="亲属关系" value="<?php echo $vo['homerelation']; ?>">
        </div>
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-birthday" name="age[]" lay-verify="required" autocomplete="off" placeholder="年龄" value="<?php echo $vo['age']; ?>">
        </div>
        <label class="layui-form-label">工作单位、务工务农地点
            或家庭所在地</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-workaddress" name="workaddress[]" lay-verify="required" autocomplete="off" placeholder="务工务农地点
或家庭所在地" value="<?php echo $vo['workaddress']; ?>">
        </div>
        <label class="layui-form-label">联系电话</label>
        <div class="layui-input-inline" style="width:100px">
            <input disabled type="text" class="layui-input field-mobile" name="mobile[]" lay-verify="required" autocomplete="off" placeholder="联系电话" value="<?php echo $vo['mobile']; ?>">
        </div>

    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 230px">学生思想行为表现和学业情况</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="imageandbehave" class="layui-textarea field-imageandbehave"></textarea>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 200px">帮扶计划</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="helpplan" class="layui-textarea field-helpplan"></textarea>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 200px">帮扶工作记录</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="helpworkmessage" class="layui-textarea field-helpworkmessage"></textarea>
    </div>
    <!--<div class="layui-form-item">
        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
        <div class="layui-input-inline">
            <input type="radio" class="field-status" name="status" value="1" title="启用" checked>
            <input type="radio" class="field-status" name="status" value="0" title="禁用">
        </div>
    </div>-->
</div>

<div class="layui-form-item" style="display:none">
    <div class="layui-input-block">
        <input type="hidden" class="field-id" name="id">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit">提交</button>
        <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
    </div>
</div>
</form>
<script src="/wwwroot/static/admin/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo $_SERVER['SCRIPT_NAME']; ?>";
    layui.config({
        base: '/wwwroot/static/admin/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script>
var formData = <?php echo json_encode($data_info); ?>;
layui.use(['form'], function() {
    var $ = layui.jquery, form = layui.form;
    /* 有BUG 待完善*/
    form.on('checkbox(roleAuth)', function(data) {
        var child = $(data.elem).parent('dt').siblings('dd').find('input');
        /* 自动选中父节点 */
        var check_parent = function (id) {
            var self = $('.role-list-form input[value="'+id+'"]');
            var pid = self.attr('data-pid') || '';
            self.prop('checked', true);
            if (pid == '') {
                return false;
            }
            check_parent(pid);
        };
        /* 自动选中子节点 */
        child.each(function(index, item) {
            item.checked = data.elem.checked;
        });
        check_parent($(data.elem).attr('data-pid'));
        form.render('checkbox');
    });

    /* 权限赋值 */
    if (formData) {
        for(var i in formData['auth']) {
            $('.role-list-form input[value="'+formData['auth'][i]+'"]').prop('checked', true);
        }
        form.render('checkbox');
    }

});
layui.use(['jquery'], function() {
    var $ = layui.jquery, input = '';
    $(document).on('click','.layui-btn-normal',function(){
        var studentHomeLinkHtml = $(this).parent('.studenthomelink').html();
        var studentHomeLink = "<div class='layui-form-item studenthomelink'>"+studentHomeLinkHtml+"</div>";
        $(this).parent('.studenthomelink').after(studentHomeLink);
    })

    $(document).on('click','.layui-btn-danger',function(){
        if($(".studenthomelink").size()>1)
            $(this).parent('.studenthomelink').remove();
    })

})
</script>
<script src="/wwwroot/static/admin/js/footer.js"></script>
                </div>
            </div>
        </div>
<?php endswitch; if(input('param.hisi_iframe') || cookie('hisi_iframe')): ?>
</body>
</html>
<?php else: ?>
        </div>
    </div>
    <div class="layui-footer footer">
        <span class="fl">Powered by <a href="<?php echo config('hisiphp.url'); ?>" target="_blank"><?php echo config('hisiphp.name'); ?></a> v<?php echo config('hisiphp.version'); ?></span>
        <span class="fr"> © 2017-2018 <a href="<?php echo config('hisiphp.url'); ?>" target="_blank"><?php echo config('hisiphp.copyright'); ?></a> All Rights Reserved.</span>
    </div>
</div>
</body>
</html>
<?php endif; ?>