<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>{:L('page_msg')}</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
html{ overflow-y: scroll; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
img{ border: 0; }
.error{ padding: 24px 48px; position: relative;}
.error h1{ font-size: 36px; line-height: 2.5em;}
.error .content{ padding-top: 10px;}
.error .info{ margin-bottom: 12px; }
.error .info .title{ margin-bottom: 3px; }
.error .info .title h3{ color: #000; font-weight: 700; font-size: 16px; }
.error .info .text{ line-height: 24px; }
.copyright{margin-top:50px; padding: 12px 48px; color: #ccc; font-size: 12px; }
.copyright a{ color: #999; text-decoration: none; }
.jump{font-size: 14px;}
</style>
</head>
<body>
<div class="error">
<p> <img src="/data/img/error.jpg" width="180"> </p>
<present name="error" >
<h1><?php echo strip_tags($error);?></h1>
</present>

<div class="content">
<?php if(isset($e['file'])) {?>
    <div class="info">
        <div class="title">
            <h3>错误位置</h3>
        </div>
        <div class="text">
            <p>FILE: <?php echo $e['file'] ;?> &#12288;LINE: <?php echo $e['line'];?></p>
        </div>
    </div>
<?php }?>
<?php if(isset($e['trace'])) {?>
    <div class="info">
        <div class="title">
            <h3>TRACE</h3>
        </div>
        <div class="text">
            <p><?php echo nl2br($e['trace']);?></p>
        </div>
    </div>
<?php }?>
</div>

<?php if($jumpUrl && $jumpUrl!='javascript:;') { ?>
<div class="jump">
    <?php echo L('sys_will');?><span style="color:blue;font-weight:bold"><?php echo $waitSecond;?></span><?php echo L('page_jump_tip');?><a href="<?php echo $jumpUrl;?>"><?php echo L('here');?></a>
    <script language="javascript">
        setTimeout("location.href='<?php echo $jumpUrl;?>';",<?php echo $waitSecond;?>*1000);
    </script>
</div>
<?php } ?>

</div>
<div class="copyright">
<p><a title="官方网站" href="">&copy; <?php echo JCMS;?></a> <sup><?php echo WJ_RELEASE ?></sup></p>
</div>
</body>
</html>