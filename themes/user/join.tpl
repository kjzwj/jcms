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
		                <h3>绑定帐号</h3>
		            </li>
		            <li><span class="title-tip">如果没有本站帐号，请创建您的【{:C('sys_sitename')}】帐号</span></li>
		        </ul>
		    </div>
		    <div class="user-box clearfix">
		        <!-- begin tab-content -->
		        <div class="tab-content">
		                <div class="reg-box login-box clearfix">
		                    <form class="registerform" action="{:U('join')}" method="post">
		                        <ul class="list-unstyled reg-box-from">
		                            <li>
		                                <div class="join_info_box">
		                                    <img width="40px" height="40px" src="{$Think.session.avatar}">
		                                    <h5>{$Think.session.uname}，您好 <p>请建立您的{:C('web_name')}账号</p></h5>
		                                </div>
		                            </li>
		                            <li>
		                                <div class="dt">邮箱地址</div>
		                                <div class="dd">
		                                    <input type="text" value="" name="email" class="form-control input-bd1 text input-2" datatype="e" nullmsg="请输入邮箱地址！" errormsg="请输入正确的邮箱地址！" />
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
		                                <div class="dd">
		                                    <button type="submit" class="btn btn-success w140-btn">确定</button><a href="{:C('sys_siteurl')}" class="cl-blue sbtn">取消，返回首页</a>
		                                </div>
		                            </li>
		                        </ul>
		                    </form>
		                </div>
		            <!-- end login-box -->
		        </div>
		        <!-- end tab-content -->
		    </div>
		<!-- end reg-tab -->
		</div>
		
	    <script type="text/javascript">
	    $(function() {
	        $(".loginform").Validform({
	            tiptype: function(msg, o, cssctl) {
	                if (!o.obj.is("form")) { 
	                    var objtip = o.obj.siblings(".Validform_checktip");
	                    cssctl(objtip, o.type);
	                    objtip.text(msg);
	                }
	            },
	            postonce: true,
	            showAllError: true,
	        });
	    })
	    $(function(){
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