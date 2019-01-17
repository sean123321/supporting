-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?09 �?21 �?17:21
-- 服务器版本: 5.5.40-log
-- PHP 版本: 5.6.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `support_project`
--

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_annex`
--

CREATE TABLE IF NOT EXISTS `sup_admin_annex` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联的数据ID',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '类型',
  `group` varchar(100) NOT NULL DEFAULT 'sys' COMMENT '文件分组',
  `file` varchar(255) NOT NULL COMMENT '上传文件',
  `hash` varchar(64) NOT NULL COMMENT '文件hash值',
  `size` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '附件大小KB',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '使用状态(0未使用，1已使用)',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[系统] 上传附件' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_annex_group`
--

CREATE TABLE IF NOT EXISTS `sup_admin_annex_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '附件分组',
  `count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '附件数量',
  `size` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '附件大小kb',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='[系统] 附件分组' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sup_admin_annex_group`
--

INSERT INTO `sup_admin_annex_group` (`id`, `name`, `count`, `size`) VALUES
(1, 'sys', 0, '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_config`
--

CREATE TABLE IF NOT EXISTS `sup_admin_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统配置(1是，0否)',
  `group` varchar(20) NOT NULL DEFAULT 'base' COMMENT '分组',
  `title` varchar(20) NOT NULL COMMENT '配置标题',
  `name` varchar(50) NOT NULL COMMENT '配置名称，由英文字母和下划线组成',
  `value` text NOT NULL COMMENT '配置值',
  `type` varchar(20) NOT NULL DEFAULT 'input' COMMENT '配置类型()',
  `options` text NOT NULL COMMENT '配置项(选项名:选项值)',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '文件上传接口',
  `tips` varchar(255) NOT NULL COMMENT '配置提示',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='[系统] 系统配置' AUTO_INCREMENT=53 ;

--
-- 转存表中的数据 `sup_admin_config`
--

INSERT INTO `sup_admin_config` (`id`, `system`, `group`, `title`, `name`, `value`, `type`, `options`, `url`, `tips`, `sort`, `status`, `ctime`, `mtime`) VALUES
(1, 1, 'sys', '扩展配置分组', 'config_group', '', 'array', ' ', '', '请按如下格式填写：&lt;br&gt;键值:键名&lt;br&gt;键值:键名&lt;br&gt;&lt;span style=&quot;color:#f00&quot;&gt;键值只能为英文、数字、下划线&lt;/span&gt;', 1, 1, 1492140215, 1492140215),
(13, 1, 'base', '网站域名', 'site_domain', '', 'input', '', '', '', 2, 1, 1492140215, 1492140215),
(14, 1, 'upload', '图片上传大小限制', 'upload_image_size', '0', 'input', '', '', '单位：KB，0表示不限制大小', 3, 1, 1490841797, 1491040778),
(15, 1, 'upload', '允许上传图片格式', 'upload_image_ext', 'jpg,png,gif,jpeg,ico', 'input', '', '', '多个格式请用英文逗号（,）隔开', 4, 1, 1490842130, 1491040778),
(16, 1, 'upload', '缩略图裁剪方式', 'thumb_type', '2', 'select', '1:等比例缩放\r\n2:缩放后填充\r\n3:居中裁剪\r\n4:左上角裁剪\r\n5:右下角裁剪\r\n6:固定尺寸缩放\r\n', '', '', 5, 1, 1490842450, 1491040778),
(17, 1, 'upload', '图片水印开关', 'image_watermark', '1', 'switch', '0:关闭\r\n1:开启', '', '', 6, 1, 1490842583, 1491040778),
(18, 1, 'upload', '图片水印图', 'image_watermark_pic', '', 'image', '', '', '', 7, 1, 1490842679, 1491040778),
(19, 1, 'upload', '图片水印透明度', 'image_watermark_opacity', '50', 'input', '', '', '可设置值为0~100，数字越小，透明度越高', 8, 1, 1490857704, 1491040778),
(20, 1, 'upload', '图片水印图位置', 'image_watermark_location', '9', 'select', '7:左下角\r\n1:左上角\r\n4:左居中\r\n9:右下角\r\n3:右上角\r\n6:右居中\r\n2:上居中\r\n8:下居中\r\n5:居中', '', '', 9, 1, 1490858228, 1491040778),
(21, 1, 'upload', '文件上传大小限制', 'upload_file_size', '0', 'input', '', '', '单位：KB，0表示不限制大小', 1, 1, 1490859167, 1491040778),
(22, 1, 'upload', '允许上传文件格式', 'upload_file_ext', 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,rar,zip', 'input', '', '', '多个格式请用英文逗号（,）隔开', 2, 1, 1490859246, 1491040778),
(23, 1, 'upload', '文字水印开关', 'text_watermark', '0', 'switch', '0:关闭\r\n1:开启', '', '', 10, 1, 1490860872, 1491040778),
(24, 1, 'upload', '文字水印内容', 'text_watermark_content', '', 'input', '', '', '', 11, 1, 1490861005, 1491040778),
(25, 1, 'upload', '文字水印字体', 'text_watermark_font', '', 'file', '', '', '不上传将使用系统默认字体', 12, 1, 1490861117, 1491040778),
(26, 1, 'upload', '文字水印字体大小', 'text_watermark_size', '20', 'input', '', '', '单位：px(像素)', 13, 1, 1490861204, 1491040778),
(27, 1, 'upload', '文字水印颜色', 'text_watermark_color', '#000000', 'input', '', '', '文字水印颜色，格式:#000000', 14, 1, 1490861482, 1491040778),
(28, 1, 'upload', '文字水印位置', 'text_watermark_location', '7', 'select', '7:左下角\r\n1:左上角\r\n4:左居中\r\n9:右下角\r\n3:右上角\r\n6:右居中\r\n2:上居中\r\n8:下居中\r\n5:居中', '', '', 11, 1, 1490861718, 1491040778),
(29, 1, 'upload', '缩略图尺寸', 'thumb_size', '300x300;500x500', 'input', '', '', '为空则不生成，生成 500x500 的缩略图，则填写 500x500，多个规格填写参考 300x300;500x500;800x800', 4, 1, 1490947834, 1491040778),
(30, 1, 'develop', '开发模式', 'app_debug', '1', 'switch', '0:关闭\r\n1:开启', '', '', 0, 1, 1491005004, 1492093874),
(31, 1, 'develop', '页面Trace', 'app_trace', '0', 'switch', '0:关闭\r\n1:开启', '', '', 0, 1, 1491005081, 1492093874),
(33, 1, 'sys', '富文本编辑器', 'editor', 'umeditor', 'select', 'ueditor:UEditor\r\numeditor:UMEditor\r\nkindeditor:KindEditor\r\nckeditor:CKEditor', '', '', 2, 1, 1491142648, 1492140215),
(35, 1, 'databases', '备份目录', 'backup_path', './backup/database/', 'input', '', '', '数据库备份路径,路径必须以 / 结尾', 0, 1, 1491881854, 1491965974),
(36, 1, 'databases', '备份分卷大小', 'part_size', '20971520', 'input', '', '', '用于限制压缩后的分卷最大长度。单位：B；建议设置20M', 0, 1, 1491881975, 1491965974),
(37, 1, 'databases', '备份压缩开关', 'compress', '1', 'switch', '0:关闭\r\n1:开启', '', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', 0, 1, 1491882038, 1491965974),
(38, 1, 'databases', '备份压缩级别', 'compress_level', '4', 'radio', '1:最低\r\n4:一般\r\n9:最高', '', '数据库备份文件的压缩级别，该配置在开启压缩时生效', 0, 1, 1491882154, 1491965974),
(39, 1, 'base', '网站状态', 'site_status', '1', 'switch', '0:关闭\r\n1:开启', '', '站点关闭后将不能访问，后台可正常登录', 1, 1, 1492049460, 1494690024),
(40, 1, 'sys', '后台管理路径', 'admin_path', 'admin.php', 'input', '', '', '必须以.php为后缀', 0, 1, 1492139196, 1492140215),
(41, 1, 'base', '网站标题', 'site_title', '洛川县学生资助管理中心', 'input', '', '', '网站标题是体现一个网站的主旨，要做到主题突出、标题简洁、连贯等特点，建议不超过28个字', 6, 1, 1492502354, 1494695131),
(42, 1, 'base', '网站关键词', 'site_keywords', '', 'input', '', '', '网页内容所包含的核心搜索关键词，多个关键字请用英文逗号&quot;,&quot;分隔', 7, 1, 1494690508, 1494690780),
(43, 1, 'base', '网站描述', 'site_description', '', 'textarea', '', '', '网页的描述信息，搜索引擎采纳后，作为搜索结果中的页面摘要显示，建议不超过80个字', 8, 1, 1494690669, 1494691075),
(44, 1, 'base', 'ICP备案信息', 'site_icp', '', 'input', '', '', '请填写ICP备案号，用于展示在网站底部，ICP备案官网：&lt;a href=&quot;http://www.miibeian.gov.cn&quot; target=&quot;_blank&quot;&gt;http://www.miibeian.gov.cn&lt;/a&gt;', 9, 1, 1494691721, 1494692046),
(45, 1, 'base', '站点统计代码', 'site_statis', '', 'textarea', '', '', '第三方流量统计代码，前台调用时请先用 htmlspecialchars_decode函数转义输出', 10, 1, 1494691959, 1494694797),
(46, 1, 'base', '网站名称', 'site_name', '洛川县学生资助管理中心', 'input', '', '', '将显示在浏览器窗口标题等位置', 3, 1, 1494692103, 1494694680),
(47, 1, 'base', '网站LOGO', 'site_logo', '', 'image', '', '', '网站LOGO图片', 4, 1, 1494692345, 1494693235),
(48, 1, 'base', '网站图标', 'site_favicon', '', 'image', '', '/admin/annex/favicon', '又叫网站收藏夹图标，它显示位于浏览器的地址栏或者标题前面，&lt;strong class=&quot;red&quot;&gt;.ico格式&lt;/strong&gt;，&lt;a href=&quot;https://www.baidu.com/s?ie=UTF-8&amp;wd=favicon&quot; target=&quot;_blank&quot;&gt;点此了解网站图标&lt;/a&gt;', 5, 1, 1494692781, 1494693966),
(49, 1, 'base', '手机网站', 'wap_site_status', '0', 'switch', '0:关闭\r\n1:开启', '', '如果有手机网站，请设置为开启状态，否则只显示PC网站', 2, 1, 1498405436, 1498405436),
(50, 1, 'sys', '云端推送', 'cloud_push', '0', 'switch', '0:关闭\r\n1:开启', '', '关闭之后，无法通过云端推送安装扩展', 3, 1, 1504250320, 1504250320),
(51, 0, 'base', '手机网站域名', 'wap_domain', '', 'input', '', '', '手机访问将自动跳转至此域名', 2, 1, 1504304776, 1504304837),
(52, 0, 'sys', '多语言支持', 'multi_language', '0', 'switch', '0:关闭\r\n1:开启', '', '开启后你可以自由上传多种语言包', 4, 1, 1506532211, 1506532211);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_hook`
--

