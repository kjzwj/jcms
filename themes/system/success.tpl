<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$msgTitle}</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 24px 48px; }
.system-message .yeah{font-size: 26px;}
.system-message h1{ font-size: 36px; line-height: 2.5em;}
.system-message .jump{ padding-top: 10px; font-size: 14px;}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
.copyright{margin-top:50px; padding: 12px 48px; color: #ccc; font-size: 12px; }
.copyright a{ color: #999; text-decoration: none; }
</style>
</head>
<body>
<div class="system-message">
<?php if(isset($message)) {?>
<p class="yeah"> <img src="/data/img/success.jpg">  Yeah~</p>
<h1><?php echo($message?$message:$msgTitle); ?></h1>
<?php }else{?>
<p> <img src="/data/img/error.jpg" width="180"></p>
<h1><?php echo($error); ?></h1>
<?php }?>
<p class="detail"></p>
<present name="jumpUrl" >
<p class="jump">
{:L('sys_will')}<span style="color:blue;font-weight:bold"><?php echo($waitSecond*3); ?></span>{:L('page_jump_tip')}<a href="<?php echo($jumpUrl); ?>">{:L('here')}</a>
<script language="javascript">
    setTimeout("location.href='<?php echo($jumpUrl); ?>';",{$waitSecond}*3000);
</script>
</p>
</present>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
    var time = --wait.innerHTML;
    if(time <= 0) {
        location.href = href;
        clearInterval(interval);
    };
}, 1000);
})();
</script>

<div class="copyright">
<p><a title="官方网站" href="">&copy; <?php echo JCMS;?></a> <sup><?php echo WJ_RELEASE ?></sup></p>
</div>
</body>
</html>