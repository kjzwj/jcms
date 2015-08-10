<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="简单而强大的内容管理系统 J-cms">
<title>{:C('sys_sitename')} {:L('website_manage')} by J-cms</title>
<meta name="author" content="J-cms">

<script>
	var URL = '__URL__';
	var SELF = '__SELF__';
	var ROOT_PATH = '__ROOT__';
	var APP	 =	 '__APP__';
	//语言项目
	var lang = new Object();
	<volist name=":L('js_lang')" id="val">
		lang.{$key} = "{$val}";
	</volist>
</script>
<!-- Le styles -->
<load type="css" href="__DATA__css/bootstrap.min.css,__DATA__css/bootstrap-responsive.css,__DATA__css/admin.css" from="admin" />
<wj:load type="js" href="__DATA__js/jquery.js,__DATA__js/bootstrap.min.js" from="admin" />

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<wj:load type="js" href="__DATA__js/html5shiv.js" from="admin" />
<![endif]-->
<script>
$('.dropdown-toggle').dropdown();
</script>
</head>

<body>
<div id="J_ajax_loading" class="ajax_loading">提交请求中，请稍候...</div>


<!--topbar-->
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="admin.php">J-cms</a>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <foreach name="admin_menu" item="val">
            <if condition="$val['status'] neq 'hide'">
            <li <if condition="$action_name eq $key">class="active"</if>><a href="{:U($key.'/index')}">{$val.title}</a></li>
            </if>
          </foreach>
        </ul>
        
        <ul class="nav pull-right">
          <li><a href="{:C('sys_siteurl')}" target="_blank">{:L('web_home')}</a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{$_SESSION['admins']['username']}<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{:U('admins/edit',array('id'=>admin_login()))}">{:L('editpassword')}</a></li>
              <li><a href="{:U('login/logout')}">{:L('logout')}</a></li>
            </ul>
          </li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{$jcms_lang}<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <volist name="lang_list" id="lang">
              <li><a href="{:U('home/lang/index',array('code'=>$lang['code'],'gourl'=>'admin.php'))}">{$lang['name']}</a></li>
              </volist>
            </ul>
          </li>
          <li><a href="{:U('index/clearCache')}">{:L('clear_cache')}</a></li>
        </ul>          
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>


<!--head-->
<section class="head_bg">
	<div class="container-fluid">
  	<h2>管理系统</h2>
    <div class="location">
      <?php echo session('jcmsRelease');?>
    </div>
  </div>
</section>
<div class="blank20"></div>