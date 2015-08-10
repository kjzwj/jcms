<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo ($seo['title']); ?></title>
<meta name="keywords" content="<?php echo ($seo['keywords']); ?>">
<meta name="description" content="<?php echo ($seo['description']); ?>">
<meta property="qc:admins" content="7541321015761564536375" />
<meta property="wb:webmaster" content="8b9c5067586b7177" />
<link href="__PUBLIC__css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__css/main.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__css/ionicons.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__js/bootstrap.min.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script type="text/javascript" src="__PUBLIC__js/html5shiv.js"></script>
<![endif]-->
</head>

<body>
<!--header-->
<?php if(!$this->view) $this->view = Think::instance('View');$this->view->display('./themes/jcms/top.tpl',$this->tVar); ?>

<!--menu-->
<header class="header fixed clearfix">
  <div class="container">
    <div class="row">

      <div class="col-md-3">
        <div class="header-left clearfix">
          <div class="logo">
            <a href="<?php echo ($WEB['sys_siteurl']); ?>" title="Home" rel="home" id="logo">
            <img src="__PUBLIC__img/logo.png" alt="<?php echo ($WEB['sys_sitename']); ?>">
            </a>
          </div>
        </div>
       </div> <!--/.col-md-3 -->

      <div class="col-md-9">
        <div class="header-right clearfix">
          <div class="main-navigation animated">

            <nav class="navbar navbar-default" role="navigation">
              <div class="container-fluid">
                <!-- Toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="navbar-collapse collapse" id="navbar-collapse-1">
                  <h2 class="element-invisible">Main menu</h2>
                  <ul class="main-menu menu">
                  <li <?php if($current == 'home'): ?>class="active"<?php endif; ?>><a href="/" title="网站首页">首页</a></li>
                    <?php $map['catid']=0;$map['limit']="";$map['order']="";$map['where']="";$map['fields']="";$map['isnav']="1";$self="";$addend="";$_cate_list = D('category')->get_list($map,$self,$addend);foreach ($_cate_list as $key=>$val):$val['url']=U("content/index",array("cid"=>$val['id']));?><li class="<?php if($current == $val['id']): ?>active<?php endif; ?> menu-<?php echo ($val['id']); ?>"><a href="<?php echo U('/'.$val['alias']);?>" title="<?php echo ($val['name']); ?>"><?php echo ($val['name']); ?></a></li><?php endforeach; ?>
                    <li <?php if($current == 'user'): ?>class="active"<?php endif; ?>><a href="<?php echo U('user/index');?>" title="会员中心">会员中心</a></li>
                  </ul>
                </div>
              </div>
            </nav>

          </div>
        </div>
      </div> <!--/.col-md-9 -->

    </div>
  </div>
</header>