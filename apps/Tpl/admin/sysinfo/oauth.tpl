<layout name="layout" />

<h4>网站接入</h4>
<div class="blank20"></div>

<div class="row-fluid">

  <ul class="nav nav-tabs">
    <foreach name="info" item="vo">
    <li <if condition="$key eq 'qq'"> class="active"</if>><a href="#{$key}" data-toggle="tab">{:L('tabs_'.$key)}</a></li>
    </foreach>
  </ul>


  <form class="form-horizontal" action="{:U('oauth')}" method="post">
    <fieldset>
     <div class="tab-content">
       
       <foreach name="info" item="vo">
        <div class="tab-pane <if condition="$key eq 'qq'"> active</if>" id="{$key}">
          <foreach name="info[$key]" item="val" key="name">
          <div class="control-group">
            <label class="control-label" style="text-transform:uppercase;">{$name}</label>
            <div class="controls">
                <input type="text" class="input-xxlarge" name="data[{$key}][{$name}]" value="{$val}">
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