CREATE TABLE IF NOT EXISTS `sup_admin_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统插件',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `source` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子来源[plugins.插件名，module.模块名]',
  `intro` varchar(200) NOT NULL DEFAULT '' COMMENT '钩子简介',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 钩子表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `sup_admin_hook`
--

INSERT INTO `sup_admin_hook` (`id`, `system`, `name`, `source`, `intro`, `status`, `ctime`, `mtime`) VALUES
(1, 1, 'system_admin_index', '', '后台首页', 1, 1490885108, 1490885108),
(2, 1, 'system_admin_tips', '', '后台所有页面提示', 1, 1490885108, 1490885108),
(3, 1, 'system_annex_upload', '', '附件上传钩子，可扩展上传到第三方存储', 1, 1490885108, 1490885108),
(4, 1, 'system_member_login', '', '会员登陆成功之后的动作', 1, 1490885108, 1490885108),
(5, 1, 'system_member_register', '', '会员注册成功后的动作', 1, 1490885108, 1490885108);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_hook_plugins`
--

CREATE TABLE IF NOT EXISTS `sup_admin_hook_plugins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hook` varchar(32) NOT NULL COMMENT '钩子id',
  `plugins` varchar(32) NOT NULL COMMENT '插件标识',
  `ctime` int(11) unsigned NOT NULL DEFAULT '0',
  `mtime` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 钩子-插件对应表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sup_admin_hook_plugins`
--

INSERT INTO `sup_admin_hook_plugins` (`id`, `hook`, `plugins`, `ctime`, `mtime`, `sort`, `status`) VALUES
(1, 'system_admin_index', 'hisiphp', 1510063011, 1510063011, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_language`
--

CREATE TABLE IF NOT EXISTS `sup_admin_language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '语言包名称',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '编码',
  `locale` varchar(255) NOT NULL DEFAULT '' COMMENT '本地浏览器语言编码',
  `icon` varchar(30) NOT NULL DEFAULT '' COMMENT '图标',
  `pack` varchar(100) NOT NULL DEFAULT '' COMMENT '上传的语言包',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='[系统] 语言包' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sup_admin_language`
--

