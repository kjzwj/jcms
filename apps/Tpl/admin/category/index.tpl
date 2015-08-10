<layout name="layout" />

<h4>{:L('cate_manage')}</h4>
<div class="blank20"></div>

<div class="row-fluid J_tablelist" data-acturi="{:U('category/ajax_edit')}">
  <table class="table table-hover">
    <thead>
      <tr>
        <th width="20" class='text-c'><span data-tdtype="order_by" data-field="id" class="sort_th">{:L('lable_id')}</span></th>
        <th width="60" class="text-c"><span data-tdtype="order_by" data-field="ordid" class="sort_th">{:L('lable_order')}</span></th>
        <th>{:L('lable_name')}</th>
        <th width="80">{:L('lable_type')}</th>
        <th width="200" class="text-c">{:L('lable_options')}</th>
      </tr>
    </thead>
    <tbody>
    	{$list}
    </tbody>
  </table>
</div>
    
