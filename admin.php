<?php
/* 后台入口文件
* $_SESSION['entermodel'] 安全验证参数，必须
*/
session_start();
$_SESSION['entermodel'] = 'jcmsmanage';	
header("Location: index.php?g=admin");
exit;