

## 目录结构
```
www  WEB部署目录（或者子目录）
├─app                   应用目录
│   ├─admin             系统模块目录
│   ├─common            系统公共模块目录
│   │   ├─behavior      行为目录
│   │   ├─controller    公共模块控制器目录
│   │   ├─lang          公共模块语言包目录
│   │   ├─model         公共模型目录
│   │   ├─util          扩展类库目录
│   │   ├─validate      公共验证器目录
│   ├─extra             扩展配置目录
│   ├─index             前台默认模块目录（禁止在此目录下开发）
│   ├─install           系统安装目录
│   ├─command.php       命令行工具配置文件
│   ├─common.php        公共（函数）文件
│   ├─function.php      为方便系统升级，二次开发中用到的公共函数请写在此文件
│   ├─config.php        应用（公共）配置文件
│   ├─database.php      数据库配置文件（安装时自动生成）
│   ├─route.php         路由配置文件
│   ├─tags.php          应用行为扩展定义文件
├─backup                备份目录（数据库、升级文件）
├─plugins               插件目录
├─static                静态资源目录（后台用）
├─theme                 主题模板目录
├─thinkphp              ThinkPHP核心框架目录
├─upload                文件上传目录
├─vendor                第三方类库目录（Composer）
├─index.php             应用入口文件
├─admin.php             后台管理入口文件
├─plugins.php           插件入口文件
├─version.php           系统版本文件
├─.htaccess             伪静态配置文件
```








