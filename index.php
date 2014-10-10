<?php
define('VERSION','PCWAP_V1.0');
define('CXNAME','PCWAP手机PC网站管理系统');
define('AUTHOR','预感');
define('AUTHOR_QQ','476905668');
define('PCWAP','http://www.pcwap.cn');
define("APP_NAME","");
define("APP_PATH","./");
define('APP_DEBUG',1);//调试模式
if (!file_exists(APP_PATH.'Conf/pcwap.php')) {
header("Content-type: text/html; charset=utf-8");
    echo "<a href=\"Install/install.php\" >点击安装</a>";
    exit();
}
require("./Inc/index.php");
?>