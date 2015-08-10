<layout name="layout" />

<h4>{$modelname} - {:L('fields_manage')}
  <small><a href="{:U('model_fields/add',array('modelid'=>$modelid,'mtype'=>$mtype))}">【添加字段】</a></small>
</h4>
<div class="blank20"></div>

<div class="row-fluid J_tablelist" data-acturi="{:U('model_fields/ajax_edit',array('modelid'=>$modelid))}">
  <table class="table table-hover">
    <thead>
      <tr>
        <th width="60"><span data-tdtype="order_by" data-field="id">{:L('lable_id')}</span></th>
        <th><span data-tdtype="order_by" data-field="field">{:L('field_name')}</span></th>
        <th>{:L('lable_name')}</th>
        <th><span data-tdtype="order_by" data-field="formtype">{:L('lable_type')}</span></th>
        <th width="70" class="text-c">{:L('lable_required')}</th>
        <th width="70" class="text-c">{:L('lable_search')}</th>
        <th width="70" class="text-c">{:L('lable_show')}</th>
        <th width="100" class="text-c">{:L('lable_options')}</th>
      </tr>
    </thead>
    <tbody>
    	<volist name="list" id="val" >
      <tr>
        <td>{$val.id}</td>
        <td>{$val.field}</td>
        <td>{$val.name}</td>
        <td>{$val.formtype}</td>
        <td class="text-c"><img data-tdtype="toggle" data-id="{$val.id}" data-field="required" data-value="{$val.required}" src="__DATA__img/toggle_<if condition="$val.required eq 0">disabled<else/>enabled</if>.gif" /></td>
        <td class="text-c"><img data-tdtype="toggle" data-id="{$val.id}" data-field="issearch" data-value="{$val.issearch}" src="__DATA__img/toggle_<if condition="$val.issearch eq 0">disabled<else/>enabled</if>.gif" /></td>
        <td class="text-c"><img data-tdtype="toggle" data-id="{$val.id}" data-field="isshow" data-value="{$val.isshow}" src="__DATA__img/toggle_<if condition="$val.isshow eq 0">disabled<else/>enabled</if>.gif" /></td>
        <td class="text-c">
        <a href="{:U('edit',array('id'=>$val['id'],'modelid'=>$modelid,'mtype'=>$mtype))}"><i class="icon-edit"></i>{:L('lable_edit')}</a>&nbsp;&nbsp;
        <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="{:U('delete', array('id'=>$val['id'],'modelid'=>$modelid))}" data-msg="{:sprintf(L('confirm_delete_one'),$val['name'])}"><i class="icon-remove"></i>{:L('lable_del')}</a>
        </td>
      </tr>
      </volist>
    </tbody>
  </table>
  
  
  <div class="pagination pagination-small pagination-right">
    <ul>{$page}</ul>
  </div>  
  
</div>