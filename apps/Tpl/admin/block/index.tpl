<layout name="layout" />

<h4>{:L('block_manage')}</h4>
<div class="blank20"></div>

<div class="row-fluid J_tablelist" data-acturi="{:U('ajax_edit')}">
  <table class="table table-hover">
    <thead>
      <tr>
        <th width="60"><span data-tdtype="order_by" data-field="id">{:L('lable_id')}</span></th>
        <th>{:L('block_name')}</th>
        <th>{:L('cell_name')}</th>
        <th width="90" class="text-c">{:L('lable_status')}</th>
        <th width="170" class="text-c">{:L('lable_options')}</th>
      </tr>
    </thead>
    <tbody>
    	<volist name="list" id="val" >
      <tr>
        <td>{$val.id}</td>
        <td>{$val.title}</td>
        <td>{$val.cell_name}</td>
        <td class="text-c"><img data-tdtype="toggle" data-id="{$val.id}" data-field="status" data-value="{$val.status}" src="__DATA__img/toggle_<if condition="$val.status eq 0">disabled<else/>enabled</if>.gif" /></td>
        <td class="text-c">
        <a href="{:U('edit',array('id'=>$val['id']))}"><i class="icon-edit"></i>{:L('lable_edit')}</a>&nbsp;&nbsp;
        <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="{:U('delete', array('id'=>$val['id']))}" data-msg="{:sprintf(L('confirm_delete_one'),$val['title'])}"><i class="icon-remove"></i>{:L('lable_del')}</a>
        </td>
      </tr>
      </volist>
    </tbody>
  </table>
  
  
  <div class="pagination pagination-small pagination-right">
    <ul>{$page}</ul>
  </div>  
  
</div>