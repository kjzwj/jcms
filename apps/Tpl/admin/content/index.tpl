<layout name="layout" />

<h4>{$cate.name} - {:L('cate_manage')} 
<small class="pull-right"><a href="{:U('content/add',array('cat_id'=>$_REQUEST['cat_id']))}" class="btn">{:L('article_add')}</a></small>
</h4>
<div class="blank20"></div>

<div class="row-fluid J_tablelist" data-acturi="{:U('content/ajax_edit')}">

    <table class="table table-hover">
      <thead>
        <tr>
        	<th width="20" class="text-c"><input type="checkbox" id="checkall_t" class="J_checkall"></th>
          <th width="20" class="text-c"><span data-tdtype="order_by" data-field="id" class="sort_th">{:L('lable_id')}</span></th>
          <th width="60" class="text-c"><span data-tdtype="order_by" data-field="ordid" class="sort_th">{:L('lable_order')}</span></th>
          <th>{:L('lable_title')}</th>
          <th>{:L('lable_cate')}</th>
          <th width="120" class="text-c"><span data-tdtype="order_by" data-field="addtime" class="sort_th">{:L('lable_addtime')}</span></th>
          <th width="50" class="text-c"><span data-tdtype="order_by" data-field="status" class="sort_th">{:L('lable_status')}</span></th>
          <th width="150" class="text-c">{:L('lable_options')}</th>
        </tr>
      </thead>
      <tbody>
      	<volist name="list" id="val" >
        <tr>
        	<td class="text-c"><input type="checkbox" class="J_checkitem" value="{$val.id}"></td>
  				<td class="text-c">{$val.id}</td>
          <td class="text-c"><span data-tdtype="edit" data-field="ordid" data-id="{$val.id}" class="tdedit">{$val.ordid}</span></td>
          <td><span data-tdtype="edit" data-field="title" data-id="{$val.id}" class="tdedit">{$val.title}</span></td>
          <td><a href="{:U('content/index',array('cat_id'=>cate($val['cat_id'],'id')))}">{:cate($val['cat_id'])}</a></td>
          <td class="text-c">{$val.addtime|date='Y-m-d H:i:s',###}</td>
          <td class="text-c"><img data-tdtype="toggle" data-id="{$val.id}" data-field="status" data-value="{$val.status}" src="__DATA__img/toggle_<if condition="$val.status eq 0">disabled<else/>enabled</if>.gif" /></td>
          <td class="text-c">
          <a href="{:U('home/content/view',array('id'=>$val['id']))}" target="_blank"><i class="icon-share"></i>{:L('lable_browse')}</a>&nbsp;&nbsp;
          <a href="{:U('content/edit',array('id'=>$val['id'],'cat_id'=>$val['cat_id']))}"><i class="icon-edit"></i>{:L('lable_edit')}</a>&nbsp;&nbsp;
          <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="{:U('content/delete', array('id'=>$val['id']))}" data-msg="{:sprintf(L('confirm_delete_one'),$val['title'])}"><i class="icon-remove"></i>{:L('lable_del')}</a>
          </td>
        </tr>
        </volist>
      </tbody>
    </table>

    <div class="pagination pagination-small">
      <ul>{$page}</ul>
    </div>  

    <div class="form-actions">
      <input type="button" class="btn btn-small" data-tdtype="batch_action" data-acttype="ajax_form" data-id="move" data-uri="{:U('content/move')}" data-name="id" data-title="{:L('batch_move')}" value="{:L('batch_move')}" /> 
      <input type="button" class="btn btn-small" data-tdtype="batch_action" data-acttype="ajax" data-uri="{:U('content/delete')}" data-name="id" data-msg="{:L('confirm_delete')}" value="{:L('batch_delete')}" />
    </div>


</div>
    
