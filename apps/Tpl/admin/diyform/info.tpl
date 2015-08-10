<layout name="layout" />

<h4>{$diyform_title} - {:L('info_manage')}</h4>
<div class="blank20"></div>

<div class="row-fluid J_tablelist" data-acturi="{:U('ajax_edit')}">
  <table class="table table-hover">
    <thead>
      <tr>
        <th width="60">{:L('lable_id')}</th>
        <volist name="fields" id="r">
        <if condition="($r.required eq 1) AND ($r.isshow eq 1)"><th>{$r.name}</th></if>
        </volist>
        <th width="120" class="text-c">{:L('lable_options')}</th>
      </tr>
    </thead>
    <tbody>
    	<foreach name="list" item="val" key="id">
      <tr>
      	<td>{$id}</td>
      	<volist name="fields" id="r">
        <if condition="($r.required eq 1) AND ($r.isshow eq 1)"><td>{$val[$r['id']]['info']}</td></if>
        </volist>
        <td class="text-c">
        <a href="{:U('view',array('diyid'=>$diyid,'id'=>$id))}"><i class="icon-zoom-in"></i>{:L('lable_view')}</a>&nbsp;&nbsp;
        <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="{:U('delete_info', array('id'=>$id))}" data-msg="{:sprintf(L('confirm_delete_one'),'ID='.$id)}"><i class="icon-remove"></i>{:L('lable_del')}</a>
        </td>
      </tr>
      </foreach>
    </tbody>
  </table>
  
</div>