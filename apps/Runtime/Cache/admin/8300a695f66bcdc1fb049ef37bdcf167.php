<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="简单而强大的内容管理系统 J-cms">
<title><?php echo C('sys_sitename');?> <?php echo L('website_manage');?> by J-cms</title>
<meta name="author" content="J-cms">

<script>
	var URL = '__URL__';
	var SELF = '__SELF__';
	var ROOT_PATH = '__ROOT__';
	var APP	 =	 '__APP__';
	//语言项目
	var lang = new Object();
	<?php $_result=L('js_lang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>lang.<?php echo ($key); ?> = "<?php echo ($val); ?>";<?php endforeach; endif; else: echo "" ;endif; ?>
</script>
<!-- Le styles -->
<link rel="stylesheet" type="text/css" href="__DATA__css/bootstrap.min.css" /><link rel="stylesheet" type="text/css" href="__DATA__css/bootstrap-responsive.css" /><link rel="stylesheet" type="text/css" href="__DATA__css/admin.css" />
<?php $tag_load_class = new loadTag;$data = $tag_load_class->js(array('type'=>'js','href'=>'__DATA__js/jquery.js,__DATA__js/bootstrap.min.js','from'=>'admin','cache'=>'0','return'=>'data',));?>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<?php $tag_load_class = new loadTag;$data = $tag_load_class->js(array('type'=>'js','href'=>'__DATA__js/html5shiv.js','from'=>'admin','cache'=>'0','return'=>'data',));?>
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
          <?php if(is_array($admin_menu)): foreach($admin_menu as $key=>$val): if($val['status'] != 'hide'): ?><li <?php if($action_name == $key): ?>class="active"<?php endif; ?>><a href="<?php echo U($key.'/index');?>"><?php echo ($val["title"]); ?></a></li><?php endif; endforeach; endif; ?>
        </ul>
        
        <ul class="nav pull-right">
          <li><a href="<?php echo C('sys_siteurl');?>" target="_blank"><?php echo L('web_home');?></a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($_SESSION['admins']['username']); ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo U('admins/edit',array('id'=>admin_login()));?>"><?php echo L('editpassword');?></a></li>
              <li><a href="<?php echo U('login/logout');?>"><?php echo L('logout');?></a></li>
            </ul>
          </li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($jcms_lang); ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
              <?php if(is_array($lang_list)): $i = 0; $__LIST__ = $lang_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lang): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('home/lang/index',array('code'=>$lang['code'],'gourl'=>'admin.php'));?>"><?php echo ($lang['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </li>
          <li><a href="<?php echo U('index/clearCache');?>"><?php echo L('clear_cache');?></a></li>
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
<!--main-->
<section class="container-fluid main">

  <div class="row-fluid">
    <!--left-->
<?php if(!empty($admin_menu[$action_name])): ?><div class="span2 side_nav" style="margin-left:0;">
  <ul class="nav nav-tabs nav-stacked">
    <li class="nav-header"><?php echo ($admin_menu[$action_name]["title"]); ?></li>
    <?php if(!empty($admin_menu[$action_name][sonmenu])): if(is_array($admin_menu[$action_name][sonmenu])): foreach($admin_menu[$action_name][sonmenu] as $key=>$val): ?><li <?php if($curr_name == $key): ?>class="active"<?php endif; ?>><a href="<?php echo U($key);?>"><?php echo ($val); ?></a></li><?php endforeach; endif; endif; ?>
  </ul>
  
  <ul class="nav nav-tabs hidden-tabs">
    <li class="nav-header"><?php echo ($admin_menu[$action_name]["title"]); ?></li>
    <?php if(!empty($admin_menu[$action_name][sonmenu])): if(is_array($admin_menu[$action_name][sonmenu])): foreach($admin_menu[$action_name][sonmenu] as $key=>$val): ?><li <?php if($curr_name == $key): ?>class="active"<?php endif; ?>><a href="<?php echo U($key);?>"><?php echo ($val); ?></a></li><?php endforeach; endif; endif; ?>
  </ul>
  
</div><?php endif; ?>
    
    <div class="span10">
      

<h4><?php echo L('sys_info');?></h4>
<div class="blank20"></div>

<div class="row-fluid">

  <ul class="nav nav-tabs">
		<?php if(is_array($tabnav)): foreach($tabnav as $key=>$vo): ?><li><a href="<?php echo U('index');?>"><?php echo L('tabs_'.$key);?></a></li><?php endforeach; endif; ?>
    <li class="active"><a href="<?php echo U('sysinfo/add');?>"><?php echo L('tabs_addnew');?></a></li>
  </ul>

  <form class="form-horizontal" action="<?php echo U('add');?>" method="post">
    <fieldset>
     
     <div class="tab-content">

      <div class="tab-pane active" id="addnew">
      
        <div class="control-group">
          <label class="control-label" for="name"><?php echo L('sys_addlabel');?></label>
          <div class="controls">
            <input name="name" type="text" class="input-xlarge" id="name" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="varname"><?php echo L('sys_addname');?></label>
          <div class="controls">
            <input type="text" class="input-xlarge" id="varname" name="varname" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="vartype"><?php echo L('sys_addtype');?></label>
          <div class="controls">
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_0" value="text" checked="checked">单行文本
            </label>
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_1" value="number">数字
            </label>
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_2" value="bool">布尔(Y/N)
            </label>
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_3" value="textarea">多行文本
            </label>
          </div>
        </div> 
        <div class="control-group">
          <label class="control-label" for="value"><?php echo L('sys_addvalue');?></label>
          <div class="controls">
            <textarea name="value" rows="3" class="input-xlarge" id="value"></textarea>
          </div>
        </div>                
     	</div>
     	</div>
     <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo L('lable_submit');?></button>
        <button class="btn" type="reset"><?php echo L('lable_cancel');?></button>
      </div>
    </fieldset>
  </form>
</div>
    </div>
  </div>  

</section>
<!--footer-->
<footer class="footer">
	&copy; 2012-<?php echo DATE('Y');?> J-cms 所有版权
</footer>

<?php $tag_load_class = new loadTag;$data = $tag_load_class->js(array('type'=>'js','href'=>'__DATA__js/plugins/jquery.tools.min.js,__DATA__js/plugins/formvalidator.js,__DATA__js/pinphp.js,__DATA__js/admin.js','from'=>'admin','cache'=>'0','return'=>'data',));?>


<?php if(isset($iframe_tools)): ?><link rel="stylesheet" type="text/css" href="__DATA__css/artDialog.css" />
<script type="text/javascript" src="__DATA__js/artDialog.js"></script><script type="text/javascript" src="__DATA__js/plugins/iframeTools.js"></script><?php endif; ?>

<script>
//初始化弹窗
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script>


<?php if(isset($list_table)): $tag_load_class = new loadTag;$data = $tag_load_class->js(array('type'=>'js','href'=>'__DATA__js/plugins/listTable.js','from'=>'admin','cache'=>'0','return'=>'data',));?>
<script>
$(function(){
	$('.J_tablelist').listTable();
});
</script><?php endif; ?>
</body>
</html>