<layout name="layout" />

<h4>{:L('picshow_manage')}</h4>
<div class="blank20"></div>

<div class="row-fluid J_tablelist" data-acturi="{:U('ajax_edit')}">
  <table class="table table-hover">
    <thead>
      <tr>
        <th width="60"><span data-tdtype="order_by" data-field="id">{:L('lable_id')}</span></th>
        <th>{:L('lable_name')}</th>
        <th width="100" class="text-c">{:L('lable_adpic')}</th>
        <th width="100" class="text-c"><span data-tdtype="order_by" data-field="advertising">{:L('lable_advertising')}</span></th>
        <th class="text-c">{:L('lable_adurl')}</th>
        <th width="120" class="text-c">{:L('lable_options')}</th>
      </tr>
    </thead>
    <tbody>
    	<volist name="list" id="val" >
      <tr>
        <td>{$val.id}</td>
        <td><span data-tdtype="edit" data-field="name" data-id="{$val.id}" class="tdedit">{$val.name}</span></td>
        <td class="text-c"><a href="{$val.adpic}" target="_blank" title="新窗口打开"><img src="{$val.adpic}" width="60" /></a></td>
        <td class="text-c">{$val.advertising}</td>
        <td class="text-c"><span data-tdtype="edit" data-field="adurl" data-id="{$val.id}" class="tdedit">{$val.adurl}</span></td>
        <td class="text-c">
        <a href="{:U('edit',array('id'=>$val['id']))}"><i class="icon-edit"></i>{:L('lable_edit')}</a>&nbsp;&nbsp;
        <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="{:U('delete', array('id'=>$val['id']))}" data-msg="{:sprintf(L('confirm_delete_one'),$val['name'])}"><i class="icon-remove"></i>{:L('lable_del')}</a>
        </td>
      </tr>
      </volist>
    </tbody>
  </table>
  
  
  <div class="pagination pagination-small pagination-right">
    <ul>{$page}</ul>
  </div>  
  
</div>