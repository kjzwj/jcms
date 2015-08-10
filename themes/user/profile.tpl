<template file="header.tpl" />
<load type="css" href="__PUBLIC__css/user.css,__PUBLIC__/css/font-awesome.min.css" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="/public/css/font-awesome-ie7.min.css" />
<![endif]-->

<div class="user_main">
	<div class="container">
		<div class="row">
			<template file="left.tpl" type="user" />
	
			<div class="col-md-9 col-sm-9 main">
				<div class="user_center">
					<h3 class="page-header">个人信息</h3>
					<div class="profile">
						<form class="form-horizontal" method="post" action="{:U('user/profile')}">
						  <div class="form-group">
						    <label class="col-sm-3 col-md-2 control-label">注册帐号</label>
						    <div class="col-sm-8 col-md-6 txt">
						      {$userinfo.email}
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="col-sm-3 col-md-2 control-label">注册时间</label>
						    <div class="col-sm-8 col-md-6 txt">
						      {$userinfo.regtime|date="Y-m-d H:i:s",###}
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="col-sm-3 col-md-2 control-label">注册IP</label>
						    <div class="col-sm-8 col-md-6 txt">
						      {$userinfo.regip}
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="col-sm-3 col-md-2 control-label">登录密码</label>
						    <div class="col-sm-8 col-md-6">
						      <input type="password" class="form-control" name="info[password]" value="" placeholder="不修改请留空" autocomplete="off">
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="col-sm-3 col-md-2 control-label">姓 名</label>
						    <div class="col-sm-8 col-md-6">
						      <input type="text" class="form-control" name="info[uname]" value="{$userinfo.uname}" placeholder="昵称">
						    </div>
						  </div>
						  
						  <div class="form-group">
						    <label class="col-sm-3 col-md-2 control-label">联系方式</label>
						    <div class="col-sm-8 col-md-6">
						      <input type="text" class="form-control" name="info[contact]" value="{$userinfo.contact}" placeholder="可填：电话号码/QQ/微信号/邮箱地址">
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-sm-offset-3 col-md-offset-2 col-sm-10">
						      <button type="submit" class="btn btn-success">保存信息</button>
						    </div>
						  </div>
						</form>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>


<template file="footer.tpl" />