<layout name="layout" />

<div class="row-fluid">
  <form class="form-horizontal" action="{:U('edit')}" method="post" id="info_form" name="info_form">
    <fieldset>
      <legend>{:L('block_edit')}</legend>
      
      <div class="control-group">
        <label class="control-label" for="title">{:L('block_name')}</label>
        <div class="controls">
            <input name="title" type="text" class="input-xlarge" id="title" value="{$info.title}">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="cell_name">{:L('cell_name')}</label>
        <div class="controls">
          <input type="text" class="input-xlarge" name="cell_name" id="cell_name" value="{$info.cell_name}" disabled="disabled">
        </div>
      </div>
      
      <div class="control-group">
        <div class="controls" style="margin-left:50px;">
          <editor type="ueditor" lang="cn" name="content" width="760" height="450" content="{$info.content}"></editor> 
        </div>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <button class="btn" type="reset" onclick="history.back()">{:L('lable_back')}</button>
        <input type="hidden" name="id" value="{$info.id}" />
      </div>
    </fieldset>
  </form>
</div>


<script>
$(function(){
	$('#J_verification_select').change(function(){
		$('#verification').val($(this).val());
	})
	
	var check_name_url = "{:U('ajax_check_name')}";
	
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$("#title").formValidator({onshow:"请输入显示名称",onfocus:"显示名称不能为空"}).inputValidator({min:1,onerror:"请输入显示名称"});
})
</script>