<layout name="layout" />

<div class="row-fluid">
  <form class="form-horizontal" action="{:U('add')}" method="post" id="info_form" name="info_form">
    <fieldset>
      <legend>添加字段</legend>
      
      <div class="control-group">
        <label class="control-label" for="formtype">字段类型</label>
        <div class="controls">
            {$fields_type}
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="errortips">表单字段名</label>
        <div class="controls">
         	<div><input type="text" class="input-xlarge" name="field" id="field"></div>
          <span class="help-block">只能由英文字母、数字和下划线组成，并且仅能字母开头，不以下划线结尾</span>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="name">显示名称</label>
        <div class="controls">
            <div><input type="text" class="input-xlarge" name="name" id="name"></div>
            <span class="help-block">例如：文章标题	</span>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="defvalue">默认值</label>
        <div class="controls">
          <textarea class="input-xlarge" name="defvalue" id="defvalue" rows="3"></textarea>
          <span class="help-block">如果定义数据类型为select、radio、checkbox时，此处填写被选择的项目(用","分开，如"男,女,人妖")。</span>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="tips">字段提示</label>
        <div class="controls">
          <input type="text" class="input-xlarge" name="tips" id="tips">
          <span class="help-block">显示在字段别名下方作为表单输入提示	</span>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="errortips">数据校验正则</label>
        <div class="controls">
            <input type="text" class="input-medium" name="verification" id="verification">
            {$verification_select}
            <span class="help-block">系统将通过此正则校验表单提交的数据合法性，如果不想校验数据请留空	</span>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="errortips">数据校验未通过的提示信息</label>
        <div class="controls">
            <input type="text" class="input-xlarge" name="errortips" id="errortips">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="required">是否必填</label>
        <div class="controls">
            <label class="radio inline">
              <input type="radio" name="required" id="required1" value="1">
              是
            </label>
            <label class="radio inline">
              <input name="required" type="radio" id="required2" value="0" checked="checked">
              否
            </label>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="issearch">作为全站搜索信息</label>
        <div class="controls">
            <label class="radio inline">
              <input type="radio" name="issearch" id="issearch1" value="1">
              是
            </label>
            <label class="radio inline">
              <input name="issearch" type="radio" id="issearch2" value="0" checked="checked">
              否
            </label>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="isshow">是否在前台显示</label>
        <div class="controls">
            <label class="radio inline">
              <input type="radio" name="isshow" id="isshow1" value="1" checked>
              是
            </label>
            <label class="radio inline">
              <input type="radio" name="isshow" id="isshow2" value="0">
              否
            </label>
        </div>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <a class="btn" href="{:U('index',array('modelid'=>$modelid,'mtype'=>$mtype))}">{:L('lable_back')}</a>
      </div>
    </fieldset>
    <input type="hidden" name="modelid" value="{$modelid}" />
    <input type="hidden" name="mtype" value="{$mtype}" />
  </form>
</div>

<script>
$(function(){
	$('#J_verification_select').change(function(){
		$('#verification').val($(this).val());
	})
	
	var check_name_url = "{:U('ajax_check_name')}";
	
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$("#field").formValidator({onshow:"请填写字段名",onfocus:"字段名长度必须为3-20位"}).regexValidator({regexp:"^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){0,19}$",onerror:"字段名不正确"}).inputValidator({min:3,max:20,onerror:"字段名长度必须为3-20位"}).ajaxValidator({
	  type : "get",
		url : check_name_url,
		data : "modelid={$modelid}&mtype={$mtype}",
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
		onerror : "字段名已经存在",
		onwait : "正在验证"
	});	
	$("#name").formValidator({onshow:"请输入别名",onfocus:"字段别名不能为空"}).inputValidator({min:1,onerror:"请输入别名"});
})
</script>