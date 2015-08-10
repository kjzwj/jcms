<layout name="layout" />

<div class="row-fluid">
  <form class="form-horizontal" action="{:U('model/edit')}" method="post" id="info_form" name="info_form">
    <fieldset>
      <legend><small>基本信息</small></legend>
      
      <div class="control-group">
        <label class="control-label" for="name">模型名称</label>
        <div class="controls">
            <input name="name" type="text" class="input-xlarge" id="name" value="{$info.name}" disabled="disabled">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="tablename">数据表名称</label>
        <div class="controls">
          <input type="text" class="input-xlarge" name="tablename" id="tablename" value="{$info.tablename}" disabled="disabled">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="description">描述</label>
        <div class="controls">
          <textarea class="input-xlarge" name="description" id="description" rows="3">{$info.description}</textarea>
        </div>
      </div>
      
      <legend><small>模板设置</small></legend>
      
      <div class="control-group">
        <label class="control-label" for="template_index">{:L('template_index')}</label>
        <div class="controls">
            <div class="input-append"><input name="template_index" type="text" class="input-large" id="J_template_index" placeholder="index_default" value="{$info.template_index}"><button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'tpl'))}" data-name="J_template_index" data-width="800" data-title="{:L('template_select')} (双击选择)" type="button">{:L('template_select')}</button>
            </div>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="template_list">{:L('template_list')}</label>
        <div class="controls">
            <div class="input-append"><input name="template_list" type="text" class="input-large" id="J_template_list" placeholder="list_default" value="{$info.template_list}"><button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'tpl'))}" data-name="J_template_list" data-width="800" data-title="{:L('template_select')} (双击选择)" type="button">{:L('template_select')}</button>
            </div>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="template_show">{:L('template_show')}</label>
        <div class="controls">
            <div class="input-append"><input name="template_show" type="text" class="input-large" id="J_template_show" placeholder="show_default" value="{$info.template_show}"><button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'tpl'))}" data-name="J_template_show" data-width="800" data-title="{:L('template_select')} (双击选择)" type="button">{:L('template_select')}</button>
            </div>
        </div>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <button class="btn" type="reset" onclick="location.href='{:U('model/index')}'">{:L('lable_back')}</button>
        <input type="hidden" name="id" value="{$info.id}" />
      </div>
    </fieldset>
  </form>
</div>

<script>
$(function(){
	var check_name_url = "{:U('model/ajax_check_name')}";
	$.formValidator.initConfig({formid:"info_form",autotip:true});
})
</script>