<layout name="layout" />

<div class="row-fluid">
  <form class="form-horizontal" action="{:U('add')}" method="post" id="info_form" name="info_form">
    <fieldset>
      <legend>{:L('diyform_add')}</legend>
      
      <div class="control-group">
        <label class="control-label" for="title">{:L('lable_name')}</label>
        <div class="controls">
            <input name="title" type="text" class="input-xlarge" id="title">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="info">{:L('lable_desc')}</label>
        <div class="controls">
          <textarea name="info" rows="6" class="input-xxlarge" id="info"></textarea>
        </div>
      </div>
  
      <div class="control-group">
        <label class="control-label" for="status">{:L('lable_status')}</label>
        <div class="controls">
          <label class="radio inline">
            <input name="status" type="radio" id="status1" value="1" checked="checked"> {:L('lable_yes')}
          </label>
          <label class="radio inline">
            <input type="radio" name="status" id="status2" value="0"> {:L('lable_no')}
          </label>
        </div>
      </div>      
      
      <div class="control-group">
        <label class="control-label" for="sendmail">{:L('send_mail')}</label>
        <div class="controls">
          <label class="radio inline">
            <input name="sendmail" type="radio" id="sendmail1" value="1"> {:L('lable_yes')}
          </label>
          <label class="radio inline">
            <input name="sendmail" type="radio" id="sendmail2" value="0" checked="checked"> {:L('lable_no')}
          </label>
        </div>
      </div> 

      <div class="control-group" id="toemail_div">
        <label class="control-label" for="toemail">{:L('toemail')}</label>
        <div class="controls">
            <input name="toemail" type="email" class="input-xlarge" id="toemail">
        </div>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <a class="btn" href="{:U('diyform/index')}">{:L('lable_back')}</a>
      </div>
    </fieldset>
  </form>
</div>


<script>
$(function(){
	$('#J_verification_select').change(function(){
		$('#verification').val($(this).val());
	})
	
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$("#title").formValidator({onshow:"请输入名称",onfocus:"名称不能为空"}).inputValidator({min:1,onerror:"请输入名称"});
	$("#toemail").formValidator({empty:true,onshow:"可选,请输入邮箱",onfocus:"接收表单信息的邮箱地址"}).regexValidator({regexp:"^[\w\-\.]+@[\w\-\.]+(\.\w+)+$",onerror:"你输入的邮箱格式不正确"});

})
</script>