INSERT INTO `sup_admin_language` (`id`, `name`, `code`, `locale`, `icon`, `pack`, `sort`, `status`) VALUES
(1, '简体中文', 'zh-cn', 'zh-CN,zh-CN.UTF-8,zh-cn', '', '1', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_log`
--

CREATE TABLE IF NOT EXISTS `sup_admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT '',
  `url` varchar(200) DEFAULT '',
  `param` text,
  `remark` varchar(255) DEFAULT '',
  `count` int(10) unsigned NOT NULL DEFAULT '1',
  `ip` varchar(128) DEFAULT '',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='[系统] 操作日志' AUTO_INCREMENT=71 ;

--
-- 转存表中的数据 `sup_admin_log`
--

INSERT INTO `sup_admin_log` (`id`, `uid`, `title`, `url`, `param`, `remark`, `count`, `ip`, `ctime`, `mtime`) VALUES
(1, 1, '后台首页', 'admin/index/index', '[]', '浏览数据', 167, '127.0.0.1', 1536554329, 1537521603),
(2, 1, '钩子管理', 'admin/hook/index', '{"page":"1","limit":"20"}', '浏览数据', 6, '127.0.0.1', 1536568815, 1536629541),
(3, 1, '修改钩子', 'admin/hook/edit', '{"id":"1"}', '浏览数据', 1, '127.0.0.1', 1536568824, 1536568824),
(4, 1, '插件管理', 'admin/plugins/index', '[]', '浏览数据', 4, '127.0.0.1', 1536568838, 1536629538),
(5, 1, '状态设置', 'admin/plugins/status', '{"val":"0","id":"1"}', '浏览数据', 1, '127.0.0.1', 1536568848, 1536568848),
(6, 1, '导入插件', 'admin/plugins/import', '[]', '浏览数据', 1, '127.0.0.1', 1536568857, 1536568857),
(7, 1, '布局切换', 'admin/user/iframe', '[]', '浏览数据', 3, '127.0.0.1', 1536568875, 1536574288),
(8, 1, '后台首页', 'admin/index/welcome', '[]', '浏览数据', 169, '127.0.0.1', 1536568880, 1537521603),
(9, 1, '模块管理', 'admin/module/index', '{"status":"0"}', '浏览数据', 11, '127.0.0.1', 1536573889, 1536894598),
(10, 1, '配置管理', 'admin/config/index', '{"page":"1","limit":"20"}', '浏览数据', 42, '127.0.0.1', 1536573894, 1536630044),
(11, 1, '修改配置', 'admin/config/edit', '{"id":"44"}', '浏览数据', 4, '127.0.0.1', 1536573903, 1536629394),
(12, 1, '状态设置', 'admin/config/status', '{"table":"admin_config","id":"46","val":"1"}', '浏览数据', 2, '127.0.0.1', 1536573913, 1536573916),
(13, 1, '系统菜单', 'admin/menu/index', '[]', '浏览数据', 158, '127.0.0.1', 1536574190, 1537350435),
(14, 1, '系统设置', 'admin/system/index', '{"group":"base"}', '浏览数据', 17, '127.0.0.1', 1536574202, 1536894897),
(15, 1, '系统配置', 'admin/system/index', '{"group":"sys"}', '浏览数据', 17, '127.0.0.1', 1536574210, 1536892437),
(16, 1, '上传配置', 'admin/system/index', '{"group":"upload"}', '浏览数据', 13, '127.0.0.1', 1536574228, 1536736219),
(17, 1, '开发配置', 'admin/system/index', '{"group":"develop"}', '浏览数据', 11, '127.0.0.1', 1536574229, 1536736215),
(18, 1, '数据库配置', 'admin/system/index', '{"group":"databases"}', '浏览数据', 7, '127.0.0.1', 1536574230, 1536736214),
(19, 1, '基础配置', 'admin/system/index', '{"group":"base"}', '浏览数据', 10, '127.0.0.1', 1536574232, 1536892439),
(20, 1, '基础配置', 'admin/system/index', '{"id":{"site_status":"1","site_domain":"","wap_domain":"","site_name":"\\u6d1b\\u5ddd\\u53bf\\u5b66\\u751f\\u8d44\\u52a9\\u7ba1\\u7406\\u4e2d\\u5fc3","site_logo":"","site_favicon":"","site_title":"\\u6d1b\\u5ddd\\u53bf\\u5b66\\u751f\\u8d44\\u52a9\\u7ba1\\u7406\\u4e2d\\u5fc3","site_keywords":"","site_description":"","site_icp":"","site_statis":""},"type":{"site_status":"switch","site_domain":"input","wap_site_status":"switch","wap_domain":"input","site_name":"input","site_logo":"image","site_favicon":"image","site_title":"input","site_keywords":"input","site_description":"textarea","site_icp":"input","site_statis":"textarea"},"group":"base"}', '保存数据', 2, '127.0.0.1', 1536574264, 1536628222),
(21, 1, '个人信息设置', 'admin/user/info', '[]', '浏览数据', 1, '127.0.0.1', 1536574275, 1536574275),
(22, 1, '语言包管理', 'admin/language/index', '{"page":"1","limit":"10"}', '浏览数据', 2, '127.0.0.1', 1536574282, 1536574282),
(23, 1, '系统日志', 'admin/log/index', '{"page":"1","limit":"20"}', '浏览数据', 12, '127.0.0.1', 1536574310, 1536630037),
(24, 1, '系统管理员', 'admin/user/index', '{"page":"1","limit":"20"}', '浏览数据', 194, '127.0.0.1', 1536574321, 1537350821),
(25, 1, '管理员角色', 'admin/user/role', '{"page":"1","limit":"10"}', '浏览数据', 93, '127.0.0.1', 1536574342, 1537349019),
(26, 1, '会员等级', 'admin/member/level', '{"page":"1","limit":"10"}', '浏览数据', 8, '127.0.0.1', 1536628283, 1536629718),
(27, 1, '会员列表', 'admin/member/index', '[]', '浏览数据', 4, '127.0.0.1', 1536628286, 1536629715),
(28, 1, '添加会员等级', 'admin/member/addlevel', '[]', '浏览数据', 2, '127.0.0.1', 1536628304, 1536629493),
(29, 1, '添加管理员', 'admin/user/adduser', '[]', '浏览数据', 18, '127.0.0.1', 1536628318, 1537350823),
(30, 1, '导出菜单', 'admin/menu/export', '{"id":"1"}', '浏览数据', 1, '127.0.0.1', 1536628470, 1536628470),
(31, 1, '添加菜单', 'admin/menu/add', '{"pid":"1","mod":"admin"}', '浏览数据', 18, '127.0.0.1', 1536628614, 1537349141),
(32, 1, '数据库管理', 'admin/database/index', '[]', '浏览数据', 5, '127.0.0.1', 1536628686, 1536629998),
(33, 1, '优化数据库', 'admin/database/optimize', '{"ids":"sup_admin_role"}', '浏览数据', 1, '127.0.0.1', 1536628742, 1536628742),
(34, 1, '添加快捷菜单', 'admin/menu/quick', '{"id":"209"}', '浏览数据', 4, '127.0.0.1', 1536629258, 1536838297),
(35, 1, '添加会员', 'admin/member/add', '[]', '浏览数据', 1, '127.0.0.1', 1536629522, 1536629522),
(36, 1, '在线升级', 'admin/upgrade/index', '[]', '浏览数据', 1, '127.0.0.1', 1536629546, 1536629546),
(37, 1, '状态设置', 'admin/menu/status', '{"val":"1","table":"admin_menu","ids":"209"}', '浏览数据', 56, '127.0.0.1', 1536629606, 1537349291),
(38, 1, '添加角色', 'admin/user/addrole', '[]', '浏览数据', 11, '127.0.0.1', 1536629637, 1536838087),
(39, 1, '添加角色', 'admin/user/addrole', '{"name":"\\u5b66\\u6821\\u6743\\u9650","intro":"\\u67e5\\u770b\\u81ea\\u5df1\\u5b66\\u6821\\u7684\\u8001\\u5e08\\u548c\\u5e2e\\u6276\\u7684\\u5b66\\u751f","status":"1","auth":{"5":"2","30":"203","37":"209","38":"210","39":"211"},"id":""}', '保存数据', 3, '127.0.0.1', 1536629681, 1536837581),
(40, 1, '修改会员', 'admin/member/edit', '{"id":"1000000"}', '浏览数据', 1, '127.0.0.1', 1536629818, 1536629818),
(41, 1, '修改会员', 'admin/member/edit', '{"level_id":"1","username":"test","nick":"root","password":"123","email":"","mobile":"0","expire_time":"2018-09-29","status":"1","id":"1000000"}', '保存数据', 1, '127.0.0.1', 1536629854, 1536629854),
(42, 1, '修改角色', 'admin/user/editrole', '{"id":"2"}', '浏览数据', 10, '127.0.0.1', 1536631464, 1537349022),
(43, 1, '修改菜单', 'admin/menu/edit', '{"id":"209","mod":"admin"}', '浏览数据', 44, '127.0.0.1', 1536631972, 1537349537),
(44, 1, '添加菜单', 'admin/menu/add', '{"pid":"1","title":"\\u5e2e\\u6276\\u5b66\\u751f","icon":"aicon ai-huiyuandengji","url":"admin\\/student\\/add","param":"","status":"1","system":"1","nav":"1","id":"","module":"admin"}', '保存数据', 10, '127.0.0.1', 1536632432, 1536836867),
(45, 1, '学校', 'admin/School/index', '{"page":"1","limit":"10"}', '浏览数据', 458, '127.0.0.1', 1536632447, 1537521577),
(46, 1, '修改菜单', 'admin/menu/edit', '{"pid":"203","title":"\\u6559\\u5e08","icon":"aicon ai-huiyuanliebiao","url":"admin\\/teacher\\/index","param":"","status":"1","system":"1","nav":"1","id":"209","module":"admin"}', '保存数据', 9, '127.0.0.1', 1536633095, 1537349549),
(47, 1, '排序设置', 'admin/menu/sort', '{"val":"1","table":"admin_menu","ids":"203"}', '保存数据', 1, '127.0.0.1', 1536633305, 1536633305),
(48, 1, '添加', 'admin/school/addschool', '[]', '浏览数据', 48, '127.0.0.1', 1536634924, 1536895518),
(49, 1, '添加', 'admin/school/addschool', '{"title":"\\u5b9d\\u9e21\\u5927\\u5199","status":"1","id":""}', '保存数据', 37, '127.0.0.1', 1536636340, 1536825332),
(50, 1, '添加管理员', 'admin/user/adduser', '{"role_id":"4","username":"ceshi","nick":"df","password":"123123","password_confirm":"123123","email":"789123","mobile":"798","status":"1","id":""}', '保存数据', 9, '127.0.0.1', 1536657779, 1537350919),
(51, 1, '状态设置', 'admin/user/status', '{"table":"admin_school","id":"1","val":"0"}', '浏览数据', 15, '127.0.0.1', 1536660867, 1536662818),
(52, 1, '修改角色', 'admin/user/editrole', '{"name":"\\u6559\\u5e08\\u89d2\\u8272","intro":"\\u67e5\\u770b\\u81ea\\u5df1\\u5e2e\\u6276\\u5b66\\u751f","status":"1","auth":{"0":"1","1":"4","3":"24","4":"105","5":"2","30":"203","39":"211"},"id":"3"}', '保存数据', 3, '127.0.0.1', 1536662382, 1536838186),
(53, 1, '状态设置', 'admin/school/status', '{"table":"admin_school","id":"3","val":"1"}', '浏览数据', 10, '127.0.0.1', 1536663403, 1536838324),
(54, 1, '修改学校', 'admin/school/editSchool', '{"id":"12"}', '浏览数据', 10, '127.0.0.1', 1536663812, 1536838422),
(55, 1, '修改学校', 'admin/school/editSchool', '{"title":"\\u67d0\\u5b66\\u6821123","status":"1","id":"1"}', '保存数据', 7, '127.0.0.1', 1536664359, 1536664886),
(56, 1, '状态设置', 'admin/school/status', '{"id":["2"],"table":"admin_school","val":"0"}', '保存数据', 3, '127.0.0.1', 1536665054, 1536665682),
(57, 1, '删除学校', 'admin/school/delschool', '{"id":"1"}', '浏览数据', 1, '127.0.0.1', 1536665506, 1536665506),
(58, 1, '删除学校', 'admin/school/delschool', '{"id":["2"]}', '保存数据', 1, '127.0.0.1', 1536665688, 1536665688),
(59, 1, '清空缓存', 'admin/index/clear', '[]', '浏览数据', 5, '127.0.0.1', 1536727604, 1537348609),
(60, 1, '批量导入excel', 'admin/school/importSchool', '[]', '浏览数据', 4, '127.0.0.1', 1536730498, 1536730746),
(61, 1, '批量导入学校', 'admin/school/importSchool', '[]', '浏览数据', 69, '127.0.0.1', 1536730787, 1536899869),
(62, 1, '批量导入学校', 'admin/school/importSchool', '{"id":""}', '保存数据', 79, '127.0.0.1', 1536734515, 1536838410),
(63, 1, '附件上传', 'admin/annex/upload', '[]', '浏览数据', 2, '127.0.0.1', 1536736296, 1536736310),
(64, 1, '修改管理员', 'admin/user/edituser', '{"id":"3"}', '浏览数据', 3, '127.0.0.1', 1536823621, 1536839758),
(65, 1, '修改管理员', 'admin/user/edituser', '{"role_id":"2","username":"ssd","nick":"\\u5730\\u65b9","password":"","password_confirm":"","email":"","mobile":"","status":"1","auth":{"0":"1","1":"4","2":"25","3":"24","5":"2","6":"6","7":"12","8":"26","9":"27","10":"28","11":"29","12":"30","13":"31","14":"32","15":"13","16":"33","17":"34","18":"35","19":"36","20":"14","21":"37","22":"38","23":"39","24":"40","25":"41","30":"203","31":"202","32":"204","37":"209"},"id":"2"}', '保存数据', 1, '127.0.0.1', 1536823634, 1536823634),
(66, 1, '教师', 'admin/teacher/index', '{"page":"1","limit":"20"}', '浏览数据', 156, '127.0.0.1', 1536825021, 1537521575),
(67, 1, '添加教师', 'admin/teacher/addteacher', '[]', '浏览数据', 26, '127.0.0.1', 1536830581, 1537350456),
(68, 1, '添加教师', 'admin/teacher/addteacher', '{"role_id":"3","username":"\\u5218\\u8001\\u5e08","nick":"\\u9ad8\\u7ea7\\u6559\\u5e08","email":"794227312@qq.com","mobile":"13521165109","birthday":"1992.3.26","status":"1","id":""}', '保存数据', 3, '127.0.0.1', 1536836475, 1537350760),
(69, 3, '后台首页', 'admin/index/index', '[]', '浏览数据', 7, '127.0.0.1', 1536838203, 1536838222),
(70, 1, '设计模块', 'admin/module/design', '[]', '浏览数据', 1, '127.0.0.1', 1536894587, 1536894587);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_member`
--

CREATE TABLE IF NOT EXISTS `sup_admin_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员等级ID',
  `nick` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `mobile` bigint(11) unsigned NOT NULL DEFAULT '0' COMMENT '手机号',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `password` varchar(128) NOT NULL COMMENT '密码',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '可用金额',
  `frozen_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '冻结金额',
  `income` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '收入统计',
  `expend` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '开支统计',
  `exper` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '经验值',
  `integral` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `frozen_integral` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '冻结积分',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '性别(1男，0女)',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `last_login_ip` varchar(128) NOT NULL DEFAULT '' COMMENT '最后登陆IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `login_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `expire_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '到期时间(0永久)',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0禁用，1正常)',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 会员表' AUTO_INCREMENT=1000001 ;

--
-- 转存表中的数据 `sup_admin_member`
--

INSERT INTO `sup_admin_member` (`id`, `level_id`, `nick`, `username`, `mobile`, `email`, `password`, `money`, `frozen_money`, `income`, `expend`, `exper`, `integral`, `frozen_integral`, `sex`, `avatar`, `last_login_ip`, `last_login_time`, `login_count`, `expire_time`, `status`, `ctime`) VALUES
(1000000, 1, '', 'test', 0, '', '$2y$10$WC0mMyErW1u1JCLXDCbTIuagCceC/kKpjzvCf.cxrVKaxsrZLXrGe', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 1, '', '', 0, 0, 0, 1, 1493274686);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_member_level`
--

CREATE TABLE IF NOT EXISTS `sup_admin_member_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL COMMENT '等级名称',
  `min_exper` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最小经验值',
  `max_exper` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最大经验值',
  `discount` int(2) unsigned NOT NULL DEFAULT '100' COMMENT '折扣率(%)',
  `intro` varchar(255) NOT NULL COMMENT '等级简介',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '默认等级',
  `expire` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员有效期(天)',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='[系统] 会员等级' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sup_admin_member_level`
--

INSERT INTO `sup_admin_member_level` (`id`, `name`, `min_exper`, `max_exper`, `discount`, `intro`, `default`, `expire`, `status`, `ctime`, `mtime`) VALUES
(1, '注册会员', 0, 0, 100, '', 1, 0, 1, 0, 1491966814);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_menu`
--

CREATE TABLE IF NOT EXISTS `sup_admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID(快捷菜单专用)',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `module` varchar(20) NOT NULL COMMENT '模块名或插件名，插件名格式:plugins.插件名',
  `title` varchar(20) NOT NULL COMMENT '菜单标题',
  `icon` varchar(80) NOT NULL DEFAULT 'aicon ai-shezhi' COMMENT '菜单图标',
  `url` varchar(200) NOT NULL COMMENT '链接地址(模块/控制器/方法)',
  `param` varchar(200) NOT NULL DEFAULT '' COMMENT '扩展参数',
  `target` varchar(20) NOT NULL DEFAULT '_self' COMMENT '打开方式(_blank,_self)',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `debug` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '开发模式可见',
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统菜单，系统菜单不可删除',
  `nav` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否为菜单显示，1显示0不显示',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态1显示，0隐藏',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 管理菜单' AUTO_INCREMENT=213 ;

--
-- 转存表中的数据 `sup_admin_menu`
--

INSERT INTO `sup_admin_menu` (`id`, `uid`, `pid`, `module`, `title`, `icon`, `url`, `param`, `target`, `sort`, `debug`, `system`, `nav`, `status`, `ctime`) VALUES
(1, 0, 0, 'admin', '首页', '', 'admin/index', '', '_self', 0, 0, 1, 1, 1, 1490315067),
(2, 0, 0, 'admin', '系统', '', 'admin/system', '', '_self', 0, 0, 1, 1, 1, 1490315067),
(3, 0, 0, 'admin', '插件', 'aicon ai-shezhi', 'admin/plugins', '', '_self', 0, 0, 1, 1, 0, 1490315067),
(4, 0, 1, 'admin', '快捷菜单', 'aicon ai-caidan', 'admin/quick', '', '_self', 0, 0, 1, 1, 1, 1490315067),
(5, 0, 3, 'admin', '插件列表', 'aicon ai-mokuaiguanli', 'admin/plugins', '', '_self', 0, 0, 1, 1, 0, 1490315067),
(6, 0, 2, 'admin', '系统功能', 'aicon ai-gongneng', 'admin/system', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(7, 0, 2, 'admin', '会员管理', 'aicon ai-huiyuanliebiao', 'admin/member', '', '_self', 2, 0, 1, 1, 0, 1490315067),
(8, 0, 2, 'admin', '系统扩展', 'aicon ai-shezhi', 'admin/extend', '', '_self', 3, 0, 1, 1, 0, 1490315067),
(9, 0, 2, 'admin', '预留占位', '', '', '', '_self', 4, 1, 1, 1, 0, 1490315067),
(10, 0, 6, 'admin', '系统设置', 'aicon ai-icon01', 'admin/system/index', '', '_self', 1, 0, 1, 1, 0, 1490315067),
(11, 0, 6, 'admin', '配置管理', 'aicon ai-peizhiguanli', 'admin/config/index', '', '_self', 2, 0, 1, 1, 0, 1490315067),
(12, 0, 6, 'admin', '系统菜单', 'aicon ai-systemmenu', 'admin/menu/index', '', '_self', 3, 0, 1, 1, 1, 1490315067),
(13, 0, 6, 'admin', '管理员角色', '', 'admin/user/role', '', '_self', 4, 0, 1, 0, 1, 1490315067),
(14, 0, 6, 'admin', '系统管理员', 'aicon ai-tubiao05', 'admin/user/index', '', '_self', 5, 0, 1, 1, 1, 1490315067),
(15, 0, 6, 'admin', '系统日志', 'aicon ai-xitongrizhi-tiaoshi', 'admin/log/index', '', '_self', 6, 0, 1, 1, 0, 1490315067),
(16, 0, 6, 'admin', '附件管理', '', 'admin/annex/index', '', '_self', 7, 0, 1, 0, 1, 1490315067),
(17, 0, 8, 'admin', '模块管理', 'aicon ai-mokuaiguanli1', 'admin/module/index', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(18, 0, 8, 'admin', '插件管理', 'aicon ai-chajianguanli', 'admin/plugins/index', '', '_self', 2, 0, 1, 1, 0, 1490315067),
(19, 0, 8, 'admin', '钩子管理', 'aicon ai-icon-test', 'admin/hook/index', '', '_self', 3, 0, 1, 1, 0, 1490315067),
(20, 0, 7, 'admin', '会员等级', 'aicon ai-huiyuandengji', 'admin/member/level', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(21, 0, 7, 'admin', '会员列表', 'aicon ai-huiyuanliebiao', 'admin/member/index', '', '_self', 2, 0, 1, 1, 1, 1490315067),
(22, 0, 9, 'admin', '预留占位', '', '', '', '_self', 1, 1, 1, 1, 0, 1490315067),
(23, 0, 9, 'admin', '预留占位', '', '', '', '_self', 2, 1, 1, 1, 0, 1490315067),
(24, 0, 4, 'admin', '后台首页', '', 'admin/index/index', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(25, 0, 4, 'admin', '清空缓存', '', 'admin/index/clear', '', '_self', 2, 0, 1, 0, 1, 1490315067),
(26, 0, 12, 'admin', '添加菜单', '', 'admin/menu/add', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(27, 0, 12, 'admin', '修改菜单', '', 'admin/menu/edit', '', '_self', 2, 0, 1, 1, 1, 1490315067),
(28, 0, 12, 'admin', '删除菜单', '', 'admin/menu/del', '', '_self', 3, 0, 1, 1, 1, 1490315067),
(29, 0, 12, 'admin', '状态设置', '', 'admin/menu/status', '', '_self', 4, 0, 1, 1, 1, 1490315067),
(30, 0, 12, 'admin', '排序设置', '', 'admin/menu/sort', '', '_self', 5, 0, 1, 1, 1, 1490315067),
(31, 0, 12, 'admin', '添加快捷菜单', '', 'admin/menu/quick', '', '_self', 6, 0, 1, 1, 1, 1490315067),
(32, 0, 12, 'admin', '导出菜单', '', 'admin/menu/export', '', '_self', 7, 0, 1, 1, 1, 1490315067),
(33, 0, 13, 'admin', '添加角色', '', 'admin/user/addrole', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(34, 0, 13, 'admin', '修改角色', '', 'admin/user/editrole', '', '_self', 2, 0, 1, 1, 1, 1490315067),
(35, 0, 13, 'admin', '删除角色', '', 'admin/user/delrole', '', '_self', 3, 0, 1, 1, 1, 1490315067),
(36, 0, 13, 'admin', '状态设置', '', 'admin/user/status', '', '_self', 4, 0, 1, 1, 1, 1490315067),
(37, 0, 14, 'admin', '添加管理员', '', 'admin/user/adduser', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(38, 0, 14, 'admin', '修改管理员', '', 'admin/user/edituser', '', '_self', 2, 0, 1, 1, 1, 1490315067),
(39, 0, 14, 'admin', '删除管理员', '', 'admin/user/deluser', '', '_self', 3, 0, 1, 1, 1, 1490315067),
(40, 0, 14, 'admin', '状态设置', '', 'admin/user/status', '', '_self', 4, 0, 1, 1, 1, 1490315067),
(41, 0, 14, 'admin', '个人信息设置', '', 'admin/user/info', '', '_self', 5, 0, 1, 1, 1, 1490315067),
(42, 0, 18, 'admin', '安装插件', '', 'admin/plugins/install', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(43, 0, 18, 'admin', '卸载插件', '', 'admin/plugins/uninstall', '', '_self', 2, 0, 1, 1, 1, 1490315067),
(44, 0, 18, 'admin', '删除插件', '', 'admin/plugins/del', '', '_self', 3, 0, 1, 1, 1, 1490315067),
(45, 0, 18, 'admin', '状态设置', '', 'admin/plugins/status', '', '_self', 4, 0, 1, 1, 1, 1490315067),
(46, 0, 18, 'admin', '设计插件', '', 'admin/plugins/design', '', '_self', 5, 0, 1, 1, 1, 1490315067),
(47, 0, 18, 'admin', '运行插件', '', 'admin/plugins/run', '', '_self', 6, 0, 1, 1, 1, 1490315067),
(48, 0, 18, 'admin', '更新插件', '', 'admin/plugins/update', '', '_self', 7, 0, 1, 1, 1, 1490315067),
(49, 0, 18, 'admin', '插件配置', '', 'admin/plugins/setting', '', '_self', 8, 0, 1, 1, 1, 1490315067),
(50, 0, 19, 'admin', '添加钩子', '', 'admin/hook/add', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(51, 0, 19, 'admin', '修改钩子', '', 'admin/hook/edit', '', '_self', 2, 0, 1, 1, 1, 1490315067),
(52, 0, 19, 'admin', '删除钩子', '', 'admin/hook/del', '', '_self', 3, 0, 1, 1, 1, 1490315067),
(53, 0, 19, 'admin', '状态设置', '', 'admin/hook/status', '', '_self', 4, 0, 1, 1, 1, 1490315067),
(54, 0, 19, 'admin', '插件排序', '', 'admin/hook/sort', '', '_self', 5, 0, 1, 1, 1, 1490315067),
(55, 0, 11, 'admin', '添加配置', '', 'admin/config/add', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(56, 0, 11, 'admin', '修改配置', '', 'admin/config/edit', '', '_self', 2, 0, 1, 1, 1, 1490315067),
(57, 0, 11, 'admin', '删除配置', '', 'admin/config/del', '', '_self', 3, 0, 1, 1, 1, 1490315067),
(58, 0, 11, 'admin', '状态设置', '', 'admin/config/status', '', '_self', 4, 0, 1, 1, 1, 1490315067),
(59, 0, 11, 'admin', '排序设置', '', 'admin/config/sort', '', '_self', 5, 0, 1, 1, 1, 1490315067),
(60, 0, 10, 'admin', '基础配置', '', 'admin/system/index', 'group=base', '_self', 1, 0, 1, 1, 0, 1490315067),
(61, 0, 10, 'admin', '系统配置', '', 'admin/system/index', 'group=sys', '_self', 2, 0, 1, 1, 0, 1490315067),
(62, 0, 10, 'admin', '上传配置', '', 'admin/system/index', 'group=upload', '_self', 3, 0, 1, 1, 0, 1490315067),
(63, 0, 10, 'admin', '开发配置', '', 'admin/system/index', 'group=develop', '_self', 4, 0, 1, 1, 0, 1490315067),
(64, 0, 17, 'admin', '设计模块', '', 'admin/module/design', '', '_self', 6, 1, 1, 1, 1, 1490315067),
(65, 0, 17, 'admin', '安装模块', '', 'admin/module/install', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(66, 0, 17, 'admin', '卸载模块', '', 'admin/module/uninstall', '', '_self', 2, 0, 1, 1, 1, 1490315067),
(67, 0, 17, 'admin', '状态设置', '', 'admin/module/status', '', '_self', 3, 0, 1, 1, 1, 1490315067),
(68, 0, 17, 'admin', '设置默认模块', '', 'admin/module/setdefault', '', '_self', 4, 0, 1, 1, 1, 1490315067),
(69, 0, 17, 'admin', '删除模块', '', 'admin/module/del', '', '_self', 5, 0, 1, 1, 1, 1490315067),
(70, 0, 21, 'admin', '添加会员', '', 'admin/member/add', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(71, 0, 21, 'admin', '修改会员', '', 'admin/member/edit', '', '_self', 2, 0, 1, 1, 1, 1490315067),
(72, 0, 21, 'admin', '删除会员', '', 'admin/member/del', '', '_self', 3, 0, 1, 1, 1, 1490315067),
(73, 0, 21, 'admin', '状态设置', '', 'admin/member/status', '', '_self', 4, 0, 1, 1, 1, 1490315067),
(74, 0, 21, 'admin', '[弹窗]会员选择', '', 'admin/member/pop', '', '_self', 5, 0, 1, 1, 1, 1490315067),
(75, 0, 20, 'admin', '添加会员等级', '', 'admin/member/addlevel', '', '_self', 0, 0, 1, 1, 1, 1490315067),
(76, 0, 20, 'admin', '修改会员等级', '', 'admin/member/editlevel', '', '_self', 0, 0, 1, 1, 1, 1490315067),
(77, 0, 20, 'admin', '删除会员等级', '', 'admin/member/dellevel', '', '_self', 0, 0, 1, 1, 1, 1490315067),
(78, 0, 16, 'admin', '附件上传', '', 'admin/annex/upload', '', '_self', 1, 0, 1, 1, 1, 1490315067),
(79, 0, 16, 'admin', '删除附件', '', 'admin/annex/del', '', '_self', 2, 0, 1, 1, 1, 1490315067),
(80, 0, 8, 'admin', '在线升级', 'aicon ai-iconfontshengji', 'admin/upgrade/index', '', '_self', 4, 0, 1, 1, 0, 1491352728),
(81, 0, 80, 'admin', '获取升级列表', '', 'admin/upgrade/lists', '', '_self', 0, 0, 1, 1, 1, 1491353504),
(82, 0, 80, 'admin', '安装升级包', '', 'admin/upgrade/install', '', '_self', 0, 0, 1, 1, 1, 1491353568),
(83, 0, 80, 'admin', '下载升级包', '', 'admin/upgrade/download', '', '_self', 0, 0, 1, 1, 1, 1491395830),
(84, 0, 6, 'admin', '数据库管理', 'aicon ai-shujukuguanli', 'admin/database/index', '', '_self', 8, 0, 1, 1, 0, 1491461136),
(85, 0, 84, 'admin', '备份数据库', '', 'admin/database/export', '', '_self', 0, 0, 1, 1, 1, 1491461250),
(86, 0, 84, 'admin', '恢复数据库', '', 'admin/database/import', '', '_self', 0, 0, 1, 1, 1, 1491461315),
(87, 0, 84, 'admin', '优化数据库', '', 'admin/database/optimize', '', '_self', 0, 0, 1, 1, 1, 1491467000),
(88, 0, 84, 'admin', '删除备份', '', 'admin/database/del', '', '_self', 0, 0, 1, 1, 1, 1491467058),
(89, 0, 84, 'admin', '修复数据库', '', 'admin/database/repair', '', '_self', 0, 0, 1, 1, 1, 1491880879),
(90, 0, 21, 'admin', '设置默认等级', '', 'admin/member/setdefault', '', '_self', 0, 0, 1, 1, 1, 1491966585),
(91, 0, 10, 'admin', '数据库配置', '', 'admin/system/index', 'group=databases', '_self', 5, 0, 1, 0, 0, 1492072213),
(92, 0, 17, 'admin', '模块打包', '', 'admin/module/package', '', '_self', 7, 0, 1, 1, 1, 1492134693),
(93, 0, 18, 'admin', '插件打包', '', 'admin/plugins/package', '', '_self', 0, 0, 1, 1, 1, 1492134743),
(94, 0, 17, 'admin', '主题管理', '', 'admin/module/theme', '', '_self', 8, 0, 1, 1, 1, 1492433470),
(95, 0, 17, 'admin', '设置默认主题', '', 'admin/module/setdefaulttheme', '', '_self', 9, 0, 1, 1, 1, 1492433618),
(96, 0, 17, 'admin', '删除主题', '', 'admin/module/deltheme', '', '_self', 10, 0, 1, 1, 1, 1490315067),
(97, 0, 6, 'admin', '语言包管理', '', 'admin/language/index', '', '_self', 11, 0, 1, 0, 0, 1490315067),
(98, 0, 97, 'admin', '添加语言包', '', 'admin/language/add', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(99, 0, 97, 'admin', '修改语言包', '', 'admin/language/edit', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(100, 0, 97, 'admin', '删除语言包', '', 'admin/language/del', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(101, 0, 97, 'admin', '排序设置', '', 'admin/language/sort', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(102, 0, 97, 'admin', '状态设置', '', 'admin/language/status', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(103, 0, 16, 'admin', '收藏夹图标上传', '', 'admin/annex/favicon', '', '_self', 3, 0, 1, 0, 1, 1490315067),
(104, 0, 17, 'admin', '导入模块', '', 'admin/module/import', '', '_self', 11, 0, 1, 0, 1, 1490315067),
(105, 0, 4, 'admin', '后台首页', '', 'admin/index/welcome', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(106, 0, 4, 'admin', '布局切换', '', 'admin/user/iframe', '', '_self', 100, 0, 1, 0, 0, 1490315067),
(107, 0, 15, 'admin', '删除日志', '', 'admin/log/del', 'table=admin_log', '_self', 100, 0, 1, 0, 1, 1490315067),
(108, 0, 15, 'admin', '清空日志', '', 'admin/log/clear', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(109, 0, 17, 'admin', '编辑模块', '', 'admin/module/edit', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(110, 0, 17, 'admin', '模块图标上传', '', 'admin/module/icon', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(111, 0, 18, 'admin', '导入插件', '', 'admin/plugins/import', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(112, 0, 19, 'admin', '钩子插件状态', '', 'admin/hook/hookPluginsStatus', '', '_self', 100, 0, 1, 0, 1, 1490315067),
(113, 0, 4, 'admin', '设置主题', '', 'admin/user/setTheme', '', '_self', 100, 0, 1, 0, 0, 1490315067),
(114, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(115, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(116, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(117, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(118, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(119, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(120, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(121, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(122, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(123, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(124, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(125, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(126, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(127, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(128, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(129, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(130, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(131, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(132, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(133, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(134, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(135, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(136, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(137, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(138, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(139, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(140, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(141, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(142, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(143, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(144, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(145, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(146, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(147, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(148, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(149, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(150, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(151, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(152, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(153, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(154, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(155, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(156, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(157, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(158, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(159, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(160, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(161, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(162, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(163, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(164, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(165, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(166, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(167, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(168, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(169, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(170, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(171, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(172, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(173, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(174, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(175, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(176, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(177, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(178, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(179, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(180, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(181, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(182, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(183, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(184, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(185, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(186, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(187, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(188, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(189, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(190, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(191, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(192, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(193, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(194, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(195, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(196, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(197, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(198, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(199, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(200, 0, 4, 'admin', '预留占位', '', '', '', '_self', 100, 0, 1, 1, 0, 1490315067),
(201, 1, 4, 'admin', '系统菜单', 'aicon ai-systemmenu', 'admin/menu/index', '', '_self', 3, 0, 0, 1, 1, 1536629258),
(202, 0, 203, 'admin', '学校', 'aicon ai-shouyeshouye', 'admin/School/index', '', '_self', 0, 0, 0, 1, 1, 1536632432),
(203, 0, 2, 'admin', '扶贫功能', 'aicon ai-icon01', 'admin/school/index', '', '_self', 1, 0, 0, 1, 1, 1536633290),
(204, 0, 202, 'admin', '添加', '', 'admin/school/addschool', '', '_self', 0, 0, 1, 1, 1, 1536634914),
(205, 0, 202, 'admin', '状态设置', '', 'admin/school/status', '', '_self', 0, 0, 1, 1, 1, 1536663385),
(206, 0, 202, 'admin', '修改学校', '', 'admin/school/editSchool', '', '_self', 0, 0, 1, 1, 1, 1536663666),
(207, 0, 202, 'admin', '删除学校', '', 'admin/school/delschool', '', '_self', 0, 0, 1, 1, 1, 1536665191),
(208, 0, 202, 'admin', '批量导入学校', '', 'admin/school/importSchool', '', '_self', 0, 0, 1, 1, 1, 1536729958),
(209, 0, 203, 'admin', '教师', 'aicon ai-huiyuanliebiao', 'admin/teacher/index', '', '_self', 0, 0, 1, 1, 1, 1536823597),
(210, 0, 209, 'admin', '添加教师', '', 'admin/teacher/addteacher', '', '_self', 0, 0, 1, 1, 1, 1536830421),
(211, 0, 203, 'admin', '帮扶学生', 'aicon ai-huiyuandengji', 'admin/student/add', '', '_self', 0, 0, 1, 1, 1, 1536836867);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_menu_lang`
--

CREATE TABLE IF NOT EXISTS `sup_admin_menu_lang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '标题',
  `lang` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '语言包',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=331 ;

--
-- 转存表中的数据 `sup_admin_menu_lang`
--

INSERT INTO `sup_admin_menu_lang` (`id`, `menu_id`, `title`, `lang`) VALUES
(131, 1, '首页', 1),
(132, 2, '系统', 1),
(133, 3, '插件', 1),
(134, 4, '快捷菜单', 1),
(135, 5, '插件列表', 1),
(136, 6, '系统功能', 1),
(137, 7, '会员管理', 1),
(138, 8, '系统扩展', 1),
(139, 9, '预留占位', 1),
(140, 10, '系统设置', 1),
(141, 11, '配置管理', 1),
(142, 12, '系统菜单', 1),
(143, 13, '管理员角色', 1),
(144, 14, '系统管理员', 1),
(145, 15, '系统日志', 1),
(146, 16, '附件管理', 1),
(147, 17, '模块管理', 1),
(148, 18, '插件管理', 1),
(149, 19, '钩子管理', 1),
(150, 20, '会员等级', 1),
(151, 21, '会员列表', 1),
(152, 22, '预留占位', 1),
(153, 23, '预留占位', 1),
(154, 24, '后台首页', 1),
(155, 25, '清空缓存', 1),
(156, 26, '添加菜单', 1),
(157, 27, '修改菜单', 1),
(158, 28, '删除菜单', 1),
(159, 29, '状态设置', 1),
(160, 30, '排序设置', 1),
(161, 31, '添加快捷菜单', 1),
(162, 32, '导出菜单', 1),
(163, 33, '添加角色', 1),
(164, 34, '修改角色', 1),
(165, 35, '删除角色', 1),
(166, 36, '状态设置', 1),
(167, 37, '添加管理员', 1),
(168, 38, '修改管理员', 1),
(169, 39, '删除管理员', 1),
(170, 40, '状态设置', 1),
(171, 41, '个人信息设置', 1),
(172, 42, '安装插件', 1),
(173, 43, '卸载插件', 1),
(174, 44, '删除插件', 1),
(175, 45, '状态设置', 1),
(176, 46, '设计插件', 1),
(177, 47, '运行插件', 1),
(178, 48, '更新插件', 1),
(179, 49, '插件配置', 1),
(180, 50, '添加钩子', 1),
(181, 51, '修改钩子', 1),
(182, 52, '删除钩子', 1),
(183, 53, '状态设置', 1),
(184, 54, '插件排序', 1),
(185, 55, '添加配置', 1),
(186, 56, '修改配置', 1),
(187, 57, '删除配置', 1),
(188, 58, '状态设置', 1),
(189, 59, '排序设置', 1),
(190, 60, '基础配置', 1),
(191, 61, '系统配置', 1),
(192, 62, '上传配置', 1),
(193, 63, '开发配置', 1),
(194, 64, '设计模块', 1),
(195, 65, '安装模块', 1),
(196, 66, '卸载模块', 1),
(197, 67, '状态设置', 1),
(198, 68, '设置默认模块', 1),
(199, 69, '删除模块', 1),
(200, 70, '添加会员', 1),
(201, 71, '修改会员', 1),
(202, 72, '删除会员', 1),
(203, 73, '状态设置', 1),
(204, 74, '[弹窗]会员选择', 1),
(205, 75, '添加会员等级', 1),
(206, 76, '修改会员等级', 1),
(207, 77, '删除会员等级', 1),
(208, 78, '附件上传', 1),
(209, 79, '删除附件', 1),
(210, 80, '在线升级', 1),
(211, 81, '获取升级列表', 1),
(212, 82, '安装升级包', 1),
(213, 83, '下载升级包', 1),
(214, 84, '数据库管理', 1),
(215, 85, '备份数据库', 1),
(216, 86, '恢复数据库', 1),
(217, 87, '优化数据库', 1),
(218, 88, '删除备份', 1),
(219, 89, '修复数据库', 1),
(220, 90, '设置默认等级', 1),
(221, 91, '数据库配置', 1),
(222, 92, '模块打包', 1),
(223, 93, '插件打包', 1),
(224, 94, '主题管理', 1),
(225, 95, '设置默认主题', 1),
(226, 96, '删除主题', 1),
(227, 97, '语言包管理', 1),
(228, 98, '添加语言包', 1),
(229, 99, '修改语言包', 1),
(230, 100, '删除语言包', 1),
(231, 101, '排序设置', 1),
(232, 102, '状态设置', 1),
(233, 103, '收藏夹图标上传', 1),
(234, 104, '导入模块', 1),
(235, 105, '欢迎页面', 1),
(236, 106, '布局切换', 1),
(237, 107, '删除日志', 1),
(238, 108, '清空日志', 1),
(239, 109, '编辑模块', 1),
(240, 110, '模块图标上传', 1),
(241, 111, '导入插件', 1),
(242, 112, '预留占位', 1),
(243, 113, '预留占位', 1),
(244, 114, '预留占位', 1),
(245, 115, '预留占位', 1),
(246, 116, '预留占位', 1),
(247, 117, '预留占位', 1),
(248, 118, '预留占位', 1),
(249, 119, '预留占位', 1),
(250, 120, '预留占位', 1),
(251, 121, '预留占位', 1),
(252, 122, '预留占位', 1),
(253, 123, '预留占位', 1),
(254, 124, '预留占位', 1),
(255, 125, '预留占位', 1),
(256, 126, '预留占位', 1),
(257, 127, '预留占位', 1),
(258, 128, '预留占位', 1),
(259, 129, '预留占位', 1),
(260, 130, '预留占位', 1),
(261, 131, '预留占位', 1),
(262, 132, '预留占位', 1),
(263, 133, '预留占位', 1),
(264, 134, '预留占位', 1),
(265, 135, '预留占位', 1),
(266, 136, '预留占位', 1),
(267, 137, '预留占位', 1),
(268, 138, '预留占位', 1),
(269, 139, '预留占位', 1),
(270, 140, '预留占位', 1),
(271, 141, '预留占位', 1),
(272, 142, '预留占位', 1),
(273, 143, '预留占位', 1),
(274, 144, '预留占位', 1),
(275, 145, '预留占位', 1),
(276, 146, '预留占位', 1),
(277, 147, '预留占位', 1),
(278, 148, '预留占位', 1),
(279, 149, '预留占位', 1),
(280, 150, '预留占位', 1),
(281, 151, '预留占位', 1),
(282, 152, '预留占位', 1),
(283, 153, '预留占位', 1),
(284, 154, '预留占位', 1),
(285, 155, '预留占位', 1),
(286, 156, '预留占位', 1),
(287, 157, '预留占位', 1),
(288, 158, '预留占位', 1),
(289, 159, '预留占位', 1),
(290, 160, '预留占位', 1),
(291, 161, '预留占位', 1),
(292, 162, '预留占位', 1),
(293, 163, '预留占位', 1),
(294, 164, '预留占位', 1),
(295, 165, '预留占位', 1),
(296, 166, '预留占位', 1),
(297, 167, '预留占位', 1),
(298, 168, '预留占位', 1),
(299, 169, '预留占位', 1),
(300, 170, '预留占位', 1),
(301, 171, '预留占位', 1),
(302, 172, '预留占位', 1),
(303, 173, '预留占位', 1),
(304, 174, '预留占位', 1),
(305, 175, '预留占位', 1),
(306, 176, '预留占位', 1),
(307, 177, '预留占位', 1),
(308, 178, '预留占位', 1),
(309, 179, '预留占位', 1),
(310, 180, '预留占位', 1),
(311, 181, '预留占位', 1),
(312, 182, '预留占位', 1),
(313, 183, '预留占位', 1),
(314, 184, '预留占位', 1),
(315, 185, '预留占位', 1),
(316, 186, '预留占位', 1),
(317, 187, '预留占位', 1),
(318, 188, '预留占位', 1),
(319, 189, '预留占位', 1),
(320, 190, '预留占位', 1),
(321, 191, '预留占位', 1),
(322, 192, '预留占位', 1),
(323, 193, '预留占位', 1),
(324, 194, '预留占位', 1),
(325, 195, '预留占位', 1),
(326, 196, '预留占位', 1),
(327, 197, '预留占位', 1),
(328, 198, '预留占位', 1),
(329, 199, '预留占位', 1),
(330, 200, '预留占位', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_module`
--

CREATE TABLE IF NOT EXISTS `sup_admin_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统模块',
  `name` varchar(50) NOT NULL COMMENT '模块名(英文)',
  `identifier` varchar(100) NOT NULL COMMENT '模块标识(模块名(字母).开发者标识.module)',
  `title` varchar(50) NOT NULL COMMENT '模块标题',
  `intro` varchar(255) NOT NULL COMMENT '模块简介',
  `author` varchar(100) NOT NULL COMMENT '作者',
  `icon` varchar(80) NOT NULL DEFAULT 'aicon ai-mokuaiguanli' COMMENT '图标',
  `version` varchar(20) NOT NULL COMMENT '版本号',
  `url` varchar(255) NOT NULL COMMENT '链接',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未安装，1未启用，2已启用',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '默认模块(只能有一个)',
  `config` text NOT NULL COMMENT '配置',
  `app_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '应用市场ID(0本地)',
  `app_keys` varchar(200) DEFAULT '' COMMENT '应用秘钥',
  `theme` varchar(50) NOT NULL DEFAULT 'default' COMMENT '主题模板',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='[系统] 模块' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `sup_admin_module`
--

INSERT INTO `sup_admin_module` (`id`, `system`, `name`, `identifier`, `title`, `intro`, `author`, `icon`, `version`, `url`, `sort`, `status`, `default`, `config`, `app_id`, `app_keys`, `theme`, `ctime`, `mtime`) VALUES
(1, 1, 'admin', 'admin.hisiphp.module', '系统管理模块', '系统核心模块，用于后台各项管理功能模块及功能拓展', 'HisiPHP官方出品', '', '1.0.0', 'http://www.hisiphp.com', 0, 2, 0, '', '0', '', 'default', 1489998096, 1489998096),
(2, 1, 'index', 'index.hisiphp.module', '系统默认模块', '仅供前端插件访问和应用市场推送安装，禁止在此模块下面开发任何东西。', 'HisiPHP官方出品', '', '1.0.0', 'http://www.hisiphp.com', 0, 2, 0, '', '0', '', 'default', 1489998096, 1489998096),
(3, 1, 'install', 'install.hisiphp.module', '系统安装模块', '系统安装模块，勿动。', 'HisiPHP官方出品', '', '1.0.0', 'http://www.hisiphp.com', 0, 2, 0, '', '0', '', 'default', 1489998096, 1489998096);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_plugins`
--

CREATE TABLE IF NOT EXISTS `sup_admin_plugins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL COMMENT '插件名称(英文)',
  `title` varchar(32) NOT NULL COMMENT '插件标题',
  `icon` varchar(64) NOT NULL COMMENT '图标',
  `intro` text NOT NULL COMMENT '插件简介',
  `author` varchar(32) NOT NULL COMMENT '作者',
  `url` varchar(255) NOT NULL COMMENT '作者主页',
  `version` varchar(16) NOT NULL DEFAULT '' COMMENT '版本号',
  `identifier` varchar(64) NOT NULL DEFAULT '' COMMENT '插件唯一标识符',
  `config` text NOT NULL COMMENT '插件配置',
  `app_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '应用市场ID(0本地)',
  `app_keys` varchar(200) DEFAULT '' COMMENT '应用秘钥',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 插件表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sup_admin_plugins`
--

INSERT INTO `sup_admin_plugins` (`id`, `system`, `name`, `title`, `icon`, `intro`, `author`, `url`, `version`, `identifier`, `config`, `app_id`, `app_keys`, `ctime`, `mtime`, `sort`, `status`) VALUES
(1, 0, 'hisiphp', '系统基础信息', '/plugins/hisiphp/hisiphp.png', '后台首页展示系统基础信息和开发团队信息', 'HisiPHP', 'http://www.hisiphp.com', '1.0.0', 'hisiphp.hisiphp.plugins', '', '0', '', 1509379331, 1509379331, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_role`
--

CREATE TABLE IF NOT EXISTS `sup_admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '角色名称',
  `intro` varchar(200) NOT NULL COMMENT '角色简介',
  `auth` text NOT NULL COMMENT '角色权限',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='[系统] 管理角色' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `sup_admin_role`
--

INSERT INTO `sup_admin_role` (`id`, `name`, `intro`, `auth`, `ctime`, `mtime`, `status`) VALUES
(1, '超级管理员', '拥有系统最高权限', '0', 1489411760, 0, 1),
(2, '系统管理员', '拥有系统管理员权限', '{"0":"1","1":"4","2":"25","3":"24","5":"2","6":"6","7":"12","8":"26","9":"27","10":"28","11":"29","12":"30","13":"31","14":"32","15":"13","16":"33","17":"34","18":"35","19":"36","20":"14","21":"37","22":"38","23":"39","24":"40","25":"41","30":"203","31":"202","32":"204","37":"209","38":"210","39":"211"}', 1489411760, 1536837330, 1),
(3, '教师角色', '查看自己帮扶学生', '{"0":"1","1":"4","3":"24","4":"105","5":"2","30":"203","39":"211"}', 1536837401, 1536838186, 1),
(4, '学校权限', '查看自己学校的老师和帮扶的学生', '{"5":"2","30":"203","37":"209","38":"210","39":"211"}', 1536837581, 1536837581, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_school`
--

CREATE TABLE IF NOT EXISTS `sup_admin_school` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL COMMENT '学校标题',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态1显示，0隐藏',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `ctime` (`ctime`),
  KEY `ctime_2` (`ctime`),
  KEY `ctime_3` (`ctime`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 学校菜单' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `sup_admin_school`
--

INSERT INTO `sup_admin_school` (`id`, `pid`, `title`, `sort`, `status`, `ctime`, `mtime`) VALUES
(3, 0, '合肥大学', 0, 1, 1536665714, 1536665714),
(4, 0, '北京大学', 0, 1, 1536665738, 1536665738),
(5, 0, '天津大学', 0, 1, 1536734626, 1536734626),
(6, 0, '西安大学', 0, 1, 1536805069, 1536805069),
(7, 0, '西北大学', 0, 1, 0, 0),
(8, 0, '厦门大学', 0, 1, 0, 0),
(9, 0, '山西大学', 0, 1, 0, 0),
(10, 0, '青岛大学', 0, 1, 0, 0),
(11, 0, '宝鸡大写', 0, 1, 1536825332, 1536825332),
(12, 0, '海南大学', 0, 1, 0, 0),
(13, 0, '东京大学', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sup_admin_user`
--

CREATE TABLE IF NOT EXISTS `sup_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `shool_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学校的id',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(64) NOT NULL,
  `nick` varchar(50) NOT NULL COMMENT '昵称',
  `mobile` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `birthday` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '生日',
  `auth` text NOT NULL COMMENT '权限',
  `iframe` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0默认，1框架',
  `theme` varchar(30) NOT NULL DEFAULT '0' COMMENT '主题',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `last_login_ip` varchar(128) NOT NULL COMMENT '最后登陆IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='[系统] 管理用户' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `sup_admin_user`
--

INSERT INTO `sup_admin_user` (`id`, `role_id`, `shool_id`, `username`, `password`, `nick`, `mobile`, `email`, `birthday`, `auth`, `iframe`, `theme`, `status`, `last_login_ip`, `last_login_time`, `ctime`, `mtime`) VALUES
(1, 1, 0, 'supportprojectadmin', '$2y$10$Zxr9tSxccfGNpJ4XraXTsezDx8r8QRvif5T.DA02RDVtCmCpBkwq.', '超级管理员', '', '', '0', '', 1, '0', 1, '127.0.0.1', 1537521600, 1536554318, 1537521600),
(2, 2, 0, 'ssd', '$2y$10$R34KwsgoN0bYDOiLEWfQV.aVEihhaOLHbT07WyqG5AqIs21Mhr7He', '地方', '', '', '0', '{"0":"1","1":"4","2":"25","3":"24","5":"2","6":"6","7":"12","8":"26","9":"27","10":"28","11":"29","12":"30","13":"31","14":"32","15":"13","16":"33","17":"34","18":"35","19":"36","20":"14","21":"37","22":"38","23":"39","24":"40","25":"41","30":"203","31":"202","32":"204","37":"209"}', 0, '0', 1, '127.0.0.1', 0, 1536657845, 1536823634),
(3, 3, 0, 'enran', '$2y$10$bwkO91DUJmRcQ6dyjX30kek8.eF6f5jX4VUJsWnxaJo3AmPsWz8Lm', '恩然', '13935745628', '7912@qq.com', '0', '', 0, '0', 1, '127.0.0.1', 1536838200, 1536837769, 1536838200);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
