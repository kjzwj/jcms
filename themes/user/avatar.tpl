<template file="header.tpl" />
<load type="css" href="__PUBLIC__css/user.css,__PUBLIC__/css/font-awesome.min.css" />
<script type="text/javascript" src="__PUBLIC__fullAvatarEditor/swfobject.js"></script>
<script type="text/javascript" src="__PUBLIC__fullAvatarEditor/fullAvatarEditor.js"></script>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="/public/css/font-awesome-ie7.min.css" />
<![endif]-->

<div class="user_main">
	<div class="container">
		<div class="row">
			<template file="left.tpl" type="user" />
	
			<div class="col-md-9 col-sm-9 main">
				<div class="user_center">
					<h3 class="page-header">修改头像</h3>
					<div class="avatar">
						<div class="txtinfo">
							<ol>
								<li>允许上传的格式：jpg, gif, png</li>
								<li>图片大小不能大于300KB</li>
								<li>建议尺寸：180 x 180 (单位：像素)</li>
							</ol>
						</div>

						<div class="update_avatar">
							<div>
								<p id="swfContainer">
				                    本组件需要安装Flash Player后才可使用，请从<a href="http://www.adobe.com/go/getflashplayer">这里</a>下载安装。
								</p>
							</div>
							<script type="text/javascript">
				            swfobject.addDomLoadEvent(function () {
								var swf = new fullAvatarEditor("__PUBLIC__fullAvatarEditor/fullAvatarEditor.swf", "__PUBLIC__fullAvatarEditor/expressInstall.swf", "swfContainer", {
									    id : 'swf',
										upload_url : "{:U('upload/avatar',array('userid'=>$userid))}",	//上传接口
										method : 'post',	//传递到上传接口中的查询参数的提交方式。更改该值时，请注意更改上传接口中的查询参数的接收方式
										src_upload : 0,		//是否上传原图片的选项，有以下值：0-不上传；1-上传；2-显示复选框由用户选择
										avatar_box_border_width : 1,
										avatar_sizes : '180*180|60*60',
										avatar_sizes_desc : '180*180像素|60*60像素',
										src_url : '{$userid|avatar}'
									}, function (msg) {
										switch(msg.code)
										{
											case 1 : 
												// alert("页面成功加载了组件！");
												break;
											case 2 : 
												// alert("已成功加载图片到编辑面板。");
												break;
											case 3 :
												if(msg.type == 0)
												{
													alert("摄像头已准备就绪且用户已允许使用。");
												}
												else if(msg.type == 1)
												{
													alert("摄像头已准备就绪但用户未允许使用！");
												}
												else
												{
													alert("摄像头被占用！");
												}
											break;
											case 5 : 
												if(msg.type == 0)
												{
													if(msg.content.sourceUrl)
													{
														// alert("原图已成功保存至服务器，url为：\n" +　msg.content.sourceUrl+"\n\n" + "头像已成功保存至服务器，url为：\n" + msg.content.avatarUrls.join("\n\n")+"\n\n传递的userid="+msg.content.userid+"&username="+msg.content.username);
													}
													else
													{
														// alert("头像已成功保存至服务器，url为：\n" + msg.content.avatarUrls.join("\n\n")+"\n\n传递的userid="+msg.content.userid+"&username="+msg.content.username);
													}
												}
											break;
										}
									}
								);
				            });
				        </script>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>


<template file="footer.tpl" />