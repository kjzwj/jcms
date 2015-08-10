<?php if (!defined('THINK_PATH')) exit();?><!-- Fixed navbar -->
<div class="navbar navbar-default navbar-topbar">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://www.yundes.com" target="_blank">J-cms</a>
    </div>

    <ul class="nav navbar-nav navbar-right">
      <li id="topuserinfo" class="welcome"></li>
      <li><a href="http://www.yundes.com" target="_blank">官方首页</a></li>
      <li><a href="http://www.yundes.com/#designing" target="_blank">产品服务</a></li>
      <li><a href="http://www.yundes.com/jcms.html" target="_blank">下载页面</a></li>
      <li><a href="http://www.yundes.com/#contact" target="_blank">技术支持</a></li>
    </ul>
  </div><!-- /.container-fluid -->
</div>

<script>
$(function(){
  $.get("<?php echo U('index/ajax_login');?>", function(data){
    $('#topuserinfo').html(data);
  });
})
</script>