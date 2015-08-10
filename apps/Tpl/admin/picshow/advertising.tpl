<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>{:C('webname')} {:L('website_manage')}</title>
<link href="__DATA__css/bootstrap.min.css" rel="stylesheet" />
<link href="__DATA__css/admin.css" rel="stylesheet" />
<wj:load type="js" href="__DATA__js/jquery.js,__DATA__js/bootstrap.min.js" />
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>

<div class="row-fluid">
  <form class="form-horizontal" id="info_form" name="info_form" onSubmit="return popup_ok();">
      <legend style="text-align:center">{:L('add_advertising')}</legend>
      
      <div class="control-group">
        <label class="control-label" for="name">{:L('lable_name')}</label>
        <div class="controls">
            <input name="optionname" type="text" class="input-large" id="optionname">
        </div>
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn-primary" onClick="popup_ok()">{:L('lable_add')}</button>
        <button class="btn" type="button" onClick="art.dialog.close();">{:L('lable_close')}</button>
      </div>
  </form>
</div>


<load type='css' href="__DATA__css/artDialog.css" />
<load type='js' href="__DATA__js/artDialog.js,__DATA__js/plugins/iframeTools.js" from="admin" />

<script>
function popup_ok()
{
	var dname = $.dialog.data('dname');
	var origin = artDialog.open.origin;
	var objSelect = origin.document.getElementById(dname);
	var objItemValue = document.getElementById('optionname').value;
	if(!objItemValue || objItemValue=='')
	{
		alert('请输入名称');
		return ;
	}
	var len = objSelect.length;
	objSelect.options[len] = new Option(objItemValue,objItemValue);
	objSelect.options[len].selected = true;
	art.dialog.close();
}
</script>
</body>
</html>