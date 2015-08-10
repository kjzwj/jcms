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
				<div class="user_index">
					<div class="welcome">
						<p class="hello">您好，<b>{$userinfo.uname}</b></p>
						<p class="lastlogin">这是您第<b>{$userinfo.login}</b>次登录本站，上次登录时间：{$userinfo.lasttime|date="Y-m-d H:i:s",###}</p>
						<p class="safetip">如果不是您登录，请<a href="{:U('user/profile')}">修改密码</a></p>
					</div>

					<div class="bind">
						<dl class="clearfix">
                	        <dt>您也可以用以下方式登录：</dt>
                	        <if condition="$userinfo['qq_openid'] neq '' and $userinfo['qq_name'] neq ''">
                	        <dd><a href="{:U('user/bind')}" class="btn btn-success"><i class="fa fa-qq"></i><span>{$userinfo['qq_name']}</span></a></dd>
                	        <else/>
                	        <dd><a href="{:U('oauth/qq')}" target="_blank" class="btn btn-default"><i class="fa fa-qq"></i><span>绑定QQ帐号</span></a></dd>
                	    	</if>

                	    	<if condition="$userinfo['wb_openid'] neq '' and $userinfo['wb_name'] neq ''">
                	        <dd><a href="{:U('user/bind')}" class="btn btn-success"><i class="fa fa-weibo"></i><span>{$userinfo['wb_name']}</span></a></dd>
                	        <else/>
                	        <dd><a href="{:U('oauth/weibo')}" target="_blank" class="btn btn-default"><i class="fa fa-weibo"></i><span>绑定新浪微博</span></a></dd>
                	    	</if>

                	    	<if condition="$userinfo['wx_openid'] neq '' and $userinfo['wx_name'] neq ''">
                	        <dd><a href="{:U('user/bind')}" class="btn btn-success"><i class="fa fa-weixin"></i><span>{$userinfo['wx_name']}</span></a></dd>
                	        <else/>
                	        <dd><a href="{:U('oauth/weixin')}" target="_blank" class="btn btn-default"><i class="fa fa-weixin"></i><span>绑定微信帐号</span></a></dd>
                	    	</if>
                	    	
                	    </dl>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<template file="footer.tpl" />