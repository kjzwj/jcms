<layout name="layout" />

<div class="row-fluid">
  <form class="form-horizontal" action="{:U('picshow/add')}" method="post" id="info_form" name="info_form">
    <fieldset>
      <legend>{:L('add_picshow')}</legend>
      
      <div class="control-group">
        <label class="control-label" for="name">{:L('lable_name')}</label>
        <div class="controls">
            <input name="name" type="text" class="input-xlarge" id="name">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="advertising">{:L('lable_advertising')}</label>
        <div class="controls">
          	{$advertising}
            <button class="btn J_opendialog" type="button" data-uri="{:U('picshow/advertising')}" data-name="advertising" data-width="500" data-title="{:L('add_advertising')}">{:L('add_advertising')}</button>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="description">{:L('lable_adurl')}</label>
        <div class="controls">
          <input type="text" class="input-xlarge" name="adurl" id="adurl">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="adpic">{:L('lable_adpic')}</label>
        <div class="controls">
          <div class="input-append"><input class="input-xlarge" id="J_image" name="adpic" type="text">
          <button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'image'))}" data-name="J_image" data-width="800" data-title="{:L('selet_images')} (双击选择)" type="button">{:L('selet_images')}</button></div>
        </div>
      </div>

      
      <div class="control-group">
        <label class="control-label" for="description">{:L('lable_description')}</label>
        <div class="controls">
          <textarea class="input-xlarge" name="description" id="description" rows="3"></textarea>
        </div>
      </div>


      <div class="form-actions">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <a class="btn" href="{:U('index')}">{:L('lable_back')}</a>
      </div>
    </fieldset>
  </form>
</div>


<script>
$(function(){
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$("#name").formValidator({onshow:"请输入名称",onfocus:"名称不能为空"}).inputValidator({min:1,onerror:"请输入名称"});
})
</script>