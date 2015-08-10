<layout name="layout" />


<div class="row-fluid">


  <form class="form-horizontal" action="{:U('email')}" method="post">
    <fieldset>
     <legend>邮件服务器配置</legend>
     <div class="tab-content">
     
       <foreach name="info" item="vo">
          <div class="control-group">
            <label class="control-label">{:L($key)}</label>
            <div class="controls">
              <input <if condition="$key eq 'smtppass'">type="password"<else/>type="text"</if> name="data[{$key}]" value="{$vo}">
            </div>
          </div>
       </foreach>
      
     	</div>
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <button class="btn" type="reset">{:L('lable_cancel')}</button>
      </div>
    </fieldset>
  </form>
</div>