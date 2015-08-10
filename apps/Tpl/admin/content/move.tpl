<div class="dialog_content">
  <form id="info_form" name="info_form" action="{:U('content/move')}" method="post">
    <table width="100%" class="table">
      <tr> 
        <th align="right"><label>{:L('moveto')} :</label></th>
        <td><select class="J_cate_select mr10" data-pid="0" data-uri="{:U('category/ajax_getchilds',array('modelid'=>$modelid,'type'=>$type))}" data-selected="{$spid}"></select></td>
      </tr>
    </table>
    <input type="hidden" name="pid" id="J_cate_id" />
    <input type="hidden" name="ids" value="{$ids}" />
  </form>
</div>

<script>
$(function(){
  //分类联动
  $('.J_cate_select').cate_select();
})
</script>