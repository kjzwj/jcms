<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo C('sys_sitename');?> <?php echo L('website_manage');?> by J-cms</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="简单而强大的内容管理系统 J-cms">
<meta name="author" content="Jcms">

<!-- Le styles -->
<link rel="stylesheet" type="text/css" href="__DATA__css/bootstrap.min.css" /><link rel="stylesheet" type="text/css" href="__DATA__css/bootstrap-responsive.css" /><link rel="stylesheet" type="text/css" href="__DATA__css/login.css" />
<?php $tag_load_class = new loadTag;$data = $tag_load_class->js(array('type'=>'js','href'=>'__DATA__js/jquery.js,__DATA__js/bootstrap.min.js','from'=>'admin','cache'=>'0','return'=>'data',));?>
<style type="text/css">
</style>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="__DATA__js/html5shiv.js"></script>
<![endif]-->
</head>

<body>
<div class="container">
	<form class="form-signin" id="login" action="<?php echo U('signin');?>">
		<h2 class="form-signin-heading">欢迎登录</h2>
		<input type="text" name="username" class="input-block-level" placeholder="帐号" required="required">
		<input type="password" name="password" class="input-block-level" placeholder="密码" required="required">
		<input type="text" name="verify" class="input-block-level" placeholder="验证码" required="required"><img src="<?php echo U('verify');?>" class="verifyimg reloadverify"/>
		<button class="btn btn-large btn-primary" type="submit">登 入</button>
		<div class="alert alert-error hide"></div>
	</form>
	<footer class="footer">
	&copy; 2012-<?php echo DATE('Y');?> J-cms 所有版权
	</footer>
</div>


<script>
	//表单提交
	$(document)
		.ajaxStart(function(){
			$("button:submit").attr({"disabled":true,'class':'btn btn-large'});
		})
		.ajaxStop(function(){
			$("button:submit").attr({"disabled":false,'class':'btn btn-large btn-primary'});
		});

	$("form#login").submit(function(){
		var self = $(this);
		$.post(self.attr("action"), self.serialize(), success, "json");
		return false;

		function success(data){
			if(data.status){
				self.find(".alert").attr('class','alert alert-success').show().html(data.info);
				window.location.href = data.url;
			} else {
				self.find(".alert").show().html(data.info);
				//刷新验证码
				$(".reloadverify").click();
			}
		}
	});
	$(function(){
		//初始化选中用户名输入框
		$("#login").find("input[name=username]").focus();
		//刷新验证码
		var verifyimg = $(".verifyimg").attr("src");
		$(".reloadverify").click(function(){
			$(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
		});
	});
</script>

</body>
</html>