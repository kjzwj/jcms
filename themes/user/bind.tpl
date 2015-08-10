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
					<h3 class="page-header">社交帐号绑定</h3>
					<div class="bind">
						<div class="row">
							<div class="col-md-4 col-sm-4 item">
								<img src="__PUBLIC__/img/qq_bind.jpg" />
								<if condition="$userinfo['qq_openid'] neq '' and $userinfo['qq_name'] neq ''">
								<p><a class="btn btn-success btn-sm disabled" role="button">已经绑定</a></p>
								<p>{$userinfo['qq_name']}</p>
								<else/>
								<p><a href="{:U('oauth/qq')}" target="_blank" class="btn btn-default btn-sm" role="button">立即绑定</a></p>
								</if>
							</div>
							<div class="col-md-4 col-sm-4 item">
								<img src="__PUBLIC__/img/weibo_bind.jpg" />
								<if condition="$userinfo['wb_openid'] neq '' and $userinfo['wb_name'] neq ''">
								<p><a class="btn btn-success btn-sm disabled" role="button">已经绑定</a></p>
								<p>{$userinfo['wb_name']}</p>
								<else/>
								<p><a href="{:U('oauth/weibo')}" target="_blank" class="btn btn-default btn-sm" role="button">立即绑定</a></p>
								</if>
							</div>
							<div class="col-md-4 col-sm-4 item end">
								<img src="__PUBLIC__/img/weixin_bind.jpg" />
								<if condition="$userinfo['wx_openid'] neq '' and $userinfo['wx_name'] neq ''">
								<p><a class="btn btn-success btn-sm disabled" role="button">已经绑定</a></p>
								<p>{$userinfo['wx_name']}</p>
								<else/>
								<p><a href="{:U('oauth/weixin')}" target="_blank" class="btn btn-default btn-sm" role="button">立即绑定</a></p>
								</if>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<template file="footer.tpl" />