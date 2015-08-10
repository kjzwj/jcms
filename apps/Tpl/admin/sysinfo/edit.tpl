<layout name="layout" />

<h4>{:L('sys_info')}</h4>
<div class="blank20"></div>

<div class="row-fluid">

  <ul class="nav nav-tabs">
		<foreach name="tabnav" item="vo">
    <li><a href="{:U('index')}">{:L('tabs_'.$key)}</a></li>
    </foreach>
    <li class="active"><a href="{:U('sysinfo/add')}">{:L('tabs_editvar')}</a></li>
  </ul>

  <form class="form-horizontal" action="{:U('edit')}" method="post">
    <fieldset>
     
     <div class="tab-content">

      <div class="tab-pane active" id="addnew">
      
        <div class="control-group">
          <label class="control-label" for="name">{:L('sys_addlabel')}</label>
          <div class="controls">
            <input name="name" type="text" class="input-xlarge" id="name" value="{$info.name}" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="varname">{:L('sys_addname')}</label>
          <div class="controls">
            <input name="varname" type="text" class="input-xlarge" id="varname" value="{$info.varname}" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="vartype">{:L('sys_addtype')}</label>
          <div class="controls">
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_0" value="text" <if condition="$info['vartype'] eq 'text'">checked="checked"</if>>单行文本
            </label>
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_1" value="number" <if condition="$info['vartype'] eq 'number'">checked="checked"</if>>数字
            </label>
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_2" value="bool" <if condition="$info['vartype'] eq 'bool'">checked="checked"</if>>布尔(Y/N)
            </label>
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_3" value="textarea" <if condition="$info['vartype'] eq 'textarea'">checked="checked"</if>>多行文本
            </label>
          </div>
        </div> 
        <div class="control-group">
          <label class="control-label" for="value">{:L('sys_addvalue')}</label>
          <div class="controls">
            <textarea name="value" rows="3" class="input-xlarge" id="value">{$info.value}</textarea>
          </div>
        </div>                
     	</div>
     	</div>
     <div class="form-actions">
     		<input type="hidden" name="id" value="{$info.id}" />
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <button class="btn" type="reset" onclick="history.back()">{:L('lable_cancel')}</button>
      </div>
    </fieldset>
  </form>
</div>