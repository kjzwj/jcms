<!--left-->
<notempty name="admin_menu[$action_name]">
<div class="span2 side_nav" style="margin-left:0;">
  <ul class="nav nav-tabs nav-stacked">
    <li class="nav-header">{$admin_menu[$action_name].title}</li>
    <notempty name="admin_menu[$action_name][sonmenu]">
    <foreach name="admin_menu[$action_name][sonmenu]" item="val">
    <li <if condition="$curr_name eq $key">class="active"</if>><a href="{:U($key)}">{$val}</a></li>
    </foreach>
    </notempty>
  </ul>
  
  <ul class="nav nav-tabs hidden-tabs">
    <li class="nav-header">{$admin_menu[$action_name].title}</li>
    <notempty name="admin_menu[$action_name][sonmenu]">
    <foreach name="admin_menu[$action_name][sonmenu]" item="val">
    <li <if condition="$curr_name eq $key">class="active"</if>><a href="{:U($key)}">{$val}</a></li>
    </foreach>
    </notempty>
  </ul>
  
</div>
</notempty>