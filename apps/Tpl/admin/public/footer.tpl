<!--footer-->
<footer class="footer">
	&copy; 2012-{:DATE('Y')} J-cms 所有版权
</footer>

<wj:load type="js" href="__DATA__js/plugins/jquery.tools.min.js,__DATA__js/plugins/formvalidator.js,__DATA__js/pinphp.js,__DATA__js/admin.js" from="admin" />


<present name="iframe_tools">
<load type='css' href="__DATA__css/artDialog.css" />
<load type='js' href="__DATA__js/artDialog.js,__DATA__js/plugins/iframeTools.js" from="admin" />
</present>

<script>
//初始化弹窗
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script>


<present name="list_table">
<wj:load type="js" href="__DATA__js/plugins/listTable.js" from="admin" />
<script>
$(function(){
	$('.J_tablelist').listTable();
});
</script>
</present>
</body>
</html>