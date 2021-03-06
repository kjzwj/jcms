<template file="header.tpl" />
<load type="css" href="__PUBLIC__/css/user.css,__PUBLIC__/css/validform.css,__PUBLIC__/css/font-awesome.min.css" />
<load type="js" href="__PUBLIC__/js/Validform_v5.3.2_min.js" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="/public/css/font-awesome-ie7.min.css" />
<![endif]-->

<div class="container user-content">
	<div class="row">
		<div class="col-md-12">
		    <div class="apartment-title  clearfix nav-tabs">
		        <ul class="list-unstyled ">
		            <li class="active">
		                <h3><a href="{:U('register')}">用户注册</a></h3>
		            </li>
		            <li>
		                <h3><a href="{:U('login')}">登录帐号</a></h3>
		            </li>
		        </ul>
		    </div>
		    <div class="user-box clearfix">
		        <!-- begin tab-content -->
		        <div class="tab-content">
	                <div class="col-md-6 col-sm-12">
	                	<div class="reg-box login-box clearfix">
		                    <form class="registerform" action="{:U('register')}" method="post">
		                        <ul class="list-unstyled reg-box-from">
		                            <li>
		                                <div class="dt">登录邮箱</div>
		                                <div class="dd">
		                                    <input type="text" value="" name="email" class="form-control input-bd1 text input-2" datatype="e" nullmsg="请输入邮箱地址！" errormsg="请输入正确的邮箱地址！" />
		                                    <div class="Validform_checktip"></div>
		                                </div>
		                            </li>
		                            <li>
		                                <div class="dt">称呼</div>
		                                <div class="dd">
		                                    <input type="text" value="" name="uname" class="form-control input-bd1 text input-2" datatype="*" nullmsg="请输入你的称呼！" errormsg="请输入你的称呼！" />
		                                    <div class="Validform_checktip"></div>
		                                </div>
		                            </li>
		                            <li>
		                                <div class="dt">密码</div>
		                                <div class="dd">
		                                    <input type="password" value="" name="password" class="form-control input-bd1 text input-2" datatype="oldpassword,*6-18" nullmsg="请输入密码！" errormsg="请设置新密码（6-18位字符）！" />
		                                    <div class="Validform_checktip"></div>
		                                </div>
		                            </li>
		                            <li>
		                                <div class="dt">确认密码</div>
		                                <div class="dd">
		                                    <input type="password" value="" name="repassword" class="form-control input-bd1 text input-2" recheck="password" datatype="*6-18" nullmsg="请输入密码！" errormsg="您两次输入的密码不一致！" />
		                                    <div class="Validform_checktip"></div>
		                                </div>
		                            </li>
		                            <li>
	                	                <div class="dt">验证码</div>
	                	                <div class="dd">
	                	                	<input type="text" name="verify" class="form-control input-bd1 text input-1" required="required" datatype="*" nullmsg="请输入验证码！" errormsg="请输入验证码！">
	                	                	<img src="{:U('verify')}" class="verifyimg reloadverify"/>
	                	                    <div class="Validform_checktip"></div>
	                	                </div>
	                	            </li>
		                            <li>
		                                <div class="dd">
		                                    <button type="submit" class="btn btn-success w140-btn">注册</button><a href="{:U('login')}" class="cl-blue sbtn">已有账号？立即登录</a>
		                                </div>
		                            </li>
		                        </ul>
		                    </form>
		                </div>
	                </div>
	                <div class="col-md-6 col-sm-12">
	                	<div class="otherwise-landing-box clearfix">
	                	    <dl class="clearfix">
	                	        <dt>您也可以用以下方式登录：</dt>
	                	        <dd><a href="{:U('oauth/qq')}" target="_blank"><i class="fa fa-qq"></i><span>使用QQ帐号登录</span></a></dd>
	                	        <dd><a href="{:U('oauth/weibo')}" target="_blank"><i class="fa fa-weibo"></i><span>使用微博帐号登录</span></a></dd>
	                	        <dd><a href="{:U('oauth/weixin')}" target="_blank"><i class="fa fa-weixin"></i><span>使用微信帐号登录</span></a></dd>
	                	    </dl>
	                	</div>
	                </div>
		            <!-- end login-box -->
		        </div>
		        <!-- end tab-content -->
		    </div>
		<!-- end reg-tab -->
		</div>
		

	    <script type="text/javascript">
	    $(function() {
	        $(".registerform").Validform({
	            tiptype: function(msg, o, cssctl) {
	                if (!o.obj.is("form")) {
	                    var objtip = o.obj.siblings(".Validform_checktip");
	                    cssctl(objtip, o.type);
	                    objtip.text(msg);
	                }
	            },
	            datatype: {
	                oldpassword: function(gets) {
	                    if (gets == $("#passwordold").val()) {
	                        return "新密码不能与旧密码一致！";
	                    }
	                }
	            },
	            postonce: true,
	            showAllError: true,
	        });
	    })
	    $(function(){
			//初始化选中用户名输入框
			$("#registerform").find("input[name=email]").focus();
			//刷新验证码
			var verifyimg = $(".verifyimg").attr("src");
			$(".reloadverify").click(function(){
				$(".verifyimg").attr("src", verifyimg+'?random='+Math.random());
			});
		});
	    </script>
	</div>
</div>


<template file="footer.tpl" />