<layout name="layout" />

<h4>{:L('sys_info')}</h4>
<div class="blank20"></div>

<div class="row-fluid">

  <ul class="nav nav-tabs">
		<foreach name="tabnav" item="vo">
    <li><a href="{:U('index')}">{:L('tabs_'.$key)}</a></li>
    </foreach>
    <li class="active"><a href="{:U('sysinfo/add')}">{:L('tabs_addnew')}</a></li>
  </ul>

  <form class="form-horizontal" action="{:U('add')}" method="post">
    <fieldset>
     
     <div class="tab-content">

      <div class="tab-pane active" id="addnew">
      
        <div class="control-group">
          <label class="control-label" for="name">{:L('sys_addlabel')}</label>
          <div class="controls">
            <input name="name" type="text" class="input-xlarge" id="name" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="varname">{:L('sys_addname')}</label>
          <div class="controls">
            <input type="text" class="input-xlarge" id="varname" name="varname" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="vartype">{:L('sys_addtype')}</label>
          <div class="controls">
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_0" value="text" checked="checked">单行文本
            </label>
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_1" value="number">数字
            </label>
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_2" value="bool">布尔(Y/N)
            </label>
            <label class="radio inline">
              <input type="radio" name="vartype" id="type_3" value="textarea">多行文本
            </label>
          </div>
        </div> 
        <div class="control-group">
          <label class="control-label" for="value">{:L('sys_addvalue')}</label>
          <div class="controls">
            <textarea name="value" rows="3" class="input-xlarge" id="value"></textarea>
          </div>
        </div>                
     	</div>
     	</div>
     <div class="form-actions">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <button class="btn" type="reset">{:L('lable_cancel')}</button>
      </div>
    </fieldset>
  </form>
</div>