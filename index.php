<?php
header("Content-type: text/html; charset=utf-8");
/* 当前J-cms程序Release beta v1.2 */
define('WJ_RELEASE', '20150801');
define('JCMS', 'J-cms');
//网站安装目录
define('BASE_PATH', dirname(__FILE__).'/');
//定义项目名称和路径
define('APP_NAME', 'apps');
define('APP_PATH', './apps/');
/*数据目录*/
define('WEB_DATA', '/data/');
define('WEB_PUBLIC', '/public/');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为 false
define('APP_DEBUG',true);

// 加载框架入口文件
require("./apps/jcms.php");