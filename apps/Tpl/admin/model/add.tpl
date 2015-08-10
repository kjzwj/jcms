<layout name="layout" />

<div class="row-fluid">
  <form class="form-horizontal" action="{:U('model/add')}" method="post" id="info_form" name="info_form">
    <fieldset>
      <legend><small>基本信息</small></legend>
      
      <div class="control-group">
        <label class="control-label" for="name">模型名称</label>
        <div class="controls">
            <input name="name" type="text" class="input-xlarge" id="name">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="tablename">数据表名称</label>
        <div class="controls">
          <input type="text" class="input-xlarge" name="tablename" id="tablename">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="description">描述</label>
        <div class="controls">
          <textarea class="input-xlarge" name="description" id="description" rows="3"></textarea>
        </div>
      </div>
      
      <legend><small>模板设置</small></legend>
      
      <div class="control-group">
        <label class="control-label" for="template_index">{:L('template_index')}</label>
        <div class="controls">
            <div class="input-append"><input name="template_index" type="text" class="input-large" id="J_template_index" placeholder="index_default">
            <button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'tpl'))}" data-name="J_template_index" data-width="800" data-title="{:L('template_select')} (双击选择)" type="button">{:L('template_select')}</button>
            </div>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="template_list">{:L('template_list')}</label>
        <div class="controls">
            <div class="input-append"><input name="template_list" type="text" class="input-large" id="J_template_list" placeholder="list_default">
            <button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'tpl'))}" data-name="J_template_list" data-width="800" data-title="{:L('template_select')} (双击选择)" type="button">{:L('template_select')}</button>
            </div>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="template_show">{:L('template_show')}</label>
        <div class="controls">
            <div class="input-append"><input name="template_show" type="text" class="input-large" id="J_template_show" placeholder="show_default">
            <button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'tpl'))}" data-name="J_template_show" data-width="800" data-title="{:L('template_select')} (双击选择)" type="button">{:L('template_select')}</button>
            </div>
        </div>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <button class="btn" type="reset" onclick="location.href='{:U('model/index')}'">{:L('lable_back')}</button>
      </div>
    </fieldset>
  </form>
</div>

<script>
$(function(){
	var check_name_url = "{:U('model/ajax_check_name')}";
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$("#name").formValidator({onshow:"请填写模型名称",onfocus:"请填写模型名称"}).inputValidator({min:1,onerror:"请填写模型名称"}).ajaxValidator({
	  type : "get",
		url : check_name_url,
		datatype : "json",
		async:'false',
		success : function(result){	
            if(result.status == 0){
                return false;
			}else{
                return true;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "模型名称已经存在",
		onwait : "正在验证"
	});	
	$("#tablename").formValidator({onshow:"请填写数据表名称",onfocus:"数据表名称长度必须为3-20位"}).regexValidator({regexp:"^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){0,19}$",onerror:"数据表名称不正确"}).inputValidator({min:3,max:20,onerror:"数据表名称长度必须为3-20位"}).ajaxValidator({
	  type : "get",
		url : check_name_url,
		datatype : "json",
		async:'false',
		success : function(result){	
            if(result.status == 0){
                return false;
			}else{
                return true;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "数据表名称已经存在",
		onwait : "正在验证"
	});
	
})
</script>