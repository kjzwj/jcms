<layout name="layout" />

<h4>{:L('diyform_manage')}</h4>
<div class="blank20"></div>

<div class="row-fluid J_tablelist" data-acturi="{:U('ajax_edit')}">
  <table class="table table-hover">
    <thead>
      <tr>
        <th width="60"><span data-tdtype="order_by" data-field="id">{:L('lable_id')}</span></th>
        <th width="120">{:L('lable_name')}</th>
        <th>{:L('lable_description')}</th>
        <th width="90" class="text-c">{:L('send_mail')}</th>
        <th width="90" class="text-c">{:L('lable_status')}</th>
        <th width="250" class="text-c">{:L('lable_options')}</th>
      </tr>
    </thead>
    <tbody>
    	<volist name="list" id="val" >
      <tr>
        <td>{$val.id}</td>
        <td><a href="{:U('diyform/preview',array('id'=>$val['id']))}" target="_blank">{$val.title}</a></td>
        <td>{$val.info}</td>
        <td class="text-c"><img data-tdtype="toggle" data-id="{$val.id}" data-field="sendmail" data-value="{$val.sendmail}" src="__DATA__img/toggle_<if condition="$val.sendmail eq 0">disabled<else/>enabled</if>.gif" /></td>
        <td class="text-c"><img data-tdtype="toggle" data-id="{$val.id}" data-field="status" data-value="{$val.status}" src="__DATA__img/toggle_<if condition="$val.status eq 0">disabled<else/>enabled</if>.gif" /></td>
        <td class="text-c">
        <a href="{:U('info',array('id'=>$val['id']))}"><i class="icon-list"></i>{:L('info_manage')}</a>&nbsp;&nbsp;
        <a href="{:U('model_fields/index',array('modelid'=>$val['id'],'mtype'=>2))}"><i class="icon-share"></i>{:L('fields_manage')}</a>&nbsp;&nbsp;
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