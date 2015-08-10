<layout name="layout" />

<h4>{:L('sys_info')}</h4>
<div class="blank20"></div>

<div class="row-fluid">

  <ul class="nav nav-tabs">
		<foreach name="info" item="vo">
    <li <if condition="$key eq 'sys'"> class="active"</if>><a href="#{$key}" data-toggle="tab">{:L('tabs_'.$key)}</a></li>
    </foreach>
    <li><a href="{:U('sysinfo/add')}">{:L('tabs_addnew')}</a></li>
  </ul>

  <form class="form-horizontal" action="{:U('saveInfo')}" method="post">
    <fieldset>
     
     <div class="tab-content">
     
       <foreach name="info" item="vo">
        <div class="tab-pane <if condition="$key eq 'sys'"> active</if>" id="{$key}">
        	<foreach name="info[$key]" item="val">
          <div class="control-group">
            <label class="control-label">{$val.name}</label>
            <div class="controls">
                {$val.html}
                <if condition="$val['tabtype'] eq 'myset'"><span class="help-inline"><a href="{:U('sysinfo/edit',array('id'=>$val['id']))}">[修改]</a></span></if> <span class="help-inline">{$val.varname}</span>
            </div>
          </div>
          </foreach>
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