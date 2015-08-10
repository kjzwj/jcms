<layout name="layout" />

<div class="row-fluid">
  <form class="form-horizontal" action="{:U('edit')}" method="post" id="info_form" name="info_form">
    <fieldset>
      <legend>{:L('admins_add')}</legend>
      
      <div class="control-group">
        <label class="control-label" for="username">{:L('username')}</label>
        <div class="controls">
            <input name="username" type="text" class="input-xlarge" id="username" value="{$info.username}">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="email">{:L('email')}</label>
        <div class="controls">
            <input name="email" type="text" class="input-xlarge" id="email" value="{$info.email}">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="password">{:L('password')}</label>
        <div class="controls">
          <input type="password" class="input-xlarge" name="password" id="password" value="{$info.password}">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="role">{:L('lable_role')}</label>
        <div class="controls">
          <select name="role">
            <option value="1" selected="selected">系统管理员</option>
          </select>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="title">{:L('lable_status')}</label>
        <div class="controls">
            <label class="checkbox inline"><input type="radio" name="status" value="1" id="status_1" {$info['status']==1?'checked="checked"':''}> {:L('lable_enable')}</label>
            <label class="checkbox inline"><input type="radio" name="status" value="0" id="status_0" {$info['status']==0?'checked="checked"':''}> {:L('lable_disable')}</label>
        </div>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <a class="btn" type="reset" href="{:U('index')}">{:L('lable_back')}</a>
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
	$("#password").formValidator({onshow:"请输入登录密码",onfocus:"密码长度至少6位"}).inputValidator({min:6,onerror:"密码长度至少6位"});
  $("#email").formValidator({onshow:"请输入邮箱地址",onfocus:"请输入邮箱地址"}).inputValidator({min:1,onerror:"请输入邮箱地址"});
  $("#username").formValidator({onshow:"请输入用户名",onfocus:"请输入用户名"}).inputValidator({min:3,max:20,onerror:"请输入用户名"});
})
</script>