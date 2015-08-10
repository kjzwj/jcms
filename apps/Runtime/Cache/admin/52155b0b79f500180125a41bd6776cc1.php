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
      

<h4><?php echo L('article_add');?></h4>
<div class="blank20"></div>
<div class="row-fluid">

  <ul class="nav nav-tabs">
    <li class="active"><a href="#base" data-toggle="tab"><?php echo L('tabs_base');?></a></li>
    <li><a href="#advance" data-toggle="tab"><?php echo L('tabs_advanced');?></a></li>
    <li><a href="#content" data-toggle="tab"><?php echo L('cate'); echo L('tabs_content');?></a></li>
  </ul>
  
  <form class="form-horizontal" action="<?php echo U('add_category');?>" method="post">
    <fieldset>
       
      <div class="tab-content">
        <!--基本选项-->
        <div class="tab-pane active" id="base">
        
          <div class="control-group">
            <label class="control-label" for="pid"><?php echo L('lable_parent'); echo L('cate_name');?></label>
            <div class="controls">
            <select class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('category/ajax_getchilds');?>" data-selected="<?php echo ($spid); ?>"></select>
            <input type="hidden" name="pid" id="J_cate_id" />
            </div>
          </div>
                  
          <div class="control-group">
            <label class="control-label" for="name"><?php echo L('cate'); echo L('lable_name');?></label>
            <div class="controls">
                <input name="name" type="text" class="input-xlarge" id="name" value="">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="alias"><?php echo L('lable_alias');?></label>
            <div class="controls">
              <input type="text" class="input-large" name="alias" id="alias" placeholder="URL目录" />
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="listorder"><?php echo L('lable_order');?></label>
            <div class="controls">
              <input type="text" class="input-small" name="ordid" id="ordid" value="0" />
            </div>
          </div>
          
          <div class="control-group hide-page hide-url">
            <label class="control-label" for="modelid"><?php echo L('lable_module');?></label>
            <div class="controls">
              <select id="modelid" name="modelid" onchange="load_file_list(this.value)">
                <option value=""><?php echo L('lable_selectone');?></option>
                <?php if(is_array($model_list)): $i = 0; $__LIST__ = $model_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$model): $mod = ($i % 2 );++$i; if($model['status'] == 1): ?><option value="<?php echo ($model["id"]); ?>" <?php if($pcate['modelid'] == $model['id']): ?>selected="selected"<?php endif; ?>><?php echo ($model["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
              </select>
            </div>
          </div>      
      
        <div class="control-group">
            <label class="control-label" for="isnav"><?php echo L('lable_type');?></label>
            <div class="controls">
              <label class="radio inline">
                <input type="radio" name="type" onchange="change_type(this.value)" id="type_0" value="0" <?php if($pcate['type'] == 0): ?>checked="checked"<?php endif; ?>><?php echo L('type_0');?>
              </label>
              <label class="radio inline">
                <input type="radio" name="type" onchange="change_type(this.value)" id="type_1" value="1" <?php if($pcate['type'] == 1): ?>checked="checked"<?php endif; ?>><?php echo L('type_1');?>
              </label>
              <label class="radio inline">
                <input type="radio" name="type" onchange="change_type(this.value)" id="type_2" value="2" <?php if($pcate['type'] == 2): ?>checked="checked"<?php endif; ?>><?php echo L('type_2');?>
              </label>
            </div>
          </div>      

          <div class="control-group">
            <label class="control-label" for="isnav"><?php echo L('lable_showinnav');?></label>
            <div class="controls">
              <label class="radio inline">
                <input type="radio" name="isnav" id="isnav1" value="1" checked="checked"><?php echo L('lable_yes');?>
              </label>
              <label class="radio inline">
                <input type="radio" name="isnav" id="isnav2" value="0"><?php echo L('lable_no');?>
              </label>
            </div>
          </div>
          
        </div>
       	<!--基本选项-->
        <!--高级选项-->
        <div class="tab-pane" id="advance">
          <div class="control-group hide-url show-page">
            <label class="control-label" for="template_index"><?php echo L('template_index');?></label>
            <div class="controls">
                <div class="input-append"><input name="template_index" type="text" class="input-large" id="J_template_index" placeholder="index_default" value="<?php echo ($pcate["template_index"]); ?>">
                <button class="btn J_opendialog" data-uri="<?php echo U('attachment/index',array('type'=>'tpl'));?>" data-name="J_template_index" data-width="800" data-title="<?php echo L('template_select');?> (双击选择)" type="button"><?php echo L('template_select');?></button>            
                </div>
            </div>
          </div>
          
          <div class="control-group hide-page hide-url">
            <label class="control-label" for="template_list"><?php echo L('template_list');?></label>
            <div class="controls">
                <div class="input-append"><input name="template_list" type="text" class="input-large" id="J_template_list" placeholder="list_default" value="<?php echo ($pcate["template_list"]); ?>">
                <button class="btn J_opendialog" data-uri="<?php echo U('attachment/index',array('type'=>'tpl'));?>" data-name="J_template_list" data-width="800" data-title="<?php echo L('template_select');?> (双击选择)" type="button"><?php echo L('template_select');?></button>
                </div>
            </div>
          </div>
          
          <div class="control-group hide-page hide-url">
            <label class="control-label" for="template_show"><?php echo L('template_show');?></label>
            <div class="controls">
                <div class="input-append"><input name="template_show" type="text" class="input-large" id="J_template_show" placeholder="show_default" value="<?php echo ($pcate["template_show"]); ?>">
                <button class="btn J_opendialog" data-uri="<?php echo U('attachment/index',array('type'=>'tpl'));?>" data-name="J_template_show" data-width="800" data-title="<?php echo L('template_select');?> (双击选择)" type="button"><?php echo L('template_select');?></button>
                </div>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="J_image"><?php echo L('cate_img');?></label>
            <div class="controls">
              <div class="input-append"><input type="text" name="image" id="J_image" class="input-xlarge" />
              <button class="btn J_opendialog" data-uri="<?php echo U('attachment/index',array('type'=>'image'));?>" data-name="J_image" data-width="800" data-title="<?php echo L('selet_images');?> (双击选择)" type="button"><?php echo L('selet_images');?></button>
              </div>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="seotitle"><?php echo L('seo_title');?></label>
            <div class="controls">
                <input name="seotitle" type="text" class="input-xxlarge" id="seotitle">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="seokeywords"><?php echo L('seo_keys');?></label>
            <div class="controls">
                <input name="seokeywords" type="text" class="input-xxlarge" id="seokeywords">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="seodescription"><?php echo L('seo_desc');?></label>
            <div class="controls">
                <textarea name="seodescription" id="seodescription" class="input-xxlarge" rows="6"></textarea>
            </div>
          </div>

        </div>
        <!--高级选项-->
        
        <div class="tab-pane" id="content">
      		<script id="body" name="body" type="text/plain" class=""></script><script type="text/javascript" src="__DATA__ueditor/ueditor.config.js"></script><script type="text/javascript" src="__DATA__ueditor/ueditor.all.js"></script><script type="text/javascript">var editor = UE.getEditor("body",{"initialFrameWidth":820,"initialFrameHeight":350});</script> 
        
        </div>
        
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo L('lable_submit');?></button>
        <a class="btn" type="reset" href="<?php echo U('category/index');?>"><?php echo L('lable_back');?></a>
      </div>            
     </fieldset>
  </form>

      <script>
        $(function () {
          $('.tabs a:last').tab('show')
        })
      </script>
</div>

<script>
$(function(){
	//分类联动
	$('.J_cate_select').cate_select();
  //栏目类型
  change_type($('input:radio[name=type]:checked').val());
})

function load_file_list(id) {
	var url="<?php echo U('category/get_model_files');?>";
  $.getJSON(url+'&id='+id,
	function(data){
    $('#template_index').val(data['data']['template_index']);
		$('#template_list').val(data['data']['template_list']);
		$('#template_show').val(data['data']['template_show']);
  });
}

function change_type(type) {
  switch(type){
    case "1":
      $('.hide-page').hide(200);
      $('.show-page').show(200);
      break;
    case "2":
      $('.hide-url').hide(200);
      break;
    default:
      $('.hide-url,.hide-page').show(200);
  }
}
</script>
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