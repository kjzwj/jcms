<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>jcms</title>
<!-- jQuery and jQuery UI (REQUIRED) -->
<wj:load type="js" href="__DATA__js/jquery-1.7.js,__DATA__js/jquery-ui.min.js" from="admin" />
<!-- elFinder CSS (REQUIRED) -->
<load type="css" href="__DATA__css/jquery-ui.css,__DATA__js/elfinder/css/elfinder.min.css,__DATA__js/elfinder/css/theme.css,__DATA__css/artDialog.css" from="admin" />
<!-- elFinder JS (REQUIRED) -->
<load type="js" href="__DATA__js/elfinder/js/elfinder.min.js,__DATA__js/elfinder/js/i18n/elfinder.zh_CN.js" from="admin" />
<load href="__DATA__js/artDialog.js,__DATA__js/plugins/iframeTools.js" from="admin" />

<!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript" charset="utf-8">
// Helper function to get parameters from the query string.
	function getUrlParam(paramName) {
			var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
			var match = window.location.search.match(reParam) ;
			return (match && match.length > 1) ? match[1] : '' ;
	}
	$().ready(function() {
		var elf = $('#elfinder').elfinder({
			url : "{:U('attachment/load',array('type'=>$type))}",  // connector URL (REQUIRED)
			getFileCallback : function(file) {
				var dname = $.dialog.data('dname');
				var origin = artDialog.open.origin;
				var input = origin.document.getElementById(dname);
				input.value = file;
				input.select();						
				art.dialog.close();
			},
			lang: 'zh_CN',		// language (OPTIONAL)]
			height: 500
		}).elfinder('instance');
	});
</script>

</head>
<body>


<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

</body>
</html